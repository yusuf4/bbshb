<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FileShartnoma;
use App\Models\NamudiShartnoma;
use App\Models\TartibiEtibor;
use App\Models\MuhlatiEtibor;
use App\Models\Mintaqaho;
use App\Models\File;

class Bisyorjoniba extends Model
{
    use HasFactory;


    public function fileShartnomaB(){
        return $this->hasOne(FileShartnoma::class);
    }

    public function namudiShartnomaB(){
        return $this->hasOne(NamudiShartnoma::class);
    }

    public function tartibiEtiborB(){
        return $this->hasOne(TartibiEtibor::class);
    }

    public function muhlatiEtiborB(){
        return $this->hasOne(MuhlatiEtibor::class);
    }

    public function mintaqaho(){
        return $this->belongsTo(Mintaqaho::class);
    }

    public function fileBisyor(){
        return $this->hasMany(File::class);
    }
}
