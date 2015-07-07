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

    function deletar(id){
        $('#user').val(id);
        formUserList.submit();
    }
</script>
@stop

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Lista de usuários</div>
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

                <form id="formUserList" name="formUserList" action="{{action('PainelController@destroy')}}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="panel-body">
                        <table class="table table-condensed table-hover" id="example">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Loja</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td onclick="deletar({{$user->id}})"><a href="#"><i class="fa fa-trash fa-2x"></i></a></td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    @if($user->loja != 0)
                                        <?php $loja = \Renascer\Loja::find($user->loja)?>
                                        <td>{{$loja->name}}</td>
                                    @else
                                        <td>Escritório</td>
                                    @endif

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <input type="hidden" name="user" id="user">
                </form>
			</div>
		</div>
	</div>
</div>
@endsection
