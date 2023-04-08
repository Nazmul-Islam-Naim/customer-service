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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('mobile',15)->unique();
            $table->string('email')->nullable()->unique();
            $table->string('lat');
            $table->string('long');
            $table->string('address')->nullable();
            $table->string('avatar')->nullable();
            $table->foreignId('division_id')->constrained('divisions')->onDelete('cascade');
            $table->foreignId('district_id')->constrained('districts')->onDelete('cascade');
            $table->foreignId('area_id')->constrained('areas')->onDelete('cascade');
            $table->integer('priority_id')->default(1);
            $table->foreignId('business_cat_id')->constrained('business_categories')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->date('date')->comment('entry date');
            $table->string('comment')->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
