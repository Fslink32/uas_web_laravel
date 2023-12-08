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

        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'is_deleted')) {
                $table->tinyInteger('is_deleted')->default(0);
            }
        });
        Schema::table('roles', function (Blueprint $table) {
            if (!Schema::hasColumn('roles', 'is_deleted')) {
                $table->tinyInteger('is_deleted')->default(0);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'is_deleted')) {
                $table->dropColumn('is_deleted');
            }
        });
        Schema::table('roles', function (Blueprint $table) {
            if (Schema::hasColumn('roles', 'is_deleted')) {
                $table->dropColumn('is_deleted');
            }
        });
    }
};
