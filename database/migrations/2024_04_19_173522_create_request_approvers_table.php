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
        Schema::create('request_approvers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('approval_request_id');
            $table->unsignedBigInteger('approver_user_id');
            $table->unsignedBigInteger('approval_request_status_id')->default(1);
            $table->text('remark')->nullable();
            $table->timestamps();

            $table->foreign('approval_request_id')->on('approval_requests')->references('id');
            $table->foreign('approver_user_id')->on('users')->references('id');
            $table->foreign('approval_request_status_id')->on('approval_request_statuses')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_approvers');
    }
};
