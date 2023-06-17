<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Bisyorjoniba;

class Mintaqaho extends Model
{
    use HasFactory;

    protected $fillable = ['name','bisyorjoniba_id'];

    public function bisyorjonibaMintaqa(){
        return $this->belongsTo(Bisyorjoniba::class);
    }
}
