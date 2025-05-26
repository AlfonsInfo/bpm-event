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
        Schema::create('event_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string("created_by")->default("System");
            $table->string("updated_by")->nullable(true);
            $table->timestamps();
            $table->softDeletes();
        });

            // INSERT langsung di migration
            DB::table('event_categories')->insert([
                ['name' => 'Komsel', 'description' => 'Kegiatan Komunitas Sel', 'created_by' => 'Seeder'],
                ['name' => 'Persekutuan Doa', 'description' => 'Kegiatan PD rutin', 'created_by' => 'Seeder'],
                ['name' => 'Kegiatan Sosial', 'description' => 'Kunjungan, jalan-jalan, dll', 'created_by' => 'Seeder'],
            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_categories');
    }
};
