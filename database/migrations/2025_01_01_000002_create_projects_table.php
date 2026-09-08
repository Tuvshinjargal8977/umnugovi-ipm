<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_category_id')->nullable()->constrained()->nullOnDelete();

            $table->json('title');                       // translatable
            $table->string('slug')->unique();

            // Явцын төлөв
            $table->string('status')->default('pre_assessment');
            // pre_assessment | under_study | ongoing | open_for_proposals | completed

            // Хураангуй талбарууд (translatable)
            $table->json('proponent')->nullable();       // Төсөл санаачлагч
            $table->json('phase')->nullable();           // Төслийн явц (Үе 1/2/3)
            $table->json('study_status')->nullable();    // Судлагдсан байдал
            $table->json('contract_type')->nullable();   // Гэрээний төрөл
            $table->json('contract_duration')->nullable(); // Гэрээний хугацаа
            $table->json('financing')->nullable();       // Санхүүжилтийн хэлбэр
            $table->json('policy_reference')->nullable(); // Бодлогын баримт бичиг (rich)
            $table->json('address')->nullable();

            // Огноо
            $table->date('preliminary_assessment_at')->nullable();
            $table->date('proposal_deadline')->nullable();
            $table->dateTime('info_meeting_at')->nullable();

            // Контент
            $table->json('summary')->nullable();         // translatable, богино
            $table->json('body')->nullable();            // translatable, rich text (дэлгэрэнгүй)

            // Медиа
            $table->string('cover_image')->nullable();
            $table->json('gallery')->nullable();

            $table->boolean('is_featured')->default(false);
            $table->dateTime('published_at')->nullable();
            $table->timestamps();

            $table->index(['status', 'published_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
