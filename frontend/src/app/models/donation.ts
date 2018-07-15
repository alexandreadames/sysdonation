export interface Donation {
      name : string;
      surname : string;
      email : string;
      phone_area_code: string;
      phone_number: string;
      cpf: string;
      street_name: string;
      street_number: number;
      district: string;
      city: string;
      state: string;
      zip_code?: string;
      donation_value: number;
      donation_code: string;
      donation_title: string;
      userid: number;
      donationpurpose_id: number;
  }