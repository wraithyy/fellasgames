import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { LadderComponent } from './ladder/ladder.component';
import { HttpClientModule } from '@angular/common/http';
import { HashLocationStrategy, LocationStrategy } from '@angular/common';
import { LoginComponent } from './login/login.component';
import { AdminComponent } from './admin/admin.component';
import { FormsModule } from '@angular/forms';
import { ResultsComponent } from './results/results.component';
import { SelectDropDownModule } from 'ngx-select-dropdown';


@NgModule({
  declarations: [
    AppComponent,
    LadderComponent,
    LoginComponent,
    AdminComponent,
    ResultsComponent
  ],
  imports: [
    BrowserModule,
    SelectDropDownModule,
    AppRoutingModule,
    HttpClientModule,
    FormsModule
  ],
  providers: [{provide: LocationStrategy, useClass: HashLocationStrategy}],
  bootstrap: [AppComponent]
})
export class AppModule { }
