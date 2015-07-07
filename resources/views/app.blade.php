<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Renascer | Carnes & CIA</title>

    {{--Begin Css--}}
	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('/js/jquery-ui/jquery-ui-1.10.1.custom.min.css') }}" rel="stylesheet" type="text/css" media="screen"/>
    <link href="{{ asset('/js/bootstrap-wysihtml5/Responsive-WYSIWYG/editor.css') }}" rel="stylesheet" type="text/css" media="screen"/>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('js/datatable/css/datatables.bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('js/datatable/css/dataTables.responsive.css') }}" rel="stylesheet">
    {{--End Css--}}


	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>


	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

    <!-- Scripts -->
    <script src="{{asset('js/jquery/jquery-1.8.3.min.js')}}"></script>
    <script src="{{asset('js/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('js/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/datatable/js/dataTables.responsive.js') }}"></script>
    <script src="{{ asset('js/datatable/js/datatables.bootstrap.js') }}"></script>
    {{--Start-JS--}}
    <script src="{{asset('js/jquery-ui/jquery-ui-1.10.1.custom.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/bootstrap-wysihtml5/Responsive-WYSIWYG/editor.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/bootstrap-file-input/bootstrap.file-input.js')}}" type="text/javascript"></script>
    {{--End-JS--}}

    @yield('head')
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>


			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                @if(Auth::check())
                    <ul class="nav navbar-nav">
                        <a class="navbar-brand" href="{{action('EmailController@create')}}">E-mails</a>
                    </ul>
                @endif


                <ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="{{ url('/auth/login') }}">Login</a></li>
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
                                @if(Auth::user()->type == "Administrador")
                                    <li><a href="{{ url('/painel') }}">Painel</a></li>
                                @endif
								<li><a href="{{ url('/auth/logout') }}">Sair</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>

	@yield('content')

</body>
</html>
