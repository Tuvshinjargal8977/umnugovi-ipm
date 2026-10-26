<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('project_proposals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();

            $table->string('name');
            $table->string('organization')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('note')->nullable();

            $table->boolean('is_reviewed')->default(false);

            $table->timestamps();

            $table->index(['project_id', 'created_at']);
        });

        Schema::create('project_proposal_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_proposal_id')->constrained()->cascadeOnDelete();
            $table->foreignId('project_material_id')->nullable()->constrained()->nullOnDelete();

            $table->string('file_path');
            $table->string('original_name');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_proposal_files');
        Schema::dropIfExists('project_proposals');
    }
};
