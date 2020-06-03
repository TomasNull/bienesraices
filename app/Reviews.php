<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Reviews
 *
 * @property int $id
 * @property int $real_estate_id
 * @property int $user_id
 * @property int $rating
 * @property string|null $comment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\RealEstate $realEstate
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reviews newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reviews newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reviews query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reviews whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reviews whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reviews whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reviews whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reviews whereRealEstateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reviews whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reviews whereUserId($value)
 * @mixin \Eloquent
 */
class Reviews extends Model
{
    protected $fillable = ['real_estate_id', 'user_id', 'rating', 'comment'];

    public function realEstate() {
        return $this->belongsTo(RealEstate::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
