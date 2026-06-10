<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn([
                'excerpt',
                'visibility',
                'meta_title',
                'meta_description',
                'scheduled_at',
                'real_time',
                'views_count',
                'seo_score',
            ]);
        });
    }

    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('excerpt')->nullable();
            $table->string('visibility')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->timestamp('scheduled_at')->nullable();
            $table->integer('real_time')->default(0);
            $table->integer('views_count')->default(0);
            $table->integer('seo_score')->nullable();
        });
    }
};