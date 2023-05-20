<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Dujoniba;
use App\Models\Bisyorjoniba;

class MuhlatiEtibor extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function dujonibaMuhlat(){
        return $this->belongsTo(Dujoniba::class);
    }

    public function bisyorjonibaMuhlat(){
        return $this->belongsTo(Bisyorjoniba::class);
    }
}
