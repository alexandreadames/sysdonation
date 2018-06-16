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

  private registerRoute = GlobalService.baseUrl + "/user/register";

  constructor(private http: HttpClient, private router: Router) {}

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
          
          console.log(res);

          if (!res.error){
            this.router.navigate(["/admin"]);
          }
        },
        err => {
          console.log("Error occured");
        }
      );
    }
  }

}
