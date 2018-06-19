import { AlertService } from './../_services/alert.service';
import { Httpres } from '../models/httpres';
import { GlobalService } from '../services/global.service';
import { Component, OnInit } from '@angular/core';
import { NgForm } from '@angular/forms';
import { HttpClient } from '@angular/common/http';
import { Router } from '@angular/router';
import { LoginService } from '../services/login.service';


@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {

  private res: Httpres;

  private loginRoute = GlobalService.baseUrl + "/user/login";

  constructor(private http: HttpClient, 
    private router: Router, 
    private loginService: LoginService,
    private alertService: AlertService) {}

  ngOnInit() {
  }

  login(f: NgForm) {

    console.log(f.value);  // { first: '', last: '' }
    console.log(f.valid);  // false
    
    if (f.valid){
      const req = this.http.post<Httpres>(this.loginRoute, {
      login: f.value.login,
      password: f.value.password
    })
      .subscribe(
        res => {
          if (!res.error){
            console.log("DATA=>", res.data);
            this.loginService.setUserToken(res.data.token);
            this.router.navigate(["/admin"]);
          }
          else{
            console.log(res.msg);
            this.alertService.error(res.msg);  
          }
        },
        err => {
          console.log("ERROR=>",err.statusText);
          this.alertService.error("ERROR=>" + err.statusText + "Consulte os Logs");

        }
      );
    }
  }

}
