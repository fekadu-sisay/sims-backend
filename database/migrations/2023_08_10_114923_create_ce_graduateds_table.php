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
        Schema::connection('mysql_third')->create('ce_graduateds', function (Blueprint $table) {
            $table->id();
            $table->string('FirstName');
            $table->string('FatherName');
            $table->string('GFatherName');
            $table->string('Sex');
            $table->string('DegreeAwarded');
            $table->string('StudyDuration');
            $table->string('GraduationDate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ce_graduateds');
    }
};