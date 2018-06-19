import { Injectable } from '@angular/core';

@Injectable()
export class GlobalService {

  public static baseUrl = "http://localhost/sysdonation/api/v1";

  constructor() { }

}
