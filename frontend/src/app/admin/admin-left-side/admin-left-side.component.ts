import { UserprofileService } from './../../services/userprofile.service';
import { UtilService } from './../../services/util.service';
import { User } from './../../models/user';
import { Component, OnInit, Input } from '@angular/core';
import { UserProfile } from '../../models/userprofile';

export class UserRes{
  name: string;
  foto: string;
}

@Component({
  selector: 'app-admin-left-side',
  templateUrl: './admin-left-side.component.html',
  styleUrls: ['./admin-left-side.component.css']
})
export class AdminLeftSideComponent implements OnInit {

  @Input('user') user: UserProfile;
  private userRes: UserRes;

  constructor(private userprofileService: UserprofileService) { }

  ngOnInit() {
    this.userprofileService.currentUser.subscribe(
      user => this.userRes = user
    )
    console.log("USER=>",this.user);
  }
  
}
