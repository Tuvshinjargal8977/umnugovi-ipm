<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('project_materials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();

            $table->json('name');                 // translatable, материалын нэр
            $table->json('description')->nullable(); // translatable, бүрдүүлэх агуулга

            $table->string('template_file')->nullable(); // татаж авах загвар файл

            $table->boolean('is_required')->default(true);
            $table->unsignedInteger('sort')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_materials');
    }
};
