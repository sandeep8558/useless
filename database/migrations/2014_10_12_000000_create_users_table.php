<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('mobile');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();

            $table->set('role', ['Administrator', 'StoreManager', 'Purchase', 'Packer', 'Delivery', 'Accounts', 'WebAdmin', 'Customer', 'POS', 'HR', 'Phoneline', 'Picker', 'Scanner'])->default('Customer');
            $table->set('status', ['Active', 'Non-Active', 'Block', 'Hold', 'Discontinue'])->default('Active');
            $table->timestamp('activated_at')->nullable();

            $table->string('api_token', 80)->unique()->nullable();
            $table->timestamp('token_expire_at')->nullable();
            $table->string('otp', 10)->nullable();

            $table->bigInteger('warehouse_id')->nullable();

            $table->text('dp')->nullable();

            $table->string('billing_address')->nullable();
            $table->string('billing_city')->nullable();
            $table->string('billing_pincode')->nullable();
            $table->string('billing_state')->nullable();
            $table->string('billing_country')->nullable();
            $table->string('aadhar', 30)->nullable();
            $table->string('pan', 30)->nullable();
            $table->text('aadhar_photo')->nullable();
            $table->text('pan_photo')->nullable();

            $table->timestamp('verify_at')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->timestamp('vefirication_failed_at')->nullable();
            $table->string('verification_message')->nullable();

            $table->string('contact_id')->nullable();
            $table->set('ref', ['Self', 'Company'])->nullable();
            $table->bigInteger('first_tier_id')->nullable();
            $table->bigInteger('second_tier_id')->nullable();
            $table->bigInteger('third_tier_id')->nullable();
            $table->bigInteger('fourth_tier_id')->nullable();
            $table->bigInteger('fifth_tier_id')->nullable();

            $table->softDeletes();

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
