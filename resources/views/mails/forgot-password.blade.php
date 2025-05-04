@extends('mails.layout')
@section('title', 'Olvidé mi contraseña')
@section('body')
    <div>
        <p>¡Hola {{ $user->name }}! Has solicitado el reestablecimiento de tu contraseña, a continuación el código de
            reestablecimiento:</p>
        <br>
        <br>
        <h2 class="pt-4 pb-4 bg-primary text-center">{{ $code }}</h2>
        <br>
        <p>Este código tiene una vigencia de {{ config('auth.code_timeout') / 60 }} minutos, si ha pasado más tiempo por
            favor
            solicita otro código.</p>
        <br>
        <br>
        <p>En caso no haya sido solicitado por ti, omite este email.</p>
    </div>
@endsection
