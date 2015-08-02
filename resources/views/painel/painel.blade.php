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

    function enviar(action){
        if(action == "relatorioLoja"){
            formPainel.action = "{{action('RelatorioController@relatorioLoja')}}";
            formPainel.submit();
        }

        if(action == "relatorioCaixa"){
            formPainel.action = "{{action('RelatorioController@relatorioCaixa')}}";
            formPainel.submit();
        }

        if(action == "relatorioEmails"){
            formPainel.action = "{{action('RelatorioController@relatorioEmails')}}";
            formPainel.submit();
        }

        if(action == "relatorioUsuarios"){
            formPainel.action = "{{action('RelatorioController@relatorioUsuarios')}}";
            formPainel.submit();
        }

        if(action == "cadastrarUsuarios"){
            formPainel.action = "{{action('RelatorioController@cadastroUsuarios')}}";
            formPainel.submit();
        }

        if(action == "enviarEmailClientes"){
            formPainel.action = "{{action('EmailController@enviarEmailClientesLayout')}}";
            formPainel.submit();
        }

        if(action == "cadastrarMsgEmail"){
            formPainel.action = "{{action('MensagemEmailController@index')}}";
            formPainel.submit();
        }

        if(action == "cadastrarLoja"){
            formPainel.action = "{{action('LojaController@index')}}";
            formPainel.submit();
        }

        return;
    }

    function getLoja(){
        var id = $('#loja').val();
        $('#loja_id').val(id);
    }

    function getCaixa(){
        var id = $('#caixa').val();
        $('#caixa_id').val(id);
    }
</script>
@stop

@section('content')
<div class="container">
    <form id="formPainel" class="form-horizontal" role="form" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row">

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

            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Relatórios</div>

                    <div class="panel-body">
                        <table class="table table-condensed table-hover" id="">
                            <thead>
                                <tr>
                                    <th style="width: 5%"></th>
                                    <th style="width: 60%"></th>
                                    <th style="width: 35%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td onclick="enviar('relatorioLoja');"><a href="#"><i class="fa fa-paste fa-2x"></i></a></td>
                                    <td>Relatório de emails por loja</td>
                                    <td>
                                        <select name="loja" id="loja" class="form-control" onchange="getLoja();">
                                            <option value=""> -- Selecione a loja -- </option>
                                            @foreach($lojas as $loja)
                                                <option value="{{$loja->id}}">  {{$loja->name}}  </option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td  onclick="enviar('relatorioCaixa');"><a href="#"><i class="fa fa-paste fa-2x"></i></a></td>
                                    <td>Relatório de emails por caixa</td>
                                    <td>
                                        <select name="caixa" id="caixa" class="form-control" onchange="getCaixa();">
                                            <option value=""> -- Selecione a caixa -- </option>
                                            @foreach($caixas as $caixa)
                                                <option value="{{$caixa->id}}"> -- {{$caixa->name}} -- </option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td onclick="enviar('relatorioEmails');"><a href="#"><i class="fa fa-at fa-2x"></i></a></td>
                                    <td>Emails cadastrados</td>
                                </tr>
                                <tr>
                                    <td onclick="enviar('relatorioUsuarios');"><a href="#"><i class="fa fa-user fa-2x"></i></a></td>
                                    <td>Lista de usuarios cadastrados</td>
                                </tr>
                                <tr>
                                    <td onclick="enviar('cadastrarUsuarios');"><a href="#"><i class="fa fa-users fa-2x"></i></a></td>
                                    <td>Cadastrar usuários</td>
                                </tr>
                                <tr>
                                    <td onclick="enviar('enviarEmailClientes');"><a href="#"><i class="fa fa-arrow-circle-o-up fa-2x"></i></a></td>
                                    <td>Enviar email para clientes</td>
                                </tr>
                                <tr>
                                    <td onclick="enviar('cadastrarMsgEmail');"><a href="#"><i class="fa fa-edit fa-2x"></i></a></td>
                                    <td>Cadastrar mensagem para enviar à clientes</td>
                                </tr>
                                <tr>
                                    <td onclick="enviar('cadastrarLoja');"><a href="#"><i class="fa fa-home fa-2x"></i></a></td>
                                    <td>Cadastrar nova loja</td>
                                </tr>
                            </tbody>
                        </table>

                        <input type="hidden" id="loja_id" name="loja_id">
                        <input type="hidden" id="caixa_id" name="caixa_id">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
