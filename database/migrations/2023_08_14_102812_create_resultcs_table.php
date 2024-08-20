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
        Schema::connection('mysql_fourth')->create('resultcs', function (Blueprint $table) {
            $table->id();
            $table->string('Course');
            $table->string('Course_Title');
            $table->string('Credit');
            $table->string('Year');
            $table->string('Semester');
            $table->string('Grade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resultcs');
    }
};
