import { LoginService } from './../services/login.service';
import { GlobalService } from './../services/global.service';
import { Httpres } from './../models/httpres';
import { NgForm } from '@angular/forms';
import { HttpClient } from '@angular/common/http';
import { Router } from '@angular/router';
import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css']
})
export class RegisterComponent implements OnInit {

  private res: Httpres;
  public loading = false;

  private registerRoute = GlobalService.baseUrl + "/user/register";

  constructor(
    private http: HttpClient, 
    private router: Router,
    private loginService: LoginService) {}

  ngOnInit() {
  }

  register(f: NgForm) {

    console.log(f.value);  // { first: '', last: '' }
    console.log(f.valid);  // false

    if (f.value.password != f.value.retyped_password){ 

      alert("A senha e a confirmação estão diferentes");
      return;

    }
    
    if (f.valid){
     this.loading = true;
     const req = this.http.post<Httpres>(this.registerRoute, {
        name: f.value.name,
        email: f.value.email,
        phone: f.value.phone,
        address: f.value.address,
        site: f.value.site,
        cpf: f.value.cpf,
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
            alert("Ocorreu um erro ao tentar ao realizar o registro");
            console.log(res.msg);
          }
          this.loading = false;
        },
        err => {
          alert("Ocorreu um erro ao tentar ao realizar o registro");
          console.log("Error occured");
          this.loading = false;
        }
      );
    }
  }

}
