import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DonationsPurposesComponent } from './donations-purposes.component';

describe('DonationsPurposesComponent', () => {
  let component: DonationsPurposesComponent;
  let fixture: ComponentFixture<DonationsPurposesComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DonationsPurposesComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DonationsPurposesComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
