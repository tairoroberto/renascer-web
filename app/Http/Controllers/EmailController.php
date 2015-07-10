<?php namespace Renascer\Http\Controllers;

use DebugBar\DebugBar;
use Renascer\Email;
use Renascer\Http\Requests;
use Renascer\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Renascer\Http\Requests\EmailRequest;
use Renascer\Jobs\EnviarEmailsJob;
use Renascer\Loja;
use Renascer\MensagemEmail;
use Illuminate\Foundation\Bus\DispatchesJobs;

class EmailController extends Controller {

    use DispatchesJobs;


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
		return view("emails.emails-lista");
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return view("emails.email-cadastro");
	}

	/**
	 * Store a newly created resource in storage.
	 * @param $request
	 * @return Response
	 */
	public function store(EmailRequest $request)
	{
		$input = $request->all();

        $validator = \Validator::make($input,$request->rules());

        if($validator->passes()){
            $email = new Email();

            $email->email = \Input::get("email");
            $email->cliente = \Input::get("nome_cliente");
            $email->situation = 'Ativado';
            $email->loja = \Input::get("loja");
            $email->user = \Auth::user()->id;

            $email->save();

            return \Redirect::route("email-cadastro")
                            ->withErrors(array("Sucesso" => "Email cadastrado com sucesso!"));
        }
        return \Redirect::route("email-cadastro")->withInput();
	}


    /*Envia emails para todos os clientes*/
    public function enviarEmailClientesLayout(){

        return view('emails.enviar-emails-clientes');
    }


    /*Envia emails para todos os clientes*/
    public function enviarEmailClientes(){

        if(\Input::get('mensagem') == ""){

            return \Redirect::to('enviar-emails-clientes-layout')
                ->withErrors(['Selecione uma mensagem para enviar o email.'])
                ->withInput();
        }

        if(\Input::get('loja') == ""){

            return \Redirect::to('enviar-emails-clientes-layout')
                ->withErrors(['Selecione a loja para enviar o email.'])
                ->withInput();
        }

        $loja = Loja::find(\Input::get('loja'));
        $emails = Email::where('loja', '=', \Input::get('loja'))
                       ->where('situation', '!=', 'Desativado')->get();
        $mensagem = MensagemEmail::where('id','=',\Input::get('mensagem'))->get()->first();


        if($emails->count() > 0){

            foreach($emails as $email){
                //call commnad
                $this->dispatch(
                    new EnviarEmailsJob($email, $mensagem)
                );
            }

            return \Redirect::route("enviar-emails-clientes-layout")
                ->withErrors(array("Sucesso" => "Email enviado com sucesso para os clientes da loja $loja->name!"));
        }else{
            return \Redirect::route("enviar-emails-clientes-layout")
                ->withErrors(array("Não existem emails cadastrados para a loja $loja->name!"));
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @return Response
     */
    public function dispararEmails()
    {
        return view('emails.disparo-emails');
    }

    /**
     * Show the form for editing the specified resource.
     * @param $options
     */
    public function runCommands($options){

        $commands = [
            'cd www',
            'cd renascer',
            '/usr/local/php/5.5/bin/php artisan '.$options
        ];

        \SSH::run($commands, function($line){
            echo $line.PHP_EOL."<pre>";
        });
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
		$email = Email::find($id);
        $email->situation = 'Desativado';
        $email->save();

        return \Redirect::to("http://renascercarnes.com.br");
	}

}
