<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'code', 'name'];

    public function dujonibas()
    {
        return $this->belongsToMany(Dujoniba::class, 'dujonibas_countries', 'countries_id', 'dujonibas_id');
    }
    public function bisyorjonibas()
    {
        return $this->belongsToMany(Bisyorjoniba::class, 'bisyorjonibas_countries', 'countries_id', 'bisyorjonibas_id');
    }
}
