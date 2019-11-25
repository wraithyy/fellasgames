import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { LadderComponent } from './ladder/ladder.component';
import { AdminComponent } from './admin/admin.component';
import { ResultsComponent } from './results/results.component';


const routes: Routes = [{
  path: 'ladder',
  component: LadderComponent
},
  {
    path: 'ladder/:time',
    component: LadderComponent
  },{
  path: 'admin',
  component: AdminComponent
},{
  path: 'vysledek',
  component: ResultsComponent
},
  {
    path: '',
    redirectTo: '/ladder',
    pathMatch: 'full'
  },];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule {
}
