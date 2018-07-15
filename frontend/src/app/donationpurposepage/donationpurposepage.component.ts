import { NgForm } from '@angular/forms';
import { Donation } from '../models/donation';
import { GlobalService } from './../services/global.service';
import { HttpClient } from '@angular/common/http';
import { DonationPurposePageRes } from './../models/donationpurposepage';
import { ActivatedRoute, Router } from '@angular/router';
import { Component, OnInit } from '@angular/core';
import { DonationRes } from '../models/DonationRes';

@Component({
  selector: 'app-donationpurposepage',
  templateUrl: './donationpurposepage.component.html',
  styleUrls: ['./donationpurposepage.component.css']
})

export class DonationpurposepageComponent implements OnInit {

  username: string;
  donationPurposePageSlug: string;
  private donationsPurposesRoute = GlobalService.baseUrl + "/donations-purposes";
  private donationRoute = GlobalService.baseUrl + "/donation";
  donationPurposePageData: DonationPurposePageRes;
  donation: Donation;

  public loading = false;


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
      this.donation = f.value;
      this.donation.donation_title = this.donationPurposePageData.data.donationpurpose.title;
      this.donation.donation_code = this.donationPurposePageData.data.donationpurpose.slug;
      this.donation.donationpurpose_id = this.donationPurposePageData.data.donationpurpose.donationpurpose_id;
      this.donation.userid = this.donationPurposePageData.data.owner.iduser;
      console.log("DATA FOR SEND=>", this.donation);

      let donation: Donation = this.donation;
      this.loading = true;
      const req = this.http.post<DonationRes>(this.donationRoute, 
        donation
      )
        .subscribe(
          res => {
            if (!res.error){
              console.log(res);
              if (res.data.donation.mp_link_order){
                //Redirect to pagseguro
                window.location.href= res.data.donation.mp_link_order;
                this.loading = false;
              }
              
            }
            else{
              console.log(res.msg);
              alert(res.msg);
              this.loading = false;
            }
            
          },
          err => {
            console.log("ERROR=>",err.statusText);
            this.loading = false;
          }
        );

    }
  }

}
