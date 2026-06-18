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
        Schema::create('applicants', function (Blueprint $table) {
            $table->id();

            //personal information
            $table->string('fullname');
            $table->string('email')->unique();
            $table->string('phone', 20);
            $table->enum('gender', ['male','female']);
            $table->string('birth_place');
            $table->date('birth_date');

            //address
            $table->text('address')->nullable();
            $table->string('village');
            $table->string('district');
            $table->string('city');
            $table->string('province');
            $table->string('postal_code', 10);

            //infomasi tambahan 
            $table->enum('referral_source',[
                'jobstreet','media sosial','website','poster','other'
            ]);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicants');
    }
};
