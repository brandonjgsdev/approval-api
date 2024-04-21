<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApprovalRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'approval_request_type_id',
        'applicant_user_id',
        'approval_request_status_id',
        'days',
        'remark',
    ];

    public function approvers()
    {
        return $this->hasMany(RequestApprover::class, 'approval_request_id');
        // return $this->belongsToMany(User::class, 'request_approvers', 'approval_request_id', 'approver_user_id')
        // ->withPivot(['approval_request_status_id', 'remark'])->with('status');
    }

    public function applicant()
    {
        return $this->hasOne(User::class, 'id', 'applicant_user_id');
    }

    public function type()
    {
        return $this->hasOne(ApprovalRequestType::class, 'id', 'approval_request_type_id');
    }

    public function status()
    {
        return $this->hasOne(ApprovalRequestStatus::class, 'id', 'approval_request_status_id');
    }
}
