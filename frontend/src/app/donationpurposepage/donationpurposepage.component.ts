import { ActivatedRoute } from '@angular/router';
import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-donationpurposepage',
  templateUrl: './donationpurposepage.component.html',
  styleUrls: ['./donationpurposepage.component.css']
})
export class DonationpurposepageComponent implements OnInit {

  username: string;
  donationPurposePageSlug: string;

  constructor(private route:ActivatedRoute) { }

  ngOnInit() {

    this.route.params.subscribe( params =>
      //this.username = params['username']
      {
        this.username = params['username'];
        this.donationPurposePageSlug = params['donation-purpose-slug'];
      }
    )

  }

}
