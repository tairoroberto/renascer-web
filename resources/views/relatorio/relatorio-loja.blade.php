@extends('app')

@section('head')
    <script type="text/javascript">
        $(function() {
            $('#example').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: '{{ url("relatorio-loja-data/".$loja->id) }}',
                columns: [
                    {data: 'cliente', name: 'cliente'},
                    {data: 'email', name: 'email'},
                    {data: 'name', name: 'name'},
                    {data: 'situation', name: 'situation'},
                    {data: 'created_at', name: 'created_at'}
                ]
            });
        });
    </script>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Lista de emails cadastrados para a loja <b>{{$loja->name}}</b></div>
                    <br><br>
                    <div class="panel-heading" align="center">
                        <div class="col-lg-5">
                            Emails cadastrados: <b>{{$qtdTotalEmails}}</b>
                        </div>
                        <div class="col-lg-5">
                            Emails cadastrados hoje: <b>{{$qtdHojeEmails}}</b>
                        </div>
                        <br>
                    </div>

                    <div class="panel-body">
                        <table class="table table-condensed table-hover" id="example">
                            <thead>
                                <tr>
                                    <th>Cliente</th>
                                    <th>Email</th>
                                    <th>Loja</th>
                                    <th>Situação</th>
                                    <th>Cadastro</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
