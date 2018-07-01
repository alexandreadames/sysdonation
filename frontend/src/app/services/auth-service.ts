import { Injectable } from '@angular/core';
import { JwtHelperService } from '@auth0/angular-jwt';


@Injectable()
export class AuthService {
  constructor() {}
  // ...
  public isAuthenticated(): boolean {
    const jwtHelper = new JwtHelperService();
    const token = localStorage.getItem('userToken');
    // Check whether the token is expired and return
    // true or false
    var tokenExpired = jwtHelper.isTokenExpired(token);
    if (!token || tokenExpired){
      return false;
    }
    else {
      return true;
    }
  }
}