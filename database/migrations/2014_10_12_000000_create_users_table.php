<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\UserStatus; 

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            //user information
            $table->string('name');
            $table->string('wa_number');
            $table->string('status')->default(UserStatus::Active->value);
            $table->boolean('is_activated')->default(false);
        
            // credential
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

         DB::table('users')->insert([
            [
                'name' => 'Agustinus',
                'wa_number' => '081234567890',
                'status' => 'Active',
                'is_activated' => true,
                'email' => 'agustinus@example.com',
                'password' => Hash::make('password'),
                'email_verified_at' => Carbon::now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Benedictus',
                'wa_number' => '081234567891',
                'status' => 'Active',
                'is_activated' => true,
                'email' => 'benedictus@example.com',
                'password' => Hash::make('password'),
                'email_verified_at' => Carbon::now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Carlo Acutis',
                'wa_number' => '081234567892',
                'status' => 'Active',
                'is_activated' => true,
                'email' => 'carlo@example.com',
                'password' => Hash::make('password'),
                'email_verified_at' => Carbon::now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
