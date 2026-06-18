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
       Schema::create('applications', function (Blueprint $table) {
            $table->id();

            $table->foreignId('applicant_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('lowongan_id')
                ->constrained('lowongans')
                ->cascadeOnDelete();

            $table->string('resume')->nullable();

            $table->boolean('declaration')
                ->default(false);

            $table->enum('status', [
                'pending',
                'review',
                'interview',
                'offered',
                'accepted',
                'rejected'
            ])->default('pending')->index();

            $table->text('notes')->nullable();

            $table->timestamp('applied_at')
                ->useCurrent()
                ->index();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_applications');
    }
};
