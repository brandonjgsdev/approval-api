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
        Schema::create('approval_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('approval_request_type_id');
            $table->unsignedBigInteger('applicant_user_id');
            $table->unsignedBigInteger('approval_request_status_id')->default(1);
            $table->text('days');
            $table->text('remark')->nullable();
            $table->timestamps();

            $table->foreign('approval_request_type_id')->on('approval_request_types')->references('id');
            $table->foreign('applicant_user_id')->on('users')->references('id');
            $table->foreign('approval_request_status_id')->on('approval_request_statuses')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approval_requests');
    }
};
