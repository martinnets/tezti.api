<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificacionMailable;

class EmailController extends Controller
{
    public function enviar(Request $request)
    {
        // $request->validate([
        //     'email' => 'required|email',
        //     'mensaje' => 'required|string',
        // ]);
        $destinatario=$request->email;
        //Mail::to($request->email)->send(new NotificacionMailable($request->mensaje));
        Mail::to($destinatario)->send(new NotificacionMailable('a','b','c','d','e'));

        return response()->json(['status' => 'Correo enviado correctamente.']);
    }
}
