<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Check if the 'profile_image' column exists
            if (!Schema::hasColumn('users', 'profile_image')) {
                $table->string('profile_image', 255)->nullable();
            }
            
            // Check if the 'remember_token' column exists
            if (!Schema::hasColumn('users', 'remember_token')) {
                $table->string('remember_token', 100)->nullable();
            }
            
            // Check if the 'firebase_token' column exists
            if (!Schema::hasColumn('users', 'firebase_token')) {
                $table->string('firebase_token', 255)->nullable();
            }

            // Check if the 'device_id' column exists
            if (!Schema::hasColumn('users', 'device_id')) {
                $table->string('device_id', 255)->nullable();
            }

            // Check if the 'imei_no' column exists
            if (!Schema::hasColumn('users', 'imei_no')) {
                $table->string('imei_no', 255)->nullable();
            }

            // Check if the 'type' column exists
            if (!Schema::hasColumn('users', 'type')) {
                $table->enum('type', ['admin', 'user'])->default('user');
            }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop the columns if they exist
            if (Schema::hasColumn('users', 'profile_image')) {
                $table->dropColumn('profile_image');
            }
            if (Schema::hasColumn('users', 'remember_token')) {
                $table->dropColumn('remember_token');
            }
            if (Schema::hasColumn('users', 'firebase_token')) {
                $table->dropColumn('firebase_token');
            }
            if (Schema::hasColumn('users', 'device_id')) {
                $table->dropColumn('device_id');
            }
            if (Schema::hasColumn('users', 'imei_no')) {
                $table->dropColumn('imei_no');
            }
            if (Schema::hasColumn('users', 'type')) {
                $table->dropColumn('type');
            }
        });
    }
}
