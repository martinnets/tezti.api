@extends('mails.layout')
@section('title', 'Has sido invitado a un proceso')
@section('body')
    <div>
        <p>¡Hola {{ $user }}! Has sido invitado para el proceso:</p>
        <br>
        <h4 class="pt-4 pb-4 bg-light text-center text-primary">{{ $position }}</h4>
        <div class="row mx-auto">
            <a href="{{ config('app.evaluation_url') }}evaluation?access_token={{ $token }}&position_id={{ $position_id }}&uid={{ $userid }}"
                class="btn btn-primary btn-lg text-center mx-auto text-white" target="_blank">
                Ingresar
            </a>
        </div>
        <br>
        <p>En caso no te encuentres interesado, por favor omite este email.</p>
    </div>
@endsection
