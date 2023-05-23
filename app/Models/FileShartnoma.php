<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Dujoniba;
use App\Models\Bisyorjoniba;

class FileShartnoma extends Model
{
    protected $fillable = ['name'];

    public function dujonibaF(){
        return $this->hasOne(Dujoniba::class, 'file_shartnoma_id', 'id');
    }

    public function bisyorjoniba(){
        return $this->belongsTo(Bisyorjoniba::class);
    }
}
