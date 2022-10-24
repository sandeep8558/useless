<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class User extends Authenticatable
{

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'mobile',
        'email',
        'password',
        'role',
        'status',
        'api_token',
        'token_expire_at',
        'otp',
        'commission',
        'activated_at',
        'warehouse_id',
        'dp',

        'billing_address',
        'billing_city',
        'billing_pincode',
        'billing_state',
        'billing_country',
        'aadhar',
        'pan',
        'aadhar_photo',
        'pan_photo',
        'verify_at',
        'verified_at',
        'vefirication_failed_at',
        'verification_message',

        'contact_id',

        'ref',
        'first_tier_id',
        'second_tier_id',
        'third_tier_id',
        'fourth_tier_id',
        'fifth_tier_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function isAdministrator(){
        if(($this->role == 'Administrator' && $this->status == 'Active')||($this->roles()->where('role', 'Administrator')->where('status', 'Active')->exists())){
            return true;
        }
        return false;
    }

    public function isCustomer(){
        if(($this->role == 'Customer' && $this->status == 'Active')||($this->roles()->where('role', 'Customer')->where('status', 'Active')->exists())){
            return true;
        }
        return false;
    }


    public function downline(){
        return $this->hasMany('App\Models\User', 'first_tier_id');
    }

    public function first_tier_downline(){
        return $this->hasMany('App\Models\User', 'first_tier_id');
    }

    public function second_tier_downline(){
        return $this->hasMany('App\Models\User', 'second_tier_id');
    }

    public function third_tier_downline(){
        return $this->hasMany('App\Models\User', 'third_tier_id');
    }

    public function fourth_tier_downline(){
        return $this->hasMany('App\Models\User', 'fourth_tier_id');
    }

    public function fifth_tier_downline(){
        return $this->hasMany('App\Models\User', 'fifth_tier_id');
    }

    public function first_tier(){
        return $this->belongsTo('App\Models\User', 'first_tier_id');
    }

    public function second_tier(){
        return $this->belongsTo('App\Models\User', 'second_tier_id');
    }

    public function third_tier(){
        return $this->belongsTo('App\Models\User', 'third_tier_id');
    }

    public function fourth_tier(){
        return $this->belongsTo('App\Models\User', 'fourth_tier_id');
    }

    public function fifth_tier(){
        return $this->belongsTo('App\Models\User', 'fifth_tier_id');
    }

    public function categories(){
        return $this->hasMany('App\Models\Category');
    }

    public function products(){
        return $this->hasMany('App\Models\Product');
    }

    public function product_groups(){
        return $this->hasMany('App\Models\ProductGroup');
    }

    public function serving_areas(){
        return $this->hasMany('App\Models\ServingArea');
    }

    public function sub_categories(){
        return $this->hasMany('App\Models\SubCategory');
    }

    public function warehouses(){
        return $this->hasMany('App\Models\Warehouse');
    }

    public function addresses(){
        return $this->hasMany('App\Models\Address');
    }

    public function orders(){
        return $this->hasMany('App\Models\Order')->where('orderstatus', 'Success')->orderBy('id', 'desc');
    }

    public function recharges(){
        return $this->hasMany('App\Models\Recharge');
    }

    public function wallets(){
        return $this->hasMany('App\Models\Wallet');
    }

    public function credit(){
        return $this->hasMany('App\Models\Wallet')->where('side', 'Credit');
    }

    public function debit(){
        return $this->hasMany('App\Models\Wallet')->where('side', 'Debit');
    }

    public function month_lists(){
        return $this->hasMany('App\Models\MonthList');
    }

    public function shipments(){
        return $this->hasMany('App\Models\Shipment');
    }

    public function payouts(){
        return $this->hasMany('App\Models\Payout');
    }

    public function warehouse(){
        return $this->belongsTo('App\Models\Warehouse');
    }

    public function roles(){
        return $this->hasMany('App\Models\Role');
    }

    public function devices(){
        return $this->hasMany('App\Models\Device');
    }



    protected $appends = ['balance'];

    public function getBalanceAttribute(){
        $credit = $this->wallets()->where('side', 'Credit')->sum('amount');
        $debit = $this->wallets()->where('side', 'Debit')->sum('amount');
        return round($credit - $debit, 2);
    }

}
