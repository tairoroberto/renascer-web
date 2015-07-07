<?php namespace Renascer\Http\Controllers;

use Renascer\Http\Requests;
use Renascer\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Renascer\Loja;

class LojaController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('lojas.loja-cadastro');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return view('lojas.loja-cadastro');
	}

	/**
	 * Store a newly created resource in storage.
	 * @param $request
	 * @return Response
	 */
	public function store(Requests\LojaResquest $request)
	{
        $input = $request->all();

        $validator = \Validator::make($input,$request->rules());

        if($validator->passes()){
            $loja = new Loja();

            $loja->name = \Input::get("loja");

            $loja->save();

            return \Redirect::to("lojas-cadastro")
                ->withErrors(array("Sucesso" => "Loja cadastrada com sucesso!"));
        }
        return \Redirect::to("lojas-cadastro")->withInput();
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
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
