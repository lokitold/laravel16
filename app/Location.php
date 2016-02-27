<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    public function noticia()
    {
        return $this->belongsTo('App\Noticia');
    }
}
