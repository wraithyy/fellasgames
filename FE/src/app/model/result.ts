import { Contestant } from './contestant';
import { Workout } from './workout';

export class Result{
  id: number;
  result: number;
  contestant: Contestant
  workout: Workout
  rx: number;

}

export class DbResult{
  id: number;
  result: number;
  id_workout: number;
  id_contestant: number;
  id_judge: number;
  rx: number;
}
