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
        Schema::rename('admin_board_of_directors', 'nw_admin_board_of_directors');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('nw_admin_board_of_directors','admin_board_of_directors');
    }
};
