import { PaymentMethod } from './../../../models/paymentmethod';
import { UtilService} from './../../../services/util.service';
import { LoginService } from './../../../services/login.service';
import { GlobalService } from './../../../services/global.service';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { NgForm } from '@angular/forms';
import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';

//import { Slug } from 'ng2-slugify';

@Component({
  selector: 'app-donations-purposes-create',
  templateUrl: './donations-purposes-create.component.html',
  styleUrls: ['./donations-purposes-create.component.css']
})

export class DonationsPurposesCreateComponent implements OnInit {

  dp_title: string;
  dp_slug: string;
  dp_html_content: string;

  private donationsPurposesRoute = GlobalService.baseUrl + "/secure/donations-purposes";

  constructor(
    private http: HttpClient,
    private loginService: LoginService,
    private router: Router
  ) { }

  ngOnInit() {
    
  }

  createDonationPurpose(f: NgForm){    

    if (f.valid){
      console.log(f.value);  

      const req = this.http.post(this.donationsPurposesRoute, 
        //Body
        {
            title: f.value.dp_title,
            html_content: f.value.dp_html_content,
            slug: f.value.dp_slug
        },
        //Headers  
        {

          headers: new HttpHeaders().set('Authorization', 'Bearer '+this.loginService.getUserToken())
      
        }
      ).subscribe(
          res => {
            console.log("RESPONSE=>", res);
            this.router.navigate(["admin/donations-purposes"]);
          },
          err => {
            console.log("ERROR=>",err.statusText);
            this.router.navigate(["/signin"]);
          }
        );
    }
  }

  public generateSlug(): void {
    this.dp_slug = UtilService.slugify(this.dp_title);
    //console.log(this.dp_slug);
  }
}
