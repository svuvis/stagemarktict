<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{
    protected $table = 'workshops';
    protected $fillable = ['name', 'max'];

    public function inschrijvingen()
    {
        return $this->hasMany('App\Models\Inschrijving');
    }
}
