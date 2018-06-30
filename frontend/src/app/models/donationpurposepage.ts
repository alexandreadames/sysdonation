export class DonationPurposePageRes {
    error: boolean;
    data: {
        donationpurpose:{
            donationpurpose_id: number,
            html_content: string;
            slug: string;
            title: string;
        }
        owner: {
            iduser: number;
            name: string;
            description: string;
            occupation: string;
            profile_picture: string;
            filetype: string;
        }
    };
}