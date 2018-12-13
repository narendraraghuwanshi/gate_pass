<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    protected $fillable = ['purpose','staffId','userId'];

    public function comments()
    {
        return $this->hasMany('App\TokenComment','tokenId');
    }

    public function user()
    {
        return $this->belongsTo('App\User','userId');
    }

}
