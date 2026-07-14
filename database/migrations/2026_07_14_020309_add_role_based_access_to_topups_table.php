<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Migration sebelumnya sudah melakukan perubahan field topups.
        // Migration ini dibiarkan kosong agar tidak memodifikasi skema dua kali.
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Tidak ada perubahan yang perlu di-rollback.
    }
};

