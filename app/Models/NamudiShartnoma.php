<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Dujoniba;
use App\Models\Bisyorjoniba;

class NamudiShartnoma extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function dujonibaNamud(){
        return $this->belongsTo(Dujoniba::class);
    }

    public function bisyorjonibaNamud(){
        return $this->belongsTo(Bisyorjoniba::class);
    }


}
