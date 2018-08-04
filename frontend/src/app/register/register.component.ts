import { LoginService } from './../services/login.service';
import { GlobalService } from './../services/global.service';
import { Httpres } from './../models/httpres';
import { NgForm } from '@angular/forms';
import { HttpClient } from '@angular/common/http';
import { Router } from '@angular/router';
import { Component, OnInit, ViewChild } from '@angular/core';
import { User } from '../models/user';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css']
})
export class RegisterComponent implements OnInit {

  private res: Httpres;
  public loading = false;
  user: User = {
    name: '',
    email: '',
    phone: '',
    address: '',
    site: '',
    cpf: '',
    dtregister: '',
    login: '',
    senha: ''
  }

  emailPattern = "[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$";
  phonePattern = "[\+]\d{2}[\(]\d{2}[\)]\d{4}[\-]\d{4}$";


  private registerRoute = GlobalService.baseUrl + "/user/register";

  @ViewChild('registerForm') form: any;

  constructor(
    private http: HttpClient, 
    private router: Router,
    private loginService: LoginService) {}

  ngOnInit() {
    //console.log(this.TestaCPF('04983863418'));
  }

  testaCPF(strCPF) {
    let Soma;
    let Resto;
    Soma = 0;
    if (strCPF == "00000000000") return false;
     
    for (let i=1; i<=9; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);
    Resto = (Soma * 10) % 11;
     
    if ((Resto == 10) || (Resto == 11))  Resto = 0;
    if (Resto != parseInt(strCPF.substring(9, 10)) ) return false;
     
    Soma = 0;
    for (let i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
    Resto = (Soma * 10) % 11;
     
    if ((Resto == 10) || (Resto == 11))  Resto = 0;
    if (Resto != parseInt(strCPF.substring(10, 11) ) ) return false;
    return true;
}

  register({value, valid}: {value: User, valid: boolean}) {


    /*if (f.value.password != f.value.retyped_password){ 

      alert("A senha e a confirmação estão diferentes");
      return;

    }*/
    
    if (valid){
     /*this.loading = true;
     const req = this.http.post<Httpres>(this.registerRoute, value)
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
      );*/
      console.log("VALID!", this.user);
    }
    else {
      console.log("NOT VALID!");
    }
  }

}
