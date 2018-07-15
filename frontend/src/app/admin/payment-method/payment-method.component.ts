import { PaymentMethod } from './../../models/paymentmethod';
import { LoginService } from './../../services/login.service';
import { GlobalService } from './../../services/global.service';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { NgForm } from '@angular/forms';
import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-payment-method',
  templateUrl: './payment-method.component.html',
  styleUrls: ['./payment-method.component.css']
})
export class PaymentMethodComponent implements OnInit {

  private paymentMethodRoute = GlobalService.baseUrl + "/secure/payment-method";
  pm_client_id: string;
  pm_client_secret: string;
  public static readonly PAYMENT_METHOD_DESC = "Mercado Pago";

  constructor(
    private http: HttpClient,
    private loginService: LoginService
  ) { }

  ngOnInit() {
    this.loadPaymentMethodCredentials();
  }

  createOrUpdatePaymentMethod(f: NgForm){    

    if (f.valid){
      console.log("FORM DATA=>",f.value);

      const req = this.http.post(this.paymentMethodRoute, 
        //Body
        {
          'description' :  PaymentMethodComponent.PAYMENT_METHOD_DESC,
          'clientid': f.value.pm_client_id,
          'clientsecret': f.value.pm_client_secret
        },
    
         //Headers  
         {
    
          headers: new HttpHeaders().set('Authorization', 'Bearer '+this.loginService.getUserToken())
      
        }
      
      )
        .subscribe(
          res => {
            console.log("RESPONSE=>",res);
          },
          err => {
            console.log("ERROR=>",err);
          }
        );

    }
  }    

  loadPaymentMethodCredentials(){
    this.http.get<PaymentMethod>(this.paymentMethodRoute,{

      headers: new HttpHeaders().set('Authorization', 'Bearer '+this.loginService.getUserToken())
  
    }).subscribe(
      res => {
      console.log("PAYMENT_METHOD_DATA=>", res);
      this.pm_client_id = res.client_id;
      this.pm_client_secret = res.client_secret;  
    },
        err => {
          console.log("ERROR=>",err);

        }
  );
  }
}
