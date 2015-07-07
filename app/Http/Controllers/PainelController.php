<?php namespace Renascer\Http\Controllers;

use Renascer\Http\Requests;
use Renascer\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Renascer\Loja;
use Renascer\User;

class PainelController extends Controller {


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $lojas = Loja::all();
        $caixas = User::where('type','=','Caixa')->get();

		return view('painel.painel',compact('lojas','caixas'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @return Response
	 */
	public function destroy()
	{
		$user = User::find(\Input::get('user'));
        $user->delete();

        return \Redirect::to("relatorio-usuarios")
            ->withErrors(array("Sucesso" => "Usuário deletado com sucesso!"));
	}

}
