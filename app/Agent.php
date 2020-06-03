<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Agent
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $title
 * @property string|null $biography
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Agent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Agent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Agent query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Agent whereBiography($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Agent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Agent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Agent whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Agent whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Agent whereUserId($value)
 * @mixin \Eloquent
 */
class Agent extends Model
{
    public function realEstate() {
        return $this->hasMany(RealEstate::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
