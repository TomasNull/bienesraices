<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSocialAccount extends Model
{
    //Se crea la propiedad fillable. Indica al modelo que datos se pueden insertar utlizando el método create()
    protected $fillable = ['user_id', 'provider', 'provider_uid',];

    public $timestamps = false;

    public function user() {
        return $this->belongsTo(User::class);
    }
}
