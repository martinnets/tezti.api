@extends('mails.layout')
@section('title', 'Centro de ayuda - Formulario recibido')
@section('body')
    <div>
        <p>Nuevo registro en Centro de ayuda:</p>
        <br>
        <table class="text-body">
            <tr>
                <td class="font-weight-bold">Usuario:</td>
                <td>{{ $help->user->name }}</td>
            </tr>
            <tr>
                <td class="font-weight-bold">Email consignado:</td>
                <td>{{ $help->email }}</td>
            </tr>
            <tr>
                <td class="font-weight-bold">Celular consignado:</td>
                <td>{{ $help->phone }}</td>
            </tr>
            <tr>
                <td class="font-weight-bold">Tipo de solicitud:</td>
                <td>{{ $help->reason }}</td>
            </tr>
            <tr>
                <td class="font-weight-bold">Asunto:</td>
                <td>{{ $help->subject }}</td>
            </tr>
            <tr>
                <td class="font-weight-bold">Mensaje:</td>
                <td>{{ $help->message }}</td>
            </tr>
        </table>
        <br>
        <p>En caso no haya sido solicitado por ti, omite este email.</p>
    </div>
@endsection
