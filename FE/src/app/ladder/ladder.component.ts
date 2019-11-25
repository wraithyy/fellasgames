import { Component, OnInit } from '@angular/core';
import { LadderResult } from '../model/ladder';
import { SourceService } from '../source.service';
import { Workout } from '../model/workout';
import { interval, Observable } from 'rxjs';
import { flatMap } from 'rxjs/operators';
import { Contestant } from '../model/contestant';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-ladder',
  templateUrl: './ladder.component.html',
  styleUrls: ['./ladder.component.scss']
})
export class LadderComponent implements OnInit {
  ladderM: LadderResult[];
  ladderF: LadderResult[];
  workouts: Workout[];
  contestants: Contestant[];
  contF: Contestant[];
  contM: Contestant[];
  showMen: boolean = true;
  showBoth: boolean = false;
  time: number = null;
  constructor(private source: SourceService, private route: ActivatedRoute) {
    this.time = +this.route.snapshot.paramMap.get('time');
    console.log(this.time);
    if(this.time==-1){
      this.showBoth = true;
    }
    if(!this.time){
      this.time = 30
    }

    if(this.time>0){
      this.time=this.time*1000
    }
    console.log(this.time);
  }

  ngOnInit() {
    interval( this.time).subscribe(
      ()=>this.showMen = !this.showMen
    );
    this.source.getLadder('m') .subscribe((data) => {
      this.ladderM = data.data;
      data.data.forEach((value)=>{
        this.notEmptyAnymoreM(value.userid);
      })

    });
    this.source.getLadder('f').subscribe((data) => {
      this.ladderF = data.data;
      data.data.forEach((value)=>{
        this.notEmptyAnymoreF(value.userid);
      })

    });
    this.getContestants();
    interval( 5000)
      .pipe(
        flatMap(() => this.source.getLadder('m'))
      )
      .subscribe((data) => {
        this.ladderM = data.data;
        data.data.forEach((value)=>{
          this.notEmptyAnymoreM(value.userid);
        })

      });
    interval( 5000)
      .pipe(
        flatMap(() => this.source.getLadder('f'))
      )
      .subscribe((data) => {
        this.ladderF = data.data;
        data.data.forEach((value)=>{
          this.notEmptyAnymoreF(value.userid);
        })

      });
    this.source.getWorkouts().subscribe(data => this.workouts = data.data);

  }

  click() {
    console.log(this.ladderM);
  }

  notEmptyAnymoreF(id: number) {
    this.contF =this.contF.filter((cont) => {
      return cont.id != id;
    });
  }

  notEmptyAnymoreM(id: number) {

    this.contM = this.contM.filter((cont) => {

      return cont.id != id;
    });

  }

  getContestants() {
    this.source.getContestants().subscribe((data) => {

      this.contestants = data.data;

      this.contF = this.contestants.filter((contestant) => {
        return contestant.gender == 'f';
      });
      this.contM = this.contestants.filter((contestant) => {
        return contestant.gender == 'm';
      });

    });
  }

}
