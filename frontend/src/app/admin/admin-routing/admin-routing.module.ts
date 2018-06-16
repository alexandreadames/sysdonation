import { AdminDashboard1Component } from './../admin-dashboard1/admin-dashboard1.component';
import { AdminComponent } from './../admin.component';
import { NgModule, Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterModule } from '@angular/router';
import { Routes } from "@angular/router";
import { DonationsPurposesComponent } from '../donations-purposes/donations-purposes.component';
import { DonationsPurposesCreateComponent } from '../donations-purposes/donations-purposes-create/donations-purposes-create.component';

@NgModule({
  imports: [
    RouterModule.forChild([
      {
        path: 'admin',
        component: AdminComponent,
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
            /*children: [  
                {
                  path: 'create',
                  component: DonationsPurposesCreateComponent
                }
            ]*/
          },
          {
            path: 'donations-purposes/create',
            component: DonationsPurposesCreateComponent
          }
        ]
      }
    ])
  ],
  exports: [
    RouterModule
  ]
})
export class AdminRoutingModule { }
