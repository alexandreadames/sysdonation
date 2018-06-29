export class Payer {
    name : string;
    surname : string;
    email : string;
    date_created : Date = new Date();
    phone : {
      area_code: string,
      number: string
    }   
    cpf: string;
    address: {
      street_name: string,
      street_number: number,
      zip_code: string
    } 
  }