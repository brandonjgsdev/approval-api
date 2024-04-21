<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

class UserController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $userID = Auth::id();

            $users = User::where('id', '<>', $userID)->get();

            return $this->HTTP_OK_RESPONSE([
                $users
            ]);
        } catch (Throwable $th) {
            return $this->HTTP_BAD_REQUEST_RESPONSE([], "Hubo un error al recuperar los datos. Por favor, inténtalo de nuevo.");
        }
    }
}
