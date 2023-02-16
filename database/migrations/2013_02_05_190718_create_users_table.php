<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
// use Str;
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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('account_number')->unique()->nullable();
            $table->string('password')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('image')->nullable();
            $table->boolean('status')->default(1);
            $table->integer('balance')->default(1000);
            $table->string('provider')->nullable();
            $table->string('mac_address')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });


        User::create(
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@admin.com',
                'password' => bcrypt('456456456'),
                'phone' => '01833996321',
                'address' => 'Demo Address',
                'image' => 'user.jpg',
                'email_verified_at' => now(),
                'remember_token' => rand(100,1000000),
            ]
        );
        User::create(
            [
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'account_number' => 'admin@admin.com',
                'password' => bcrypt('456456456'),
                'phone' => '01833996321',
                'address' => 'Demo Address',
                'image' => 'user.jpg',
                'email_verified_at' => now(),
                'remember_token' => rand(100,1000000),
            ]
        );
        User::create(
            [
                'name' => 'Staff',
                'email' => 'staff@admin.com',
                'password' => bcrypt('456456456'),
                'phone' => '01833996321',
                'address' => 'Demo Address',
                'image' => 'user.jpg',
                'email_verified_at' => now(),
                'remember_token' => rand(100,1000000),
            ]
        );

        User::create(
            [
                'name' => 'user-a',
                'email' => 'a@a.com',
                'account_number' => 1,
                'password' => bcrypt('12345678'),
                'phone' => '01833996321',
                'address' => 'Demo Address',
                'image' => 'user.jpg',
                'mac_address' => 'a',
                'email_verified_at' => now(),
                'remember_token' => rand(100,1000000),
            ]
        );
        User::create(
            [
                'name' => 'user-b',
                'email' => 'b@b.com',
                'account_number' => 2,
                'password' => bcrypt('12345678'),
                'phone' => '01833996321',
                'address' => 'Demo Address',
                'image' => 'user.jpg',
                'mac_address' => 'b',
                'email_verified_at' => now(),
                'remember_token' => rand(100,1000000),
            ]
        );
        User::create(
            [
                'name' => 'user-ac',
                'email' => 'c@c.com',
                'account_number' => 3,
                'password' => bcrypt('12345678'),
                'phone' => '01833996321',
                'address' => 'Demo Address',
                'image' => 'user.jpg',
                'mac_address' => 'c',
                'email_verified_at' => now(),
                'remember_token' => rand(100,1000000),
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
