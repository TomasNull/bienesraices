<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Str;

/**
 * App\RealEstate
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RealEstate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RealEstate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RealEstate query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $agent_id
 * @property int $category_id
 * @property string $status_estate
 * @property string $name
 * @property string $description
 * @property string $address
 * @property string $city
 * @property string $country
 * @property float $price
 * @property int $bedrooms
 * @property int $bathrooms
 * @property int $yard
 * @property int $pool
 * @property int $garage
 * @property int $new_construct
 * @property string $slug
 * @property string|null $picture
 * @property string $status
 * @property int $previous_approved
 * @property int $previous_rejected
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RealEstate whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RealEstate whereAgentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RealEstate whereBathrooms($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RealEstate whereBedrooms($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RealEstate whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RealEstate whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RealEstate whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RealEstate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RealEstate whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RealEstate whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RealEstate whereGarage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RealEstate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RealEstate whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RealEstate whereNewConstruct($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RealEstate wherePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RealEstate wherePool($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RealEstate wherePreviousApproved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RealEstate wherePreviousRejected($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RealEstate wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RealEstate whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RealEstate whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RealEstate whereStatusEstate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RealEstate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RealEstate whereYard($value)
 */
class RealEstate extends Model
{
    use SoftDeletes;

    protected $fillable = ['agent_id', 'name', 'description', 'picture', 'status', 'category_id', 
                            'status_estate', 'bathrooms', 'bedrooms', 'price', 'city', 'address', 
                            'country', 'yard', 'pool', 'garage', 'new_construct'];
    
    const PUBLISHED = 1;
    const PENDING = 2;
    const REJECTED = 3;
    const RENTAL = 4;
    const SALE = 5;

    protected $withCount = ['clients', 'reviews'];

    public static function boot() {
        parent::boot();

        static::saving(function(RealEstate $estate) {
            if( ! \App::runningInConsole()) {
                $estate->slug = Str::slug($estate->name, '-');
            }
        });
    }

    public function pathAttachment() {
        return "/storage/realestates/" . $this->picture;
    }

    public function getRouteKeyName() {
        return 'slug';
    }

    public function category() {
        return $this->belongsTo(Category::class)->select('id', 'name');
    }

    public function reviews() {
        return $this->hasMany(Reviews::class)->select('id', 'user_id', 'real_estate_id', 'rating', 'comment', 'created_at');
    }

    public function clients() {
        return $this->belongsToMany(Client::class);
    }

    public function agent() {
        return $this->belongsTo(Agent::class);
    }

    public function getRatingAttribute() {
        return $this->reviews->avg('rating');
    }

    public function relatedEstates() {
        return RealEstate::with('reviews')->whereCategoryId($this->category->id)
            ->where('id', '!=', $this->id)
            ->latest()
            ->limit(6)
            ->get();
    }
    
}
