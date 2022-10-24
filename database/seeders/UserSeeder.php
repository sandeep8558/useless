<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data =
        [
            [
                "id" => 1,
                "name" => "Leena Rathod",
                "mobile" => "9664588677",
                "email" => "leenaitsolutions@gmail.com",
                "email_verified_at" => null,
                "password" => "$2y$10\$f.tfIajyEiUbmHbyiarIuODMiQvul3DS5BgF417PMFysdu2dAdxRu",
                "role" => "Administrator",
                "status" => "Active",
                "activated_at" => null,
                "api_token" => null,
                "token_expire_at" => null,
                "otp" => null,
                "warehouse_id" => null,
                "dp" => null,
                "billing_address" => null,
                "billing_city" => null,
                "billing_pincode" => null,
                "billing_state" => null,
                "billing_country" => null,
                "aadhar" => null,
                "pan" => null,
                "aadhar_photo" => null,
                "pan_photo" => null,
                "verify_at" => null,
                "verified_at" => null,
                "vefirication_failed_at" => null,
                "verification_message" => null,
                "contact_id" => null,
                "ref" => null,
                "first_tier_id" => null,
                "second_tier_id" => null,
                "third_tier_id" => null,
                "fourth_tier_id" => null,
                "fifth_tier_id" => null,
                "remember_token" => "AdCqX6XJSlzJhyT0O21ECv8vS4TTVazlBdZK6MfcGCDIf0QjUpXmYm3UysdN",
                "created_at" => "2021-02-14 22:21:00",
                "updated_at" => "2021-02-14 22:21:00"
            ],
            [
                "id" => 2,
                "name" => "Sandeep Rathod",
                "mobile" => "9664588677",
                "email" => "purchase@vainkho.com",
                "email_verified_at" => null,
                "password" => "$2y$10\$EIMe18wnkdiATRwSspiV6u0w/HhiRKwNnmp29CWNYQLXRAw1qnd1S",
                "role" => "Purchase",
                "status" => "Active",
                "activated_at" => null,
                "api_token" => null,
                "token_expire_at" => null,
                "otp" => null,
                "warehouse_id" => null,
                "dp" => null,
                "billing_address" => null,
                "billing_city" => null,
                "billing_pincode" => null,
                "billing_state" => null,
                "billing_country" => null,
                "aadhar" => null,
                "pan" => null,
                "aadhar_photo" => null,
                "pan_photo" => null,
                "verify_at" => null,
                "verified_at" => null,
                "vefirication_failed_at" => null,
                "verification_message" => null,
                "contact_id" => null,
                "ref" => null,
                "first_tier_id" => null,
                "second_tier_id" => null,
                "third_tier_id" => null,
                "fourth_tier_id" => null,
                "fifth_tier_id" => null,
                "remember_token" => null,
                "created_at" => "2021-02-14 22:21:00",
                "updated_at" => "2021-02-14 22:21:00"
            ],
        ];

        foreach($data as $d){
            User::create($d);
        }
    }
}
