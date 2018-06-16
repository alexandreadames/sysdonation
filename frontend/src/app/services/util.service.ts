import { Injectable } from '@angular/core';

@Injectable()
export class UtilService {

  constructor() { }

  static nomeResumido(fullName){
    fullName = fullName.split(' ');
    var firstName = fullName[0];
    var lastName = fullName[fullName.length - 1];
    return firstName+" "+lastName;
  }

}
