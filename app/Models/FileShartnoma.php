<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Dujoniba;
use App\Models\Bisyorjoniba;
use Illuminate\Support\Carbon;

class FileShartnoma extends Model
{
    protected $fillable = ['name'];

    public function dujonibaF(){
        return $this->hasOne(Dujoniba::class, 'file_shartnoma_id', 'id');
    }

    public function bisyorjonibafile(){
        return $this->hasOne(Bisyorjoniba::class, 'file_shartnoma_id', 'id');
    }
}
