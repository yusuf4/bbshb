<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Dujoniba;
use App\Models\Bisyorjoniba;

class File extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'path', 'dujoniba_id','bisyorjoniba_id'];

    public function dujonibafile(){
        return $this->hasMany(Dujoniba::class, 'id', 'dujoniba_id');
    }

    public function bisyorjonibafile(){
        return $this->belongsTo(Bisyorjoniba::class);
    }
}
