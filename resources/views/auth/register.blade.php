@extends('app')

@section('head')
    <script type="text/javascript">
        function mostraLoja(){
            if($('#tipo').val() == "Caixa"){
                $('#divLoja').css("display","block");
            }else{
                $('#divLoja').css("display","none");
            }
        }

        function valida(){
            if($('#tipo').val() == "Caixa" && $('#loja').val() == ""){

                $( "#dialog" ).dialog({
                    modal: true,
                    buttons: {
                        Ok: function() {
                            $( this ).dialog( "close" );
                        }
                    }
                });
                return;

            }else{
                formRegistro.submit();
            }
        }
    </script>
@stop

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Register</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> Alguma coisa deu errado..<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form id="formRegistro" class="form-horizontal" role="form" method="POST" action="{{ url('/auth/register') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">Nome</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="nome" id="nome" value="{{ old('nome') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">E-Mail</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Senha</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="senha" id="senha">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Confirmar Senha</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="senha_confirmation"  id="senha_confirmation">
							</div>
						</div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Tipo de usuário</label>
                            <div class="col-md-6">
                                <select name="tipo" id="tipo" class="form-control" onchange="mostraLoja();">
                                    @if(old('tipo'))
                                        <option value="{{old('tipo')}}">{{old('tipo')}}</option>
                                    @endif
                                    <option value=""> - Selecione - </option>
                                    <option value="Administrador">Administrador</option>
                                	<option value="Caixa">Caixa</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group" id="divLoja" style="display: none;">
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
								<button type="button" class="btn btn-primary" onclick="valida();">
									Salvar
								</button>
							</div>
						</div>


                        {{--Diaolog--}}
                        <div id="dialog" title="Selecione" style="display: none">
                            <p>Por favor selecione um loja!"</p>
                        </div>

                    </form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
