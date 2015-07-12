<?php

namespace Renascer;

use Illuminate\Database\Eloquent\Model;

class EmailsEnviados extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'emails_enviados';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['count'];

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y H:i:s');
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y H:i:s');
    }

    public function getDeletedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y H:i:s');
    }
}
