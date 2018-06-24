import { Injectable } from '@angular/core';
import { BehaviorSubject } from 'rxjs';

export class UserRes{
  name: string;
  foto: string;
}


@Injectable()
export class UserprofileService {

  private user: UserRes;

  private userSource = new BehaviorSubject(this.user);
  currentUser = this.userSource.asObservable();

  constructor() { }

  updateProfile(user: UserRes) {
    this.userSource.next(user);
  }
}
