import { Component, OnInit } from '@angular/core';
import { Contestant } from '../model/contestant';
import { SourceService } from '../source.service';
import { Workout } from '../model/workout';

@Component({
  selector: 'app-admin',
  templateUrl: './admin.component.html',
  styleUrls: ['./admin.component.scss']
})
export class AdminComponent implements OnInit {
  contestants: Contestant[];
  newContestant: Contestant = new Contestant();

  workouts: Workout[];
  newWorkout: Workout = new Workout();

  constructor(private source: SourceService) {
  }

  ngOnInit() {
    this.getContestants();
    this.emptyNewContestant();
    this.getWorkouts();
    this.emptyNewWorkout();
  }

  getContestants() {
    this.source.getContestants().subscribe(data => this.contestants = data.data);
  }

  saveContestant(i: number) {
    this.source.editContestant(this.contestants[i]);
  }

  addContestant() {
    this.source.addContestant(this.newContestant);
    this.emptyNewContestant();
    this.getContestants();
  }

  getWorkouts() {
    this.source.getWorkouts().subscribe(data => this.workouts = data.data);
  }

  emptyNewContestant() {
    this.newContestant.id = 0;
    this.newContestant.lastname = '';
    this.newContestant.firstname = '';
    this.newContestant.gender = 'm';
    this.newContestant.nick = '';
  }

  emptyNewWorkout() {
    this.newWorkout.id = 0;
    this.newWorkout.name = '';
    this.newWorkout.description = '';
    this.newWorkout.byTime = 1;
  }

  addWorkout() {
    this.source.addWorkout(this.newWorkout);
    this.getWorkouts();
    this.emptyNewWorkout();
  }

  saveWorkout(i: number) {

    this.source.editWorkout(this.workouts[i]);
  }

}
