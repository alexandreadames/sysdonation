import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-userpage',
  templateUrl: './userpage.component.html',
  styleUrls: ['./userpage.component.css']
})
export class UserpageComponent implements OnInit {

  username: string;

  constructor(
    private router: Router,
    private route:ActivatedRoute,
  ) { }

  ngOnInit() {

    this.route.params.subscribe( params =>
      this.username = params['username']
    )
  }

}
