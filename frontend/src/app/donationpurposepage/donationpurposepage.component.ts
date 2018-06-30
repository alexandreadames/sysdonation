import { NgForm } from '@angular/forms';
import { Donation } from '../models/donation';
import { GlobalService } from './../services/global.service';
import { HttpClient } from '@angular/common/http';
import { DonationPurposePageRes } from './../models/donationpurposepage';
import { ActivatedRoute, Router } from '@angular/router';
import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-donationpurposepage',
  templateUrl: './donationpurposepage.component.html',
  styleUrls: ['./donationpurposepage.component.css']
})

export class DonationpurposepageComponent implements OnInit {

  username: string;
  donationPurposePageSlug: string;
  private donationsPurposesRoute = GlobalService.baseUrl + "/donations-purposes";
  donationPurposePageData: {};
  donation: Donation;


  constructor(
    private route:ActivatedRoute,
    private http: HttpClient,
    private router: Router) { }

  ngOnInit() {

    this.route.params.subscribe( params =>
      {
        this.username = params['username'];
        this.donationPurposePageSlug = params['donation-purpose-slug'];
        this.loadDonationPurposePage(this.username, this.donationPurposePageSlug);
      }
    )

  }

  loadDonationPurposePage(username, donationPurposePageSlug) {
    this.http.get<DonationPurposePageRes>(this.donationsPurposesRoute+"/"+username+"/"+donationPurposePageSlug).subscribe(
      res => {
      console.log("RESULT=>", res);
      if (!res.error){
        this.donationPurposePageData = res;
      }
      else{
        this.router.navigate(["404"]);
      }
    },
        err => {
          console.log("ERROR=>",err);
          this.router.navigate(["404"]);
          

        }
  );
  }

  makeADonation(f: NgForm) {
    if (f.valid){
      console.log(f.value);
    }
  }

}
