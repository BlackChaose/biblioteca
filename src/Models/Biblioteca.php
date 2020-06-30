<?php

namespace BlackChaose\Biblioteca\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Biblioteca extends Model
{
    use Notifiable;
    protected $table = 'biblioteca';
    protected $fillable = [
        'name',
        'description',
        'author',
        'lang'
    ];
    protected $hidden = [];

    public function attached_file(){
        return $this->hasMany('BlackChaose\Biblioteca\Models\AttachedFile','bib_entity_id');
    }
    public function get_attached_file(){

         return $this->attached_file()->get()->first();
    }
}
