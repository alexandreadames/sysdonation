import { JwtHelperService } from '@auth0/angular-jwt';
import { AdminRoutingModule } from './admin-routing/admin-routing.module';
import { AdminDashboard1Component } from './admin-dashboard1/admin-dashboard1.component';
import { AdminControlSidebarComponent } from './admin-control-sidebar/admin-control-sidebar.component';
import { AdminFooterComponent } from './admin-footer/admin-footer.component';
import { AdminContentComponent } from './admin-content/admin-content.component';
import { AdminLeftSideComponent } from './admin-left-side/admin-left-side.component';
import { AdminHeaderComponent } from './admin-header/admin-header.component';
import { AdminComponent } from './admin.component';
import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { AdminDashboard2Component } from './admin-dashboard2/admin-dashboard2.component';
import { DonationsPurposesComponent } from './donations-purposes/donations-purposes.component';
import { DonationsPurposesCreateComponent } from './donations-purposes/donations-purposes-create/donations-purposes-create.component';

import { CKEditorModule } from 'ngx-ckeditor';
import { UserProfileComponent } from './user-profile/user-profile.component';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { UserprofileService } from '../services/userprofile.service';
import { PaymentMethodComponent } from './payment-method/payment-method.component';
import { MyDonationsComponent } from './my-donations/my-donations.component';



@NgModule({
  imports: [
    CommonModule,
    AdminRoutingModule,
    CKEditorModule,
    FormsModule,    //added here too
    ReactiveFormsModule //added here too
  ],
  declarations: [
    AdminComponent,
    AdminHeaderComponent,
    AdminLeftSideComponent,
    AdminContentComponent,
    AdminFooterComponent,
    AdminControlSidebarComponent,
    AdminDashboard1Component,
    AdminDashboard2Component,
    DonationsPurposesComponent,
    DonationsPurposesCreateComponent,
    UserProfileComponent,
    PaymentMethodComponent,
    MyDonationsComponent
  ],
  exports: [AdminComponent],
  providers: [UserprofileService, JwtHelperService]
})
export class AdminModule { }
