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


        $('#textEditor').Editor();

        $('#textEditor').Editor('setText',[$('#mensagem').val()]);
    });

    function enviar(){
        $('#mensagem').text($('#textEditor').Editor('getText'));
        formEnviarEmails.submit();
    }

    jQuery(function(){
        $('input[type=file]').bootstrapFileInput();
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#imagePreview').attr('src', e.target.result) .width('100%').height(550);
            };

            reader.readAsDataURL(input.files[0]);

        }
    }
</script>
@stop

@section('content')
<div class="container">
    <form id="formEnviarEmails" method="post" enctype="multipart/form-data" action="{{action('MensagemEmailController@store')}}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
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

                    <div class="panel-heading">Cadastro de mensagem para envio de email à clientes</div>
                    <br>

                    <div class="panel-heading" align="center">Insira o texto que será enviado para os clientes</div>

                    <div class="panel-body">
                        <div class="col-md-12" align="center">
                            <textarea class="textarea" style="width: 100%; height: 400px" name="textEditor" id="textEditor"  rows="6" class="col-lg-12">{{old('mensagem')}}</textarea>
                            <textarea class="textarea" name="mensagem" id="mensagem" hidden="">{{old('mensagem')}}</textarea>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <img id="imagePreview" name="imagePreview" />
                            <br>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <br>
                        </div>


                        <div class="form-group">
                            <div class="col-md-2 col-sm-12 col-xs-12" style="text-align: left;">
                                <input type="file" id="imagem" name="imagem" class='filestyle btn btn-success btn-cons' accept='image/*'
                                       title='Selecione uma imagem' onchange="readURL(this);">
                            </div>
                            <div class="col-md-10 col-sm-10 col-xs-12" style="text-align: right;">
                                <button type="button" class="btn btn-primary" onclick="enviar();">Salvar mensagem</button>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
