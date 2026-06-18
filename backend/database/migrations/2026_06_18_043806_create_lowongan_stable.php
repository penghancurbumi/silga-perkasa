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
       Schema::create('lowongans', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('title');
            $table->string('category');
            $table->string('location');

            $table->unsignedTinyInteger('minimum_experience')
                ->default(0)
                ->comment('Years');

            $table->enum('employment_type', [
                'full_time',
                'part_time',
                'contract',
                'internship',
                'freelance',
            ]);

            $table->longText('description');
            $table->longText('qualification');

            $table->timestamp('posted_at')->nullable();

            $table->date('deadline');

            $table->enum('status', [
                'draft',
                'published',
                'closed',
            ])->default('draft');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_lowongans');
    }
};
