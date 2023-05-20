<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FileShartnoma;
use App\Models\NamudiShartnoma;
use App\Models\TartibiEtibor;
use App\Models\MuhlatiEtibor;
use App\Models\File;

class Dujoniba extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'jonibi_tj','jonibi_digar','etibor_digar','sanai_etibor','qati_etibor',
        'imzo_tj','imzo_digar','ezoh','file_shartnoma_id','namudi_shartnoma_id','tartibi_etibor_id','muhlati_etibor_id'];

    public function fileShartnoma(){
        return $this->hasOne(FileShartnoma::class);
    }

    public function namudiShartnoma(){
        return $this->hasOne(NamudiShartnoma::class);
    }

    public function tartibiEtibor(){
        return $this->hasOne(TartibiEtibor::class);
    }

    public function muhlatiEtibor(){
        return $this->hasOne(MuhlatiEtibor::class);
    }

    public function fileDujoniba(){
        return $this->belongsTo(File::class);
    }
}
