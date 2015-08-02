<?php namespace Renascer\Http\Controllers;

use Renascer\Email;
use Renascer\EmailsEnviados;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');

        //verificação de emails enviados
        $emailEnviados = EmailsEnviados::find(1);
        if(date('d') == '01'){
            if(($emailEnviados->count >= 9500) || ($emailEnviados->canSend == 0)){
                $emailEnviados->count = 0;
                $emailEnviados->canSend = 1;
                $emailEnviados->save();
            }
        }
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
        if(\Auth::check()){

			if(\Auth::user()->type == "Administrador"){
                return \Redirect::to('painel');
            }
            return view('emails.email-cadastro');
        }
	}


    public function teste()
    {
        return view('teste');
    }

    public function testeData()
    {   $emails = Email::all();
        return \Datatables::of($emails)->make(true);
    }

}
