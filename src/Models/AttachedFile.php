<?php

namespace BlackChaose\Biblioteca\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class AttachedFile extends Model
{
    use Notifiable;
    protected $table = 'bib_attached_files';
    protected $fillable = [
        'file_path',
        'file_name',
        'file_type',
        'dic_entity_id'
    ];
    protected $hidden = [];

    public function attached_file(){
        return $this->belongsTo('BlackChaose\Biblioteca\Models\Biblioteca','bib_entity_id','id');
    }

}

