import { Router } from '@angular/router';

import { LoginService } from './../services/login.service';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { GlobalService } from './../services/global.service';
import { Httpres } from './../models/httpres';
import { Component, OnInit, OnDestroy } from '@angular/core';
import { User } from '../models/user';
import { UtilService } from './../services/util.service';
import { UserProfile } from '../models/userprofile';

@Component({
  selector: 'app-admin',
  templateUrl: './admin.component.html',
  styleUrls: ['./admin.component.css']
})
export class AdminComponent implements OnInit, OnDestroy {

  bodyClasses = 'skin-blue sidebar-mini';
  body: HTMLBodyElement = document.getElementsByTagName('body')[0];

  private res: Httpres;
  user: UserProfile;

  private userPersonalDataProfileRoute = GlobalService.baseUrl + "/secure/user-personaldata-profile";

  constructor(
    private http: HttpClient, 
    private loginService: LoginService,
    private router: Router,
  ) { }

  ngOnInit() {
    // add the the body classes
    this.body.classList.add('skin-blue');
    this.body.classList.add('sidebar-mini');

    //UPDATE THIS LATER
    /*if (this.loginService.getUserInfo()){
      this.user = this.loginService.getUserInfo()
    }
    else{*/
      this.loadUserInfo();
    //}
  }

   ngOnDestroy() {
    // remove the the body classes
    this.body.classList.remove('skin-blue');
    this.body.classList.remove('sidebar-mini');

  }

  loadUserInfo(){
    this.http.get<UserProfile>(this.userPersonalDataProfileRoute,{

      headers: new HttpHeaders().set('Authorization', 'Bearer '+this.loginService.getUserToken())
  
    }).subscribe(
      res => {
      this.user = res;
      this.user.name = UtilService.nomeResumido(this.user.name);
      console.log("USER AUTENTICADO=>",this.user);
      this.loginService.setUserInfo(this.user);
    },
        err => {
          console.log("ERROR=>",err);
          this.router.navigate(["/signin"]);
          //this.alertService.error("ERROR=>" + err.statusText + "Consulte os Logs");

        }
  );
  }

}
