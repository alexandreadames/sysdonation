import { AuthGuardService } from './../../services/auth-guard.service';
import { PaymentMethodComponent } from './../payment-method/payment-method.component';
import { NotfoundComponent } from './../../notfound/notfound.component';
import { UserProfileComponent } from './../user-profile/user-profile.component';
import { AdminDashboard1Component } from './../admin-dashboard1/admin-dashboard1.component';
import { AdminComponent } from './../admin.component';
import { NgModule, Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterModule } from '@angular/router';
import { Routes } from "@angular/router";
import { DonationsPurposesComponent } from '../donations-purposes/donations-purposes.component';
import { DonationsPurposesCreateComponent } from '../donations-purposes/donations-purposes-create/donations-purposes-create.component';
import { 
  AuthGuardService as AuthGuard 
} from '../../services/auth-guard.service';

@NgModule({
  imports: [
    RouterModule.forChild([
      {
        path: 'admin',
        component: AdminComponent,
        canActivate: [AuthGuard],
        children: [
          {
            path: '',
            redirectTo: 'dashboard',
            pathMatch: 'full'
          },
          {
            path: 'dashboard',
            component: AdminDashboard1Component
          },
          {
            path: 'donations-purposes',
            component: DonationsPurposesComponent
          },
          {
            path: 'donations-purposes/create',
            component: DonationsPurposesCreateComponent
          },
          {
            path: 'user-profile',
            component: UserProfileComponent
          },
          {
            path: 'payment-method',
            component: PaymentMethodComponent
          }
          
        ]
        
      },
      { path: '404', component: NotfoundComponent },
      { path: '**', redirectTo: '404' }
    ])
  ],
  exports: [
    RouterModule
  ]
})
export class AdminRoutingModule { }
