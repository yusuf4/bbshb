<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use App\Models\FileShartnoma;
use App\Models\NamudiShartnoma;
use App\Models\TartibiEtibor;
use App\Models\MuhlatiEtibor;
use App\Models\Mintaqaho;
use App\Models\File;
use App\Models\NomeriShartnoma;

class Bisyorjoniba extends Model
{
    protected $fillable = [
        'name',
        'etibor_digar',
        'sanai_etibor',
        'qati_etibor',
        'maqomot',
        'namudi_shartnoma_id',
        'tartibi_etibor_id',
        'muhlati_etibor_id'
    ];

    public function countriesB()
    {
        return $this->belongsToMany(Country::class, 'bisyorjonibas_countries', 'bisyorjonibas_id', 'countries_id')->withTimestamps();
    }

    public function ezohB()
    {
        return $this->belongsToMany(Ezoh::class, 'ezohs_bisyorjonibas', 'bisyorjonibas_id', 'ezohs_id')->withTimestamps();
    }

    public function fileshartnomaB()
    {
        return $this->hasMany(FileShartnoma::class, 'bisyorjoniba_id', 'id');
    }

    public function namudB()
    {
        return $this->hasOne(NamudiShartnoma::class, 'id', 'namudi_shartnoma_id');
    }

    public function tartibiEtiborB()
    {
        return $this->hasOne(TartibiEtibor::class, 'id', 'tartibi_etibor_id');
    }

    public function nomerB()
    {
        return $this->hasOne(NomeriShartnoma::class, 'bisyorjoniba_id', 'id');
    }

    public function muhlatiEtiborB()
    {
        return $this->hasOne(MuhlatiEtibor::class, 'id', 'muhlati_etibor_id');
    }

    public function mintaqaho()
    {
        return $this->hasMany(Mintaqaho::class, 'bisyorjoniba_id', 'id');
    }

    public function fileBisyor()
    {
        return $this->hasMany(File::class);
    }
}
