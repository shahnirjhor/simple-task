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
        Schema::create('application_settings', function (Blueprint $table) {
            $table->id();
            $table->string('item_name');
            $table->string('item_short_name');
            $table->string('item_version');
            $table->string('company_name');
            $table->string('company_email')->nullable();
            $table->text('company_address')->nullable();
            $table->string('developed_by')->nullable();
            $table->string('developed_by_href')->nullable();
            $table->string('developed_by_title')->nullable();
            $table->string('developed_by_prefix')->nullable();
            $table->string('support_email')->nullable();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('language')->nullable();
            $table->enum('is_demo', ['0', '1'])->default('0');
            $table->string('time_zone');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application_settings');
    }
};
