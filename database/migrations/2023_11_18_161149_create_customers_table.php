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
            $table->bigIncrements('customer_id');
            $table->text('customer_firstname');
            $table->text('customer_lastname');
            $table->text('customer_middlename')
                ->nullable();
            $table->enum('customer_gender', ['Male', 'Female']);
            $table->text('email');
            $table->text('contact_person');
            $table->text('contact_number');
            $table->text('country');
            $table->text('province');
            $table->text('city');
            $table->text('barangay')
                ->nullable();
            $table->text('zipcode');
            $table->text('additional_information')
                ->nullable();
            $table->unsignedInteger('created_by');
            $table->unsignedInteger('modified_by');
            $table->timestamps();
            $table->unsignedInteger('deleted_by')->nullable();
            $table->softDeletes();
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
