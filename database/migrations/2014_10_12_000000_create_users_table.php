<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('address');
            $table->string('city');
            $table->integer('pincode');
            $table->string('license_no');
            $table->string('mobile_no');
            $table->string('alternate_no');
            $table->date('date_of_birth');
            $table->enum('gender', ['male', 'female', 'other', '']);
            $table->tinyInteger('type')->default(3)->comment('1 = admin, 2 = driver, 3 = user');
            $table->enum('status', ['active','inactive']);
            $table->timestamps();
            $table->rememberToken();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
}

?>
