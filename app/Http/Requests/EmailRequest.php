<?php namespace Renascer\Http\Requests;

use Renascer\Http\Requests\Request;

class EmailRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			"nome_cliente"  =>  "required|min:3",
            "email"  =>  "required|email|unique:emails,email",
            "loja"  =>  "required",
		];
	}

}
