import { Injectable, Inject } from '@angular/core';
import {LOCAL_STORAGE, SESSION_STORAGE, WebStorageService} from 'angular-webstorage-service';
import { Router } from '@angular/router';


@Injectable()
export class LoginService {

  constructor(
      @Inject(LOCAL_STORAGE) private localstorage: WebStorageService,
      @Inject(SESSION_STORAGE) private sessionstorage: WebStorageService,
      private router: Router
    ) { }
 
  setUserToken(token) {
      this.localstorage.set("userToken", token);
  }

  getUserToken(){
      return this.localstorage.get("userToken");
  }

  setUserInfo(user){

    this.sessionstorage.set("UserInfo", JSON.stringify(user));

  }

  getUserInfo(){

    return JSON.parse(this.sessionstorage.get("UserInfo"));

  }

  logOut() {
    this.localstorage.remove("userToken");
    this.sessionstorage.remove("UserInfo");
    this.router.navigate(["/signin"]);

  }
}
