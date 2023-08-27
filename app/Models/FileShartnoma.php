<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Dujoniba;
use App\Models\Bisyorjoniba;

class FileShartnoma extends Model
{
    protected $fillable = ['id', 'name', 'dujoniba_id', 'bisyorjoniba_id'];

    public function dujonibaF()
    {
        return $this->belongsTo(Dujoniba::class, 'dujoniba_id', 'id');
    }

    public function bisyorjonibafile()
    {
        return $this->belongsTo(Bisyorjoniba::class, 'bisyorjoniba_id', 'id');
    }
}
