import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { LadderResult } from './model/ladder';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Workout } from './model/workout';
import { Contestant } from './model/contestant';
import { Router } from '@angular/router';
import { DbResult, Result } from './model/result';


@Injectable({
  providedIn: 'root'
})
export class SourceService {

  constructor(private http: HttpClient, private router: Router) {
  }

  public getResults(): Observable<{ data: Result[] }> {
    return this.http.get<{ data: Result[] }>('/api/result');
  }
  public editResult(result: DbResult) {

    const config = { headers: new HttpHeaders().set('Content-Type', 'application/json') };
    this.http.put<any>('/api/result', JSON.stringify(result), config).subscribe();
  }
  public addResult(result: DbResult) {

    const config = { headers: new HttpHeaders().set('Content-Type', 'application/json') };
    this.http.post<any>('/api/result', JSON.stringify(result), config).subscribe();
  }

  public deleteResult(id:number) {

    const config = { headers: new HttpHeaders().set('Content-Type', 'application/json') };
    this.http.delete<any>('/api/result?id='+id,  config).subscribe();
  }

  public getLadder(gender: string = 'm'): Observable<{ data: LadderResult[] }> {
    return this.http.get<{ data: LadderResult[] }>('/api/ladder?gender=' + gender);
  }

  public getWorkouts(): Observable<{ data: Workout[] }> {
    return this.http.get<{ data: Workout[] }>('/api/workout');
  }

  public editWorkout(workout: Workout) {

    const config = { headers: new HttpHeaders().set('Content-Type', 'application/json') };
    this.http.put<any>('/api/workout', JSON.stringify(workout), config).subscribe();
  }

  public addWorkout(workout: Workout) {

    const config = { headers: new HttpHeaders().set('Content-Type', 'application/json') };
    this.http.post<any>('/api/workout', JSON.stringify(workout), config).subscribe();
  }

  public getContestants(): Observable<{ data: Contestant[] }> {
    return this.http.get<{ data: Contestant[] }>('/api/contestants');
  }

  public editContestant(contestant: Contestant) {

    const config = { headers: new HttpHeaders().set('Content-Type', 'application/json') };
    this.http.put<any>('/api/contestants', JSON.stringify(contestant), config).subscribe();
  }

  public addContestant(contestant: Contestant) {

    const config = { headers: new HttpHeaders().set('Content-Type', 'application/json') };
    this.http.post<any>('/api/contestants', JSON.stringify(contestant), config).subscribe();
  }

}
