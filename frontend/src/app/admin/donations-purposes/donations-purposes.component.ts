import { PaymentMethod } from './../../models/paymentmethod';
import { LoginService } from './../../services/login.service';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { GlobalService } from './../../services/global.service';
import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-donations-purposes',
  templateUrl: './donations-purposes.component.html',
  styleUrls: ['./donations-purposes.component.css']
})
export class DonationsPurposesComponent implements OnInit {

  private donationsPurposesUserRoute = GlobalService.baseUrl + "/secure/donations-purposes"; 
  private donationPurposeRoute = GlobalService.baseUrl + "/secure/donation-purpose"; 
  donationsPurposes;
  private paymentMethodRoute = GlobalService.baseUrl + "/secure/payment-method";

  constructor(
    private http: HttpClient,
    private loginService: LoginService,
    private router: Router

  ) { }

  ngOnInit() {
    this.loadDonationsPurposes();
  }

  loadDonationsPurposes() {
    this.http.get(this.donationsPurposesUserRoute,{

      headers: new HttpHeaders().set('Authorization', 'Bearer '+this.loginService.getUserToken())
  
    }).subscribe(
      res => {
        console.log("RESPONSE=>", res);
        this.donationsPurposes = res;
    },
        err => {
          console.log("ERROR=>",err);

        }
  );
  }

  deleteDonationPurpose(id){

    if(confirm("Tem certeza que deseja deletar esse registro")) {
      console.log("Deleting..."+id);
      this.http.delete(this.donationPurposeRoute+"/"+id,{

        headers: new HttpHeaders().set('Authorization', 'Bearer '+this.loginService.getUserToken())
    
      }).subscribe(
        res => {
          console.log("RESPONSE=>", res);
          this.loadDonationsPurposes();
      },
          err => {
            console.log("ERROR=>",err);
  
          }
    );
    }
    else{
      console.log("Dont Delete pls");
    }

  }

  //Check if payment-method is setted
  createDonationPurpose(){
      this.http.get<PaymentMethod>(this.paymentMethodRoute,{
  
        headers: new HttpHeaders().set('Authorization', 'Bearer '+this.loginService.getUserToken())
    
      }).subscribe(
        res => {
        if (!res.client_id){
          alert("Antes de criar uma finalidade é necessário configurar um método de pagamento");
          this.router.navigate(["admin/payment-method"]);
        }
        else{
          this.router.navigate(["admin/donations-purposes/create"]);
        }
      },
          err => {
            console.log("ERROR=>",err);
  
          }
    );
  }

  editDonationPurpose(id){

    alert("Essa funcionalidade vai ser implementada futuramente!");

  }


}
