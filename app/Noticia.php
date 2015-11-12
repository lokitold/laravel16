<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'noticia';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['source_id', 'descripcion', 'url', 'titulo', 'imagen', 'fecha_publicacion', 'status'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = ['password', 'remember_token'];

    public function scopeStatus($query,$status){

        if(trim($status) != ''):
            $query->where('status', $status);
        endif;
    }
}