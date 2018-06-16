import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DonationsPurposesCreateComponent } from './donations-purposes-create.component';

describe('DonationsPurposesCreateComponent', () => {
  let component: DonationsPurposesCreateComponent;
  let fixture: ComponentFixture<DonationsPurposesCreateComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DonationsPurposesCreateComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DonationsPurposesCreateComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
