<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait ApiResponseTrait
{
    //  La solicitud ha tenido éxito. El cliente obtiene la respuesta en el cuerpo del mensaje.
    protected function HTTP_OK_RESPONSE($data, $message = null, $code = Response::HTTP_OK)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    //  La solicitud ha tenido éxito. El cliente obtiene la respuesta en el cuerpo del mensaje.
    protected function HTTP_OK_RESPONSE_V2($data, $message = null, $code = Response::HTTP_OK)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            $data,
        ], $code);
    }

    //  La solicitud ha tenido éxito, y se ha creado un nuevo recurso como resultado. Se utiliza comúnmente en respuestas a solicitudes de creación de recursos.
    protected function HTTP_CREATED_RESPONSE($data, $message = null, $code = Response::HTTP_CREATED)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    //  La solicitud se ha realizado correctamente, pero no hay contenido para devolver (generalmente en respuestas a solicitudes de eliminación o actualización).
    protected function HTTP_NO_CONTENT_RESPONSE($data, $message = null, $code = Response::HTTP_NO_CONTENT)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    //  La solicitud del cliente es incorrecta o no se puede procesar por diversas razones, como datos de entrada incorrectos o mal formados.
    protected function HTTP_BAD_REQUEST_RESPONSE($data, $message = null, $code = Response::HTTP_BAD_REQUEST)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    //  El cliente no está autenticado y debe proporcionar credenciales válidas para acceder al recurso.
    protected function HTTP_UNAUTHORIZED_RESPONSE($data, $message = null, $code = Response::HTTP_UNAUTHORIZED)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    //  El cliente está autenticado pero no tiene permiso para acceder al recurso solicitado.
    protected function HTTP_FORBIDDEN_RESPONSE($data, $message = null, $code = Response::HTTP_FORBIDDEN)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    // El recurso solicitado no se encuentra en el servidor.
    protected function HTTP_NOT_FOUND_RESPONSE($data, $message = null, $code = Response::HTTP_NOT_FOUND)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    // El método de solicitud (GET, POST, PUT, DELETE, etc.) no está permitido en el recurso solicitado.
    protected function HTTP_METHOD_NOT_ALLOWED_RESPONSE($data, $message = null, $code = Response::HTTP_METHOD_NOT_ALLOWED)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    // Se produce un error en el servidor que impide que se complete la solicitud. Esto suele ser un problema en el lado del servidor.
    public function HTTP_INTERNAL_SERVER_ERROR_RESPONSE($data, $message = null, $code = Response::HTTP_INTERNAL_SERVER_ERROR)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    // El servidor no puede manejar la solicitud en este momento debido a un mantenimiento programado o una sobrecarga temporal.
    protected function HTTP_SERVICE_UNAVAILABLE_RESPONSE($code = Response::HTTP_SERVICE_UNAVAILABLE)
    {
        $statusText = Response::$statusTexts[Response::HTTP_SERVICE_UNAVAILABLE];
        return $this->errorResponse($statusText, Response::HTTP_SERVICE_UNAVAILABLE);
    }

    protected function errorResponse($message, $code)
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
        ], $code);
    }

    protected function notFoundResponse($message = 'Resource not found')
    {
        return $this->errorResponse($message, Response::HTTP_NOT_FOUND);
    }

    protected function internalErrorResponse($message = 'Internal Server Error')
    {
        return $this->errorResponse($message, Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    protected function unauthorizedResponse($message = 'Unauthorized')
    {
        return $this->errorResponse($message, Response::HTTP_UNAUTHORIZED);
    }

    protected function validationErrorResponse($message = 'Validation Error')
    {
        return $this->errorResponse($message, Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
