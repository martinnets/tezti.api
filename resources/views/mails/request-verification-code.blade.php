@extends('mails.layout')
@section('title', 'Código de verificación de cuenta')
@section('body')
    <div>
        <p>¡Hola {{ $user->name }}! Puedes usar siguiente código para verificar tu cuenta con email
            <span class="font-weight-bold">{{ $user->email }}</span>:
        </p>
        <br>
        <h2 class="pt-4 pb-4 bg-primary text-center">{{ $code }}</h2>
        <br>
        <p>Este código tiene una vigencia de {{ config('auth.code_timeout') / 60 }} minutos, si ha pasado más tiempo
            por favor solicita otro código.</p>
        <br>
        <br>
        <p>En caso no haya sido solicitado por ti, omite este email.</p>
    </div>
@endsection
