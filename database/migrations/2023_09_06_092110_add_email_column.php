<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('registrars',function ($table){
            $table->string('Email');
        });
    }

    public function down(): void
    {
        Schema::table('registrars',function ($table){
            $table->dropColumn('Email');
        });    
    }
};