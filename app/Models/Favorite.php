<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable = ['user_id', 'real_estate_id'];

    public function realEstate()
    {
        return $this->belongsTo(RealEstate::class);
    }
}
