<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inschijving extends Model
{
    protected $table = 'inschrijvingen';
    protected $fillable = ['workshop', 'name', 'email', 'studentnummer'];

    public function workshop()
    {
        return $this->belongsTo('App\Models\Workshop');
    }
}
