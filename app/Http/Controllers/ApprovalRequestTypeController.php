<?php

namespace App\Http\Controllers;

use App\Models\ApprovalRequestType;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Throwable;

class ApprovalRequestTypeController extends Controller
{

    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $types = ApprovalRequestType::get();

            return $this->HTTP_OK_RESPONSE([
                $types
            ]);
        } catch (Throwable $th) {
            return $this->HTTP_BAD_REQUEST_RESPONSE([], "Hubo un error al recuperar los datos. Por favor, inténtalo de nuevo.");
        }
    }

    // /**
    //  * Show the form for creating a new resource.
    //  */
    // public function create()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(Request $request)
    // {
    //     //
    // }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(Todob $todob)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(Todob $todob)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, Todob $todob)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(Todob $todob)
    // {
    //     //
    // }
}
