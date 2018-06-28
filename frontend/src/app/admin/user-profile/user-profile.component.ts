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
  formPersonalData: FormGroup;
  loading: boolean = false;
  userProfile: UserProfile;
  userRes: UserRes;

  @ViewChild('fileInput') fileInput: ElementRef;

  private userProfileRoute = GlobalService.baseUrl + "/secure/user-profile";
  private userPersonalDataProfileRoute = GlobalService.baseUrl + "/secure/user-personaldata-profile";
  private userPersonalDataRoute = GlobalService.baseUrl + "/secure/person/update";

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

    this.formPersonalData = this.fb.group({
      name: ['', Validators.required],
      email: ['', Validators.required],
      phone: ['', Validators.required],
      site: ['', Validators.required],
      address: ['', Validators.required],
      cpf: ['', Validators.required]
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

  onSubmitPersonalData(){
    const formPersonalDataModel = this.formPersonalData.value;
    //console.log(formPersonalDataModel);
    const req = this.http.post<Httpres>(this.userPersonalDataRoute, 
      //Body
      formPersonalDataModel,
  
       //Headers  
       {
  
        headers: new HttpHeaders().set('Authorization', 'Bearer '+this.loginService.getUserToken())
    
      }
    
    )
      .subscribe(
        res => {
          if (!res.error){
            console.log("RESPONSE=>",res);
          }
          else{
            console.log("RESPONSE=>",res);
          }
        },
        err => {
          console.log("ERROR=>",err);
        }
      );
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
    this.http.get<UserProfile>(this.userPersonalDataProfileRoute,{

      headers: new HttpHeaders().set('Authorization', 'Bearer '+this.loginService.getUserToken())
  
    }).subscribe(
      res => {
      console.log("USER_PROFILE_DATA=>", res);
      this.userProfile = res;
      
      //Personal Data
      this.formPersonalData.get('name').setValue(this.userProfile.name);
      this.formPersonalData.get('email').setValue(this.userProfile.email);
      this.formPersonalData.get('phone').setValue(this.userProfile.phone);
      this.formPersonalData.get('site').setValue(this.userProfile.site);
      this.formPersonalData.get('address').setValue(this.userProfile.address);
      this.formPersonalData.get('cpf').setValue(this.userProfile.cpf);

      //User Profile
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
