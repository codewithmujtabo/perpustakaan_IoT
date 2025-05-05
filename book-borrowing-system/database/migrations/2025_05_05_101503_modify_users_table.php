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
            // First drop the existing 'name' column if it exists
            if (Schema::hasColumn('users', 'name')) {
                $table->dropColumn('name');
            }
            
            // Add your custom columns
            $table->string('nama_lengkap')->after('id');
            
            // No need to add email, password, or timestamps as they already exist
            
            // Add role if it doesn't exist
            if (!Schema::hasColumn('users', 'role')) {
                $table->enum('role', ['member', 'admin'])->default('member');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Remove the columns we added
            $table->dropColumn('nama_lengkap');
            $table->dropColumn('role');
            
            // Add back the original 'name' column
            $table->string('name')->after('id')->nullable();
        });
    }
};