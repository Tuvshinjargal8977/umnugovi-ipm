<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('project_materials', function (Blueprint $table) {
            // Заавал файл хавсаргахын оронд гадаад холбоосоор (жишээ нь Google Form) бөглүүлэх бол ашиглана.
            $table->string('external_url')->nullable()->after('template_file');
        });
    }

    public function down(): void
    {
        Schema::table('project_materials', function (Blueprint $table) {
            $table->dropColumn('external_url');
        });
    }
};
