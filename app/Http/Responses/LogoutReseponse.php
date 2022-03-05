<?php
namespace App\Http\Responses;
use Laravel\Fortify\Contracts\LogoutResponse as LogoutReseponseContract;

class LogoutReseponse implements LogoutReseponseContract{

    public function toResponse($request)
    {
        return redirect('/');
    }

}