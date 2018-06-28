import { UserProfile } from './../../models/userprofile';
import { User } from './../../models/user';
import { LoginService } from './../../services/login.service';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Httpres } from './../../models/httpres';
import { GlobalService } from './../../services/global.service';
import { Component, OnInit, Input } from '@angular/core';

@Component({
  selector: 'app-admin-header',
  templateUrl: './admin-header.component.html',
  styleUrls: ['./admin-header.component.css']
})
export class AdminHeaderComponent implements OnInit {

  @Input('user') user: UserProfile;

  constructor(private loginService: LoginService) { 


  }

  
  ngOnInit() {


    //this.loadUserInfo();

  }

  public loadUserInfo(){

    //this.user = this.loginService.getUserInfo();
   // console.log(this.user);


  }

}
