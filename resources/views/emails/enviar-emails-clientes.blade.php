@extends('app')

@section('head')
<script type="text/javascript">
    $(document).ready( function() {
        $('#example').dataTable({
            "oLanguage": {
                "sSearch": "Buscar:",
                "sEmptyTable": "Sem registros",
                "sEmptyTable": "Sem registros gravados",
                "sZeroRecords": "Sem registros para a busca",
                "sProcessing": "Carregando...",
                "sLoadingRecords": "Carregando...",
                "sLengthMenu": "Mostar _MENU_ entradas",
                "sInfoEmpty": "Mostrando 0 para 0 de 0 entradas",
                "sInfo": "&nbsp; - &nbsp; Mostrando _START_ para _END_ de _TOTAL_ entradas",
                "oPaginate": {
                    "sPrevious": "<b> Anterior </b>",
                    "sNext": "<b> - Próximo</b>&nbsp;"
                  }
            }
        });

    });

    function enviar(){
        $('#btnEnviar').css('display','none');
        $('#Carregando').css('display','block');
        formEnviarEmails.submit();

        $('.div-ajax-carregamento-pagina').fadeOut('fast');
    }

    function chageMsg(msg){
        $('#mensagem').val(msg);
    }

    function dispararEmails() {
        var a = document.createElement("a");
        a.target = "_blank";
        a.href = "{{action('EmailController@dispararEmails')}}";
        a.click();
    }

</script>
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
    <form id="formEnviarEmails" method="post" enctype="multipart/form-data" action="{{action('EmailController@enviarEmailClientes')}}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    @if (count($errors) > 0)
                        @if($errors->get("Sucesso")!= null)
                            <div class="alert alert-info">
                                {{--<strong>Whoops!</strong> Alguma coisa deu errado!<br><br>--}}
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>

                            {{--Redirect to send emails--}}
                            <script>
                                dispararEmails();
                            </script>

                        @else
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> Alguma coisa deu errado!<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    @endif

                    <div class="panel-heading">Enviar emails para clientes</div>
                    <br>
                    <?php $lojas = \Renascer\Loja::all();?>

                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <select name="loja" id="loja" class="form-control">
                                {{--Verifica se tem uma loja antiga selecionada e faz uma busca para
                                    encontrar e preencher o select--}}
                                @if(old('loja') != '')
                                    <?php $loj = \Renascer\Loja::find(old('loja'));?>
                                    <option value="{{$loj->id}}"> {{$loj->name}} </option>
                                @endif

                                <option value=""> -- Selecione a loja -- </option>
                                @foreach($lojas as $loja)
                                    <option value="{{$loja->id}}"> {{$loja->name}} </option>
                                @endforeach
                            </select>
                        </div>

                    <br><br>

                    <div class="panel-body">
                        <div class="col-md-12" align="center">
                          <?php $mensagemEmails = \Renascer\MensagemEmail::take(2)->where('id','!=',0)->orderBy('id','desc')->get();?>

                            <table class="table table-condensed table-hover">
                                <thead>
                                    <th style="width: 50%"></th>
                                    <th style="width: 50%"></th>
                                </thead>
                            	<tbody>
                                    <tr>
                                        @foreach($mensagemEmails as $mensagemEmail)
                                            <td>
                                                <div class="col-md-6" style="background-color: #d6e9c6; width: 100%; height: 600px">
                                                    <div style="width: 100%; height: 150px; overflow: hidden;text-align: center;">
                                                        {!! $mensagemEmail->text !!}
                                                    </div>
                                                    <div><img src="{{$mensagemEmail->image}}" width="100%" height="450px"></div>
                                                    <div class="radio">
                                                    	<label>
                                                    		<input type="radio" name="msg" id="msg" value="1" onchange="chageMsg('{{$mensagemEmail->id}}');">
                                                    		Selecionar
                                                    	</label>
                                                    </div>
                                                </div>
                                            </td>
                                        @endforeach
                                    </tr>
                            	</tbody>
                            </table>
                            <br>
                        </div>

                        <input type="hidden" id="mensagem" name="mensagem">

                        <div class="form-group">
                            <div class="col-md-12 col-sm-12" style="text-align: right;">
                                <br>
                                <button id="btnEnviar" type="button" class="btn btn-lg btn-primary" onclick="enviar();">Enviar</button>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        {{-- Div de mensagem de carregamento--}}
        <div id="Carregando" style="display: none;" class="jquery-waiting-base-container">Carregando...</div>

    </form>
</div>
@endsection
