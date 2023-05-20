<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Dujoniba;
use App\Models\Bisyorjoniba;

class FileShartnoma extends Model
{
    use HasFactory;

    protected $fillable = ['name','path'];

    public function dujoniba(){
        return $this->belongsTo(Dujoniba::class);
    }

    public function bisyorjoniba(){
        return $this->belongsTo(Bisyorjoniba::class);
    }
}
