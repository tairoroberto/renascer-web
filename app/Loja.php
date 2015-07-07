<?php namespace Renascer;

use Illuminate\Database\Eloquent\Model;

class Loja extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'lojas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

}
