import { LoginService } from './../../services/login.service';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { GlobalService } from './../../services/global.service';
import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-my-donations',
  templateUrl: './my-donations.component.html',
  styleUrls: ['./my-donations.component.css']
})
export class MyDonationsComponent implements OnInit {

  private mydonations;
  private donationsRoute = GlobalService.baseUrl + "/secure/donations"; 
  constructor(
    private http: HttpClient,
    private loginService: LoginService
  ) { }

  ngOnInit() {
    this.loadMyDonations();
  }

  loadMyDonations(){
    this.http.get(this.donationsRoute,{

      headers: new HttpHeaders().set('Authorization', 'Bearer '+this.loginService.getUserToken())
  
    }).subscribe(
      res => {
        console.log("RESPONSE=>", res);
        this.mydonations = res;
    },
        err => {
          console.log("ERROR=>",err);

        }
  );
  }

}
