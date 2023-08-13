<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ezoh extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name'];

    public function dujonibaE()
    {
        return $this->belongsToMany(Dujoniba::class, 'ezohs_dujonibas', 'ezohs_id', 'dujonibas_id');
    }

    public function bisyorjonibaE()
    {
        return $this->belongsToMany(Bisyorjoniba::class, 'ezohs_bisyorjonibas', 'ezohs_id', 'bisyorjonibas_id');
    }
}
