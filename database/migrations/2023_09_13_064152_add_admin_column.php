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
        Schema::table('registereds',function($table){
            $table->string('isAdmin');
        });
    }

    public function down(): void
    {
        Schema::table('registereds',function($table){
              $table->dropColumn('isAdmin');
        });
    }
};
