<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestApprover extends Model
{
    use HasFactory;

    protected $fillable = [
        'approval_request_id',
        'approver_user_id',
        'approval_request_status_id',
        'remark',
    ];

    public function approverUser() {
        return $this->belongsTo(User::class, 'approver_user_id', 'id');
    }

    public function status() {
        return $this->hasOne(ApprovalRequestStatus::class, 'id', 'approval_request_status_id');
    }
}
