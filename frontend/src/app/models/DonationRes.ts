export class DonationRes{
    error: boolean;
    msg: string;
    data: {
        donation:{
            id: number,
            donation_value: number,
            tbl_donationspurposes_id: number;
            tbl_users_id: number;
            donor_name: string;
            donor_cpf: string;
            donor_surname: string;
            donor_email: string;
            dt_created: string;
            donor_phone_area_code: string;
            donor_phone_number: string;
            donor_street_name: string;
            donor_street_number: number;
            donor_zipcode: string;
            mp_link_order: string;
        }
        
    }
}