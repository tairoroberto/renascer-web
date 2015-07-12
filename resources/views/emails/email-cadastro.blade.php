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
</script>
@stop

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Cadastro de e-mails</div>

				<div class="panel-body">
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
                                {{--<strong>Whoops!</strong> Alguma coisa deu errado!<br><br>--}}
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <strong> <li>{{ $error }}</li></strong>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ action('EmailController@store') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label class="col-md-4 control-label">Nome do cliente</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="nome_cliente" id="nome_cliente" value="{{ old('nome_cliente') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">E-Mail</label>
                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Loja</label>
                            <div class="col-md-6">
                                <select name="loja" id="loja" class="form-control">
                                    {{--Verifica se tem uma loja antiga selecionada e faz uma busca para
                                           encontrar e preencher o select--}}
                                    @if(old('loja') != '')
                                        <?php $loj = \Renascer\Loja::find(old('loja'));?>
                                        <option value="{{$loj->id}}"> {{$loj->name}} </option>
                                    @endif
                                    <option value=""> - Selecione a loja - </option>
                                        <?php $lojas = \Renascer\Loja::all()?>
                                        @foreach($lojas as $loja)
                                            <option value="{{$loja->id}}">{{$loja->name}}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Salvar
                                </button>
                            </div>
                            <div align="center" class="">
                                <img src="{{asset('img/logo.jpg')}}" width="80%" height="250px">
                            </div>
                        </div>
                    </form>

				</div>
                

			</div>
		</div>
	</div>
</div>
@endsection
