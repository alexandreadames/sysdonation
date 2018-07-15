import { LoginService } from './../services/login.service';
import { GlobalService } from './../services/global.service';
import { HttpClient } from '@angular/common/http';
import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';

@Component({
  selector: 'app-frontpage',
  templateUrl: './frontpage.component.html',
  styleUrls: ['./frontpage.component.css']
})
export class FrontpageComponent implements OnInit {

  login:string;
  donations_purposes: {};
  private donationsPurposesRoute = GlobalService.baseUrl + "/donations-purposes";
  user_logged: boolean = false;


  constructor(
    private route:ActivatedRoute,
    private http: HttpClient, 
    private router: Router,
    private loginService: LoginService
  ) { }

  ngOnInit() {
      /*this.route.params.subscribe( params =>
        this.login = params['login']
      )*/

    //UPDATE THIS LATER
    if (this.loginService.getUserInfo()){
      this.user_logged = true;
    }
      this.loadDonationsPurposes();

  }

  loadDonationsPurposes(){
    this.http.get(this.donationsPurposesRoute).subscribe(
      res => {
      console.log("RESULT=>", res);
      this.donations_purposes = res;
    },
        err => {
          console.log("ERROR=>",err);
          //this.router.navigate(["/signin"]);
          //this.alertService.error("ERROR=>" + err.statusText + "Consulte os Logs");

        }
  );
  }

}
