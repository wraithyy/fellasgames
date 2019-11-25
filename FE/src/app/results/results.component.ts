import { Component, OnInit } from '@angular/core';
import { DbResult, Result } from '../model/result';
import { SourceService } from '../source.service';
import { Contestant } from '../model/contestant';
import { Workout } from '../model/workout';

@Component({
  selector: 'app-results',
  templateUrl: './results.component.html',
  styleUrls: ['./results.component.scss']
})
export class ResultsComponent implements OnInit {
  results: Result[];
  newResult: DbResult = <DbResult>{ id: 0, id_workout: 0, result: 0, id_judge: 0, id_contestant: 0, rx: 1 };
  contestants: Contestant[];
  newResultContestant=[];
  workouts: Workout[];
  config = { search: true, displayKey: 'name', placeholder: 'Jméno účastníka workoutu' };
  options = {};

  constructor(private source: SourceService) {
  }

  ngOnInit() {
    this.source.getResults().subscribe(data => this.results = data.data);
    this.source.getWorkouts().subscribe(data => this.workouts = data.data);
    this.source.getContestants().subscribe((data) => {
      this.contestants = data.data;
      this.options = this.contestants.map((contestant)=> {return {id: contestant.id, name: contestant.firstname + ' ' + contestant.lastname}});
      console.log(this.options);
    });
  }

  saveResult(i: number) {
    const tmpResult = this.results[i];
    const dbResult = <DbResult>{ id: tmpResult.id, id_contestant: tmpResult.contestant.id, id_judge: 0, id_workout: tmpResult.workout.id, result: tmpResult.result, rx: tmpResult.rx };
    this.source.editResult(dbResult);
  }

  addResult() {
    this.newResult.id_contestant = this.newResultContestant['id'];
    this.source.addResult(this.newResult);
    this.source.getResults().subscribe(data => this.results = data.data);
    this.newResult = <DbResult>{ id: 0, id_workout: 0, result: 0, id_judge: 0, id_contestant: 0, rx: 1 };
  }

  rxChange(result: Result) {
    if(result.rx==1){
      result.rx=0;
    }else{
      result.rx=1
    }
  }

  deleteResult(i: number) {
    if(confirm("Opravdu to chceš smazat?")){
    this.source.deleteResult(i);
    this.source.getResults().subscribe(data => this.results = data.data);
    }
  }
}
