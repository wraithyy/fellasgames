export class LadderResult{
  userid: number;
  firstname: string;
  lastname: string;
  nick: string;
  total: number;
  workouts:LadderWorkout[]
}
export class LadderWorkout{
  name: string;
  points: number;
  rx: boolean;
}
