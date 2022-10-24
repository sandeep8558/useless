<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Rules\IsReferance;
use App\Rules\IsPincode;
use App\Models\Setting;
use DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'min:8'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'first_tier_id' => [ new IsReferance() ],
            'billing_pincode' => ['required', new IsPincode()],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $freeDownlineBalance = Setting::where('key', 'Free Downline Balance')->first()['val_a'];
        $random = User::
        where('role', 'Customer')
        ->where('billing_pincode', $data['billing_pincode'])
        ->whereHas('wallets', function($q) use($freeDownlineBalance){
            $q
            ->select( DB::raw("IFNULL( SUM( ( CASE WHEN side = 'Credit' THEN amount END ) ), 0) AS credit,
            IFNULL( SUM( ( CASE WHEN side = 'Debit' THEN amount END ) ), 0) AS debit"))
            ->havingRaw('credit - debit >= ?', [$freeDownlineBalance]);
        })
        ->inRandomOrder()
        ->first();

        if($data['first_tier_id'] == null || $data['first_tier_id'] == ''){
            if($random == null){
                $ref = null;
                $referance = null;
            } else {
                if($random != null){
                    $ref = $random->id;
                    $referance = "Company";
                } else {
                    $ref = null;
                    $referance = null;
                }
            }
        } else {
            $ref = $data['first_tier_id'];
            $referance = "Self";
        }

        $first_tier_id = $ref;
        $second_tier_id = null;
        $third_tier_id = null;
        $fourth_tier_id = null;
        $fifth_tier_id = null;

        if($first_tier_id != null){
            $first_tier_id = $first_tier_id;
            $second = User::find($first_tier_id);
            if($second != null){
                $second_tier_id = $second->first_tier_id;
                $third = User::find($second_tier_id);
                if($third != null){
                    $third_tier_id = $third->first_tier_id;
                    $fourth = User::find($third_tier_id);
                    if($fourth != null){
                        $fourth_tier_id = $fourth->first_tier_id;
                        $fifth = User::find($fourth_tier_id);
                        if($fifth != null){
                            $fifth_tier_id = $fifth->first_tier_id;
                        }
                    }
                }
            }
        }

        return User::create([
            'name' => $data['name'],
            'mobile' => $data['mobile'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'ref' => $referance,
            'first_tier_id' => $first_tier_id,
            'second_tier_id' => $second_tier_id,
            'third_tier_id' => $third_tier_id,
            'fourth_tier_id' => $fourth_tier_id,
            'fifth_tier_id' => $fifth_tier_id,
            'billing_pincode' => $data['billing_pincode'],
        ]);
    }
}
