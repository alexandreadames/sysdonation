
import { LoginService } from './../services/login.service';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { GlobalService } from './../services/global.service';
import { Httpres } from './../models/httpres';
import { Component, OnInit, OnDestroy } from '@angular/core';
import { User } from '../models/user';
import { UtilService } from './../services/util.service';

@Component({
  selector: 'app-admin',
  templateUrl: './admin.component.html',
  styleUrls: ['./admin.component.css']
})
export class AdminComponent implements OnInit, OnDestroy {

  bodyClasses = 'skin-blue sidebar-mini';
  body: HTMLBodyElement = document.getElementsByTagName('body')[0];

  private res: Httpres;
  private user: User;

  private secureUserRoute = GlobalService.baseUrl + "/secure/user";

  constructor(private http: HttpClient, private loginService: LoginService) { }

  ngOnInit() {
    // add the the body classes
    this.body.classList.add('skin-blue');
    this.body.classList.add('sidebar-mini');

    if (this.loginService.getUserInfo()){
      this.user = this.loginService.getUserInfo()
    }
    else{
      this.loadUserInfo();
    }
  }

   ngOnDestroy() {
    // remove the the body classes
    this.body.classList.remove('skin-blue');
    this.body.classList.remove('sidebar-mini');

  }

  loadUserInfo(){
    this.http.get<User>(this.secureUserRoute,{

      headers: new HttpHeaders().set('X-Token', this.loginService.getUserToken())
  
    }).subscribe(res => {
      this.user = res;
      this.user.name = UtilService.nomeResumido(this.user.name);
      console.log("USER AUTENTICADO=>",this.user);
      this.loginService.setUserInfo(this.user);
    });
  }

}
