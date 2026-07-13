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
        if (!Schema::hasColumn('users', 'nomor_rekening')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('nomor_rekening')->unique()->nullable()->after('saldo');
            });
        }

        $users = \DB::table('users')->whereNull('nomor_rekening')->get();
        foreach ($users as $user) {
            $nomor = '90' . rand(10000000, 99999999);

            while (\DB::table('users')->where('nomor_rekening', $nomor)->exists()) {
                $nomor = '90' . rand(10000000, 99999999);
            }

            \DB::table('users')->where('id', $user->id)->update(['nomor_rekening' => $nomor]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('nomor_rekening');
        });
    }
};
