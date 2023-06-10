<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FileShartnoma;
use App\Models\NamudiShartnoma;
use App\Models\TartibiEtibor;
use App\Models\MuhlatiEtibor;
use App\Models\File;
use App\Models\NomeriShartnoma;

class Dujoniba extends Model
{

    protected $fillable = ['name', 'jonibi_tj','jonibi_digar','etibor_digar','sanai_etibor','qati_etibor',
        'imzo_tj','imzo_digar','ezoh','file_shartnoma_id','namudi_shartnoma_id','tartibi_etibor_id','muhlati_etibor_id'];


    public function getSanaiEtiborAttribute($value)
    {
        return \Carbon\Carbon::createFromFormat('Y-m-d', $value)->format('d-m-Y');
    }

    public function fileShartnoma(){
        return $this->belongsTo(FileShartnoma::class);
    }

    public function namudiShartnoma(){
        return $this->hasOne(NamudiShartnoma::class, 'id', 'namudi_shartnoma_id');
    }
    public function nomerD()
    {
        return $this->belongsTo(NomeriShartnoma::class);
    }

    public function tartibiEtibor(){
        return $this->hasOne(TartibiEtibor::class, 'id', 'tartibi_etibor_id');
    }

    public function muhlatiEtibor(){
        return $this->hasOne(MuhlatiEtibor::class);
    }

    public function fileDujoniba(){
        return $this->hasMany(File::class, 'dujoniba_id', 'id');
    }


}
