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

  static slugify(text: string){
    {
      var from = "ãàáäâẽèéëêìíïîõòóöôùúüûñç·/_,:;";
      var to   = "aaaaaeeeeeiiiiooooouuuunc------";
      for (var i = 0, len = from.length; i < len; i++){
          text = text.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
      }
      return text
          .toString()                     // Cast to string
          .toLowerCase()                  // Convert the string to lowercase letters
          .trim()                         // Remove whitespace from both sides of a string
          .replace(/\s+/g, '-')           // Replace spaces with -
          .replace(/&/g, '-y-')           // Replace & with 'and'
          .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
          .replace(/\-\-+/g, '-');        // Replace multiple - with single -

}
