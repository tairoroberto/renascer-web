<?php namespace Renascer\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Renascer\Http\Requests;
use Renascer\Http\Requests\MensagemEmailRequest;
use Renascer\MensagemEmail;

class MensagemEmailController extends Controller {


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
		return view('mensagem-email.mesagem-emails');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return view('mensagem-email.mesagem-emails');
	}

	/**
	 * Store a newly created resource in storage.
	 * @param MensagemEmailRequest $request
	 * @return Response
	 */
	public function store(MensagemEmailRequest $request)
	{
        $input = $request->all();

        $validator = \Validator::make($input,$request->rules());
        if($validator->passes()){

            $mensagemEmail = new MensagemEmail();
            $mensagemEmail->text = \Input::get('mensagem');

            if(Input::file('imagem') != ''){
                $imageName = md5(uniqid(time())) . "." . Input::file('imagem')->guessExtension();
                $imagemSalva = Input::file('imagem')->move('img/mensagem/',$imageName);
                if($imagemSalva){
                    $mensagemEmail->image = 'img/mensagem/'.$imageName;
                }
            }
            $mensagemEmail->save();


            return \Redirect::route("mesagem-emails")
                ->withErrors(array("Sucesso" => "Mensagem de Email cadastrado com sucesso!"));
        }
        return \Redirect::route("mesagem-emails")->withInput();
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
