import { Injectable, Inject } from '@angular/core';
import {LOCAL_STORAGE, SESSION_STORAGE, WebStorageService} from 'angular-webstorage-service';


@Injectable()
export class LoginService {

  constructor(
      @Inject(LOCAL_STORAGE) private localstorage: WebStorageService,
      @Inject(SESSION_STORAGE) private sessionstorage: WebStorageService  
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
}
