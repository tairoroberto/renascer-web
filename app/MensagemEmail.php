<?php namespace Renascer;

use Illuminate\Database\Eloquent\Model;

class MensagemEmail extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'mensagem_emails';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['text','image'];


}
