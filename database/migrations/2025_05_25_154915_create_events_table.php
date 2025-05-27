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
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string("event_type")->default(EventType::OFFLINE);
            $table->string("event_scope")->default(EventScope::INTERNAL);
            $table->string("created_by")->default("System");
            $table->string("updated_by")->nullable(true);
            $table->foreignId('event_category_id') ->constrained('event_categories');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
