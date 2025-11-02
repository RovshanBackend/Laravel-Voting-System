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
        Schema::table('votes', function (Blueprint $table) {
        $table->string('user_name')->nullable()->after('user_id');
        $table->string('poll_title')->nullable()->after('poll_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('votes', function (Blueprint $table) {

        Schema::table('votes', function (Blueprint $table) {
        $table->dropColumn(['user_name', 'poll_title']);
        });
        });
    }
};
