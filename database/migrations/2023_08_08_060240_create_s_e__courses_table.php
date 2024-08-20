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
        Schema::connection('mysql_Second')->create('s_e__courses', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('Course');
            $table->string('CourseTitle');
            $table->string('Credit');
            $table->string('Year');
            $table->string('Semester');
            $table->string('CourseCategory');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('s_e__courses');
    }
};