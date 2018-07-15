import { Injectable } from '@angular/core';

@Injectable()
export class GlobalService {

  //Production
  //public static baseUrl = "https://alexandrep.sgedu.site/sysdonation/api/v1";

  //Dev
  public static baseUrl = "http://localhost/sysdonation/api/v1";

  constructor() { }

}
