<?php

use App\Enums\EventScope;
use App\Enums\EventType;
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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('is_singleday')->default(true);
            $table->date('date') -> nullable();
            $table->date('start_date') -> nullable();
            $table->date('end_date') -> nullable();
            $table->string("event_type")->default(EventType::OFFLINE);
            $table->string("event_scope")->default(EventScope::INTERNAL);
            $table->foreignId('event_category_id') ->constrained('event_categories');
            $table->string("created_by")->default("System");
            $table->string("updated_by")->nullable(true);
            $table->boolean('is_active')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });

        
            // INSERT langsung di migration
            DB::table('events')->insert([
                ['name' => 'Komsel 1', 'event_category_id' => 1, 'created_by' => 'Seeder', "start_date" => now(),"end_date" => now()],
                ['name' => 'Komsel 2', 'event_category_id' => 1, 'created_by' => 'Seeder', "start_date" => now(),"end_date" => now()],
                ['name' => 'Komsel 3', 'event_category_id' => 1, 'created_by' => 'Seeder', "start_date" => now(),"end_date" => now()],
            ]);
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
