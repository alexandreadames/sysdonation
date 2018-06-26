import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DonationpurposepageComponent } from './donationpurposepage.component';

describe('DonationpurposepageComponent', () => {
  let component: DonationpurposepageComponent;
  let fixture: ComponentFixture<DonationpurposepageComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DonationpurposepageComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DonationpurposepageComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
