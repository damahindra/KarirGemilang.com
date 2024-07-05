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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id('job_id');
            $table->string('job_title');
            $table->text('job_description');
            $table->text('prerequisites');
            $table->string('job_location');
            $table->string('location_type');
            $table->string('location');
            $table->string('exp_level');
            $table->date('apply_before');
            $table->integer('total_applicants');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
