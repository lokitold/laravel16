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

    #relations

    public function locations()
    {
        return $this->hasMany('App\Location');
    }

    #scopes
    public function scopeStatus($query,$status){

        if(trim($status) != ''):
            $query->where('status', $status);
        endif;
    }

    public function scopeDateBetween($query,$desde,$hasta){

        $carbon = new \Carbon\Carbon();

        if(empty($desde)):
            $desdeDate = $carbon::now();
            $desdeDate = $desdeDate->subDay(1);
            $desde = $desdeDate->format('Y-m-d H:i:s');    
        endif;
        
        if(empty($hasta)):
            $date = $carbon::now();
            $hasta = $date->format('Y-m-d H:i:s');    
        endif;

        $query->whereBetween('fecha_publicacion', [$desde, $hasta])->get();
    }
     
}
