@extends('app')

@section('head')
    <style>
        .jquery-waiting-base-container {
            position: absolute;
            left: 0px;
            top: 40%;
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
@stop

@section('content')
<div class="container">
    <form id="formEnviarEmails" method="post" enctype="multipart/form-data" action="{{action('MensagemEmailController@store')}}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        {{-- Div de mensagem de carregamento--}}
        <div id="Carregando" class="jquery-waiting-base-container">Enviando emails...</div>

        <?php
            /*$commands = [
                'cd www',
                'cd renascer',
                '/usr/local/php/5.5/bin/php artisan queue:work'
            ];

            SSH::run($commands, function($line) {
                echo $line.PHP_EOL;
                return Redirect::to("email-cadastro");
            });*/
            Artisan::call("queue:listen");
        ?>

    </form>
</div>
@stop
