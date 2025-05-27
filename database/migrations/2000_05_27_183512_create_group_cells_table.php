<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('group_cells', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            //* untuk sementara semua informasi seperti grup wa, etc masuk sini dlu
            $table->string('description');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('group_cells')->insert([
        [
            'name' => 'Agustinus',
            'description' => 'Komsel Agustinus',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'name' => 'Benedictus',
            'description' => 'Komsel Benedictus',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'name' => 'Carlo Acutis',
            'description' => 'Komsel Carlo Acutis',
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
        Schema::dropIfExists('group_cells');
    }
};
