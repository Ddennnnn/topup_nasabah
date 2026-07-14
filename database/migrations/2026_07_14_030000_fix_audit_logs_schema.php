<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('audit_logs', function (Blueprint $table) {
            if (!Schema::hasColumn('audit_logs', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable()->after('id');
                $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
            }

            if (!Schema::hasColumn('audit_logs', 'action')) {
                $table->string('action')->after('user_id');
            }

            if (!Schema::hasColumn('audit_logs', 'meta')) {
                $table->json('meta')->nullable()->after('action');
            }
        });
    }

    public function down()
    {
        Schema::table('audit_logs', function (Blueprint $table) {
            if (Schema::hasColumn('audit_logs', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }
            if (Schema::hasColumn('audit_logs', 'action')) {
                $table->dropColumn('action');
            }
            if (Schema::hasColumn('audit_logs', 'meta')) {
                $table->dropColumn('meta');
            }
        });
    }
};

