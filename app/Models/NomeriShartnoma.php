<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Dujoniba;
use App\Models\Bisyorjoniba;

class NomeriShartnoma extends Model
{
    protected $fillable=['dujoniba_id','bisyorjoniba_id'];

    public function shartnomaD()
    {
        return $this->hasOne(Dujoniba::class, 'id', 'dujoniba_id');
    }
    public function shartnomaB()
    {
        return $this->belongsTo(Bisyorjoniba::class, 'id', 'bisyorjoniba_id');
    }
}
