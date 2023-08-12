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
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Request;

class Dujoniba extends Model
{

    protected $fillable = ['name', 'jonibi_tj','jonibi_digar','etibor_digar','sanai_etibor','qati_etibor',
        'imzo_tj','imzo_digar','ezoh','file_shartnoma_id','namudi_shartnoma_id','tartibi_etibor_id','muhlati_etibor_id'];

    protected $dates = ['sanai_etibor','qati_etibor','created_at','updated_at'];

    /*public function getSanaiEtiborAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['sanai_etibor'])->locale('is_IS')->format('d.m.Y');
    }
    public function getQatiEtiborAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['qati_etibor'])->locale('is_IS')->format('d.m.Y');
    }*/
    public function countriesD()
    {
        return $this->belongsToMany(Country::class, 'dujonibas_countries', 'dujonibas_id', 'countries_id')->withTimestamps();
    }
    public function fileShartnoma(){
        return $this->belongsTo(FileShartnoma::class);
    }

    public function namudiShartnoma(){
        return $this->hasOne(NamudiShartnoma::class, 'id', 'namudi_shartnoma_id');
    }
    public function nomerD()
    {
        return $this->hasOne(NomeriShartnoma::class, 'dujoniba_id', 'id');
    }

    public function tartibiEtibor(){
        return $this->hasOne(TartibiEtibor::class, 'id', 'tartibi_etibor_id');
    }

    public function muhlatiEtibor(){
        return $this->hasOne(MuhlatiEtibor::class, 'id', 'muhlati_etibor_id');
    }

    public function fileDujoniba(){
        return $this->hasMany(File::class, 'dujoniba_id', 'id');
    }


}
