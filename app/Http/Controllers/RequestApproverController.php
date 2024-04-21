<?php

namespace App\Http\Controllers;

use App\Models\ApprovalRequest;
use App\Models\RequestApprover;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RequestApproverController extends Controller
{
    use ApiResponseTrait;

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RequestApprover $requestApprover)
    {
        try {

            DB::beginTransaction();

            $requestApprover->update([
                "approval_request_status_id" => $request->input('approval_request_status_id'),
                "remark" => $request->input('remark'),
            ]);

            $approvalRequest = ApprovalRequest::findOrFail($requestApprover->approval_request_id);

            switch ($request->input('approval_request_status_id')) {
                case 2:
                    // Approval Request Validation
                    $requestApproved = $approvalRequest->approvers->every(function ($approver) {
                        return $approver['approval_request_status_id'] === 2;
                    });

                    if ($requestApproved) {
                        $approvalRequest->update(["approval_request_status_id" => 2]);
                    }
                    break;
                case 3:
                    // Approval Request Denied
                    $approvalRequest->update(["approval_request_status_id" => 3]);
                    break;
            }

            DB::commit();

            return $this->HTTP_OK_RESPONSE(null, "La respuesta a la solicitud se ha registrado con éxito.");
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
            return $this->HTTP_BAD_REQUEST_RESPONSE([], "Hubo un error al guardar los datos. Por favor, inténtalo de nuevo.");
        }
    }
}
