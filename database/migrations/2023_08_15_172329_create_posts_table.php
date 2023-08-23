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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('schedule_type', ['now', 'later'])->default('now');
            $table->dateTime('schedule_time')->useCurrent();
            $table->enum('post_status', ['Pending', 'Processing', 'Published', 'Failed'])->default('Pending');
            $table->enum('email_status', ['Pending', 'Processing', 'Send', 'Failed'])->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
