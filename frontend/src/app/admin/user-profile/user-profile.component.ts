import { UserprofileService} from './../../services/userprofile.service';
import { UserProfile } from './../../models/userprofile';
import { LoginService } from './../../services/login.service';
import { Httpres } from './../../models/httpres';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { GlobalService } from './../../services/global.service';
import { Component, ElementRef, ViewChild, OnInit } from '@angular/core';
import {FormBuilder, FormGroup, Validators} from "@angular/forms";

class UserRes{
  name: string;
  foto: string;
}

@Component({
  selector: 'app-user-profile',
  templateUrl: './user-profile.component.html',
  styleUrls: ['./user-profile.component.css']
})
export class UserProfileComponent implements OnInit {
  
  form: FormGroup;
  loading: boolean = false;
  userProfile: UserProfile;
  userRes: UserRes;

  @ViewChild('fileInput') fileInput: ElementRef;

  private userProfileRoute = GlobalService.baseUrl + "/secure/user-profile";

  constructor(
    private fb: FormBuilder,
    private http: HttpClient,
    private loginService: LoginService,
    private userprofileService: UserprofileService
  ) { 
    this.createForm();
  }

  ngOnInit() {
    
    this.userRes = {
      'name':'test',
      'foto' : 'foto'
    };

    this.loadProfile();
  }

  createForm() {
    this.form = this.fb.group({
      description: ['', Validators.required],
      occupation: ['', Validators.required],
      avatar: null
    });
  }

  onFileChange(event) {
    let reader = new FileReader();
    if(event.target.files && event.target.files.length > 0) {
      let file = event.target.files[0];
      reader.readAsDataURL(file);
      reader.onload = () => {
        this.form.get('avatar').setValue({
          filename: file.name,
          filetype: file.type,
          value: reader.result.split(',')[1]
        })
      };
    }
  }

  onSubmit() {
    const formModel = this.form.value;
    this.loading = true;
    console.log(formModel);
    // In a real-world app you'd have a http request / service call here like
    // this.http.post('apiUrl', formModel)
    // setTimeout(() => {
    //   console.log(formModel);
    //   alert('done!');
    //   this.loading = false;
    // }, 1000);
    
   const req = this.http.post<Httpres>(this.userProfileRoute, 
    //Body
    formModel,

     //Headers  
     {

      headers: new HttpHeaders().set('Authorization', 'Bearer '+this.loginService.getUserToken())
  
    }
  
  )
    .subscribe(
      res => {
        if (!res.error){
          console.log("RESPONSE=>",res);
          this.loading = false;
          this.loadProfile();
        }
        else{
          console.log("RESPONSE=>",res);
          this.loading = false;
        }
      },
      err => {
        console.log("ERROR=>",err);
        this.loading = false;
      }
    );
  }

  clearFile() {
    this.form.get('avatar').setValue(null);
    this.fileInput.nativeElement.value = '';
  }

  loadProfile(){
    this.http.get<UserProfile>(this.userProfileRoute,{

      headers: new HttpHeaders().set('Authorization', 'Bearer '+this.loginService.getUserToken())
  
    }).subscribe(
      res => {
      console.log("USER_PROFILE_DATA=>", res);
      this.userProfile = res;
      this.form.get('description').setValue(this.userProfile.description);
      this.form.get('occupation').setValue(this.userProfile.occupation);
    },
        err => {
          console.log("ERROR=>",err);

        }
  );
  }

  uploadProfilePLS(event){
    this.userprofileService.updateProfile(
      this.userRes
    );
  }
}
