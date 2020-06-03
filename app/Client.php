<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Client
 *
 * @property int $id
 * @property int $user_id
 * @property string $phone_number
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Client newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Client newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Client query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Client whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Client whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Client wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Client whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Client whereUserId($value)
 * @mixin \Eloquent
 */
class Client extends Model
{
    protected $fillable = ['user_id', 'phone_number',];

    protected $appends = ['estates_formatted'];

    public function realEstate() {
        return $this->belongsToMany(RealEstate::class);
    }

    public function user() {
        return $this->belongsTo(User::class)->select('id', 'role_id', 'name', 'email');
    }

    public function getEstatesFormattedAttribute () {
        return $this->realEstate->pluck('name')->implode(', ');
    }
}
