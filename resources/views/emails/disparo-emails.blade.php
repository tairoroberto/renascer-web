@extends('app')

@section('head')
    <style>
        .jquery-waiting-base-container {
            position: absolute;
            left: 0px;
            top: 20%;
            margin:0px;
            width: 100%;
            height: 200px;
            display:block;
            z-index: 9999997;
            opacity: 0.65;
            -moz-opacity: 0.65;
            filter: alpha(opacity = 65);
            background: black;
            background-image: url("{{asset('/images/loading_bar.gif')}}");
            background-repeat: no-repeat;
            background-position:50% 50%;
            text-align: center;
            overflow: hidden;
            font-weight: bold;
            color: white;
            padding-top: 25%;
        }
    </style>
    <script>
        /*$( document ).ready(function() {
            // Using YQL and JSONP
            $.ajax({
                url: "{{action('EmailController@runCommands')}}",
                // Work with the response
                success: function( response ) {
                    console.log( response ); // server response
                }
            });
        });*/

        $(function () {
            $.ajax({
                url: "{{action('EmailController@runCommands','queue:work --tries=3')}}",
                // Work with the response
                success: function( response ) {
                    console.log( response ); // server response
                }
            });
        });
    </script>
@stop

@section('content')
<div class="container">
    <form id="formEnviarEmails" method="post" enctype="multipart/form-data" action="{{action('MensagemEmailController@store')}}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div style="text-align: center">
            <h1> <a href="{{route("painel")}}">Disparando Emails...</a></h1>
        </div>
        {{-- Div de mensagem de carregamento--}}
        <div id="Carregando" class="jquery-waiting-base-container">Enviando emails...</div>
    </form>
</div>
@stop
