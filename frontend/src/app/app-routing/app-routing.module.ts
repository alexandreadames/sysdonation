import { NotfoundComponent } from './../notfound/notfound.component';
import { DonationpurposepageComponent } from './../donationpurposepage/donationpurposepage.component';
import { RegisterComponent } from './../register/register.component';
import { FrontpageComponent } from './../frontpage/frontpage.component';
import { AdminDashboard2Component } from './../admin/admin-dashboard2/admin-dashboard2.component';
import { AdminDashboard1Component } from './../admin/admin-dashboard1/admin-dashboard1.component';
import { StarterComponent } from './../starter/starter.component';
import { AdminComponent } from './../admin/admin.component';
import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterModule } from '@angular/router';
import { LoginComponent } from '../login/login.component';
import { UserpageComponent } from '../userpage/userpage.component';

@NgModule({
  imports: [
    RouterModule.forRoot([
      //{ path: '', redirectTo: 'frontpage', pathMatch: 'full' },
      { path: '', component: FrontpageComponent },
      { path: 'starter', component: StarterComponent },
      { path: 'signin', component: LoginComponent },
      { path: 'register', component: RegisterComponent },
      { path: 'page/:username', component: UserpageComponent },
      { path: 'page/:username/:donation-purpose-slug', component: DonationpurposepageComponent },
      //{ path: '404', component: NotfoundComponent },
      //{ path: '**', redirectTo: '404' }
    ])
  ],
  declarations: [],
  exports: [ RouterModule]
})
export class AppRoutingModule { }
