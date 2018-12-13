<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TokenComment extends Model
{
    protected $fillable = ['tokenId','userId','comment'];

    public function user()
    {
        return $this->belongsTo('App\User','userId');
    }

    public function token()
    {
        return $this->belongsTo('App\Token','tokenId');
    }

}
