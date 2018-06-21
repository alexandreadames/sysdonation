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

  private dp_title: string;
  private dp_slug: string;
  //private slug = new Slug('default'); // this will use 'default' keymap

  private donationsPurposesRoute = GlobalService.baseUrl + "/secure/donations-purposes/create";

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
