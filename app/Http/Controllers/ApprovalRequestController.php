<?php

namespace App\Http\Controllers;

use App\Models\ApprovalRequest;
use App\Models\RequestApprover;
use App\Traits\ApiResponseTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class ApprovalRequestController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function getAllApprovalRequest()
    {
        try {

            $userID = Auth::id();

            $approvalsRequest = ApprovalRequest::with(['type', 'status', 'applicant', 'approvers.approverUser', 'approvers.status'])->orderBy('created_at', 'desc')
                ->get()->map(function ($approvalRequest) use ($userID) {

                    return [
                        "id" => $approvalRequest->id,
                        "type" => $approvalRequest->type->name,
                        "status" => $approvalRequest->status->name,
                        "created" => Carbon::parse($approvalRequest->created_at)->timezone('America/Mexico_City')->format('d-m-Y H:i:s'),
                        "applicant" => $approvalRequest->applicant->name,
                        "days" => $approvalRequest->days,
                        "approvers" => $approvalRequest->approvers,
                        "currentApprover" => $approvalRequest->approvers()->where('approver_user_id', $userID)->first()
                    ];
                });

            return $this->HTTP_OK_RESPONSE(
                $approvalsRequest
            );
        } catch (Throwable $th) {
            throw $th;
            return $this->HTTP_BAD_REQUEST_RESPONSE([], "Hubo un error al recuperar los datos. Por favor, inténtalo de nuevo.");
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function getSendedApprovalRequest()
    {
        try {

            $userID = Auth::id();

            $approvalsRequest = ApprovalRequest::with(['type', 'status', 'applicant', 'approvers.approverUser', 'approvers.status'])->orderBy('created_at', 'desc')
                ->where('applicant_user_id', $userID)->get()->map(function ($approvalRequest) use ($userID) {

                    return [
                        "id" => $approvalRequest->id,
                        "type" => $approvalRequest->type->name,
                        "status" => $approvalRequest->status->name,
                        "created" => Carbon::parse($approvalRequest->created_at)->timezone('America/Mexico_City')->format('d-m-Y H:i:s'),
                        "applicant" => $approvalRequest->applicant->name,
                        "days" => $approvalRequest->days,
                        "approvers" => $approvalRequest->approvers,
                        "currentApprover" => $approvalRequest->approvers()->where('approver_user_id', $userID)->first()
                    ];
                });

            return $this->HTTP_OK_RESPONSE(
                $approvalsRequest
            );
        } catch (Throwable $th) {
            throw $th;
            return $this->HTTP_BAD_REQUEST_RESPONSE([], "Hubo un error al recuperar los datos. Por favor, inténtalo de nuevo.");
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function getReceivedApprovalRequest()
    {
        try {

            $userID = Auth::id();

            $approvalsRequest = ApprovalRequest::with(['type', 'status', 'applicant', 'approvers.approverUser', 'approvers.status'])->orderBy('created_at', 'desc')
                ->whereHas('approvers', function ($query) use ($userID) {
                    $query->where('approver_user_id', $userID);
                })->get()->map(function ($approvalRequest) use ($userID) {

                    return [
                        "id" => $approvalRequest->id,
                        "type" => $approvalRequest->type->name,
                        "status" => $approvalRequest->status->name,
                        "created" => Carbon::parse($approvalRequest->created_at)->timezone('America/Mexico_City')->format('d-m-Y H:i:s'),
                        "applicant" => $approvalRequest->applicant->name,
                        "days" => $approvalRequest->days,
                        "approvers" => $approvalRequest->approvers,
                        "currentApprover" => $approvalRequest->approvers()->where('approver_user_id', $userID)->first()
                    ];
                });

            return $this->HTTP_OK_RESPONSE(
                $approvalsRequest
            );
        } catch (Throwable $th) {
            throw $th;
            return $this->HTTP_BAD_REQUEST_RESPONSE([], "Hubo un error al recuperar los datos. Por favor, inténtalo de nuevo.");
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $requestAll = $request->all();
            $approvers = $requestAll['approvers'];
            unset($requestAll['approvers']);

            DB::beginTransaction();

            $approvalRequest = ApprovalRequest::create($requestAll);

            foreach ($approvers as $approver) {

                $approvalRequest->approvers()->create([
                    'approver_user_id' => $approver['value'],
                ]);
            }

            DB::commit();

            return $this->HTTP_OK_RESPONSE(null, "La solicitud se ha registrado con éxito.");
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->HTTP_BAD_REQUEST_RESPONSE([], "Hubo un error al guardar los datos. Por favor, inténtalo de nuevo.");
        }
    }
}
