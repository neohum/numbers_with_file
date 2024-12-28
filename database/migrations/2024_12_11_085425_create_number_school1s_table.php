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
        Schema::create('number_school1s', function (Blueprint $table) {
            $table->id();
            $table->string('schoolname');
            $table->string('schoolcode');
            $table->string('number');
            $table->string('content');
            $table->string('file');
            $table->string('created_ats');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('number_school1s');
    }
};
