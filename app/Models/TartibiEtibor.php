<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Dujoniba;
use App\Models\Bisyorjoniba;

class TartibiEtibor extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function dujonibaTartib(){
        return $this->belongsTo(Dujoniba::class);
    }

    public function bisyorjonibaTartib(){
        return $this->belongsTo(Bisyorjoniba::class);
    }
}
