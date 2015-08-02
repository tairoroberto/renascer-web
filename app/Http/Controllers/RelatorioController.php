<?php namespace Renascer\Http\Controllers;

use Carbon\Carbon;
use Renascer\Email;
use Renascer\Http\Requests;
use Renascer\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Renascer\Loja;
use Renascer\User;

class RelatorioController extends Controller {

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
		//
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function cadastroUsuarios()
    {
        \Auth::logout();
        return view('auth.register');
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function relatorioUsuarios()
	{
        $users = User::all();
        return view('relatorio.relatorio-usuarios',compact('users'));
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function relatorioEmails()
    {
        $qtdTotalEmails = Email::all()->count();
        $qtdHojeEmails = Email::where('created_at','>=',date('Y-m-d').' 00:00:00')
                              ->where('created_at','<=',date('Y-m-d').' 23:59:59')->count();
        return view('relatorio.relatorio-emails',compact('qtdTotalEmails','qtdHojeEmails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function relatorioEmailsData()
    {
        $emails = Email::join('lojas', 'lojas.id', '=', 'emails.loja')->select(['emails.email','emails.cliente','emails.situation','lojas.name','emails.created_at'])->get();
        return \Datatables::of($emails)->make(true);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function relatorioCaixa()
    {
        if(\Input::get('caixa_id') == ""){
            return \Redirect::to('painel')
                            ->withErrors(['Informe a caixa para a busca de relatório!']);
        }

        $qtdTotalEmails = Email::where('user','=',\Input::get('caixa'))->count();
        $qtdHojeEmails = Email::where('user','=',\Input::get('caixa'))
                              ->where('created_at','>=',date('Y-m-d').' 00:00:00')
                              ->where('created_at','<=',date('Y-m-d').' 23:59:59')->count();
        $user = User::find(\Input::get('caixa_id'));
        return view('relatorio.relatorio-caixa',compact('qtdTotalEmails','qtdHojeEmails','user'));
    }

    public function relatorioCaixaData($id){
        $emails = Email::join('lojas', 'lojas.id', '=', 'emails.loja')
                       ->select(['emails.email','emails.cliente','emails.situation','lojas.name','emails.created_at'])
                       ->where('user', '=', $id)->get();
        return \Datatables::of($emails)->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function relatorioLoja()
    {
        if(\Input::get('loja_id') == ""){
            return \Redirect::to('painel')
                ->withErrors(['Informe a loja para a busca de relatório!']);
        }

        $qtdTotalEmails = Email::where('loja','=',\Input::get('loja_id'))->count();
        $qtdHojeEmails = Email::where('loja','=',\Input::get('loja_id'))
            ->where('created_at','>=',date('Y-m-d').' 00:00:00')
            ->where('created_at','<=',date('Y-m-d').' 23:59:59')->count();
        $loja = Loja::find(\Input::get('loja_id'));
        return view('relatorio.relatorio-loja',compact('qtdTotalEmails','qtdHojeEmails','loja'));
    }

    public function relatorioLojaData($id){
        $emails = Email::join('lojas', 'lojas.id', '=', 'emails.loja')
            ->select(['emails.email','emails.cliente','emails.situation','lojas.name','emails.created_at'])
            ->where('loja', '=', $id)->get();
        return \Datatables::of($emails)->make(true);
    }

}
