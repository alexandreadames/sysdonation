import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-frontpage',
  templateUrl: './frontpage.component.html',
  styleUrls: ['./frontpage.component.css']
})
export class FrontpageComponent implements OnInit {

  login:string;


  constructor(private route:ActivatedRoute) { }

  ngOnInit() {
      this.route.params.subscribe( params =>
        this.login = params['login']
      )

  }

}
