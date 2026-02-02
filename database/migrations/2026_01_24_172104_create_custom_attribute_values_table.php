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
        Schema::create('custom_attribute_values', function (Blueprint $table) {
            $table->id();
            $table->string('string_value')->nullable();
            $table->text('text_value')->nullable();
            $table->longText('long_text_value')->nullable();
            $table->integer('number_value')->nullable();
            $table->boolean('boolean_value')->nullable();
            $table->date('date_value')->nullable();
            $table->dateTime('date_time_value')->nullable();
            $table->foreignId('patient_id')->nullable()->constrained();
            $table->foreignId('record_id')->nullable()->constrained();
            $table->foreignId('custom_attribute_id')->constrained();
            $table->foreignId('custom_attribute_option_id')->nullable()->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_attribute_values');
    }
};
