import { UtilService } from './../../services/util.service';
import { User } from './../../models/user';
import { Component, OnInit, Input } from '@angular/core';

@Component({
  selector: 'app-admin-left-side',
  templateUrl: './admin-left-side.component.html',
  styleUrls: ['./admin-left-side.component.css']
})
export class AdminLeftSideComponent implements OnInit {

  @Input('user') user: User;

  constructor() { }

  ngOnInit() {
  }

}
