<?php

namespace App\Models;

use Brackets\Media\HasMedia\AutoProcessMediaTrait;
use Brackets\Media\HasMedia\HasMediaCollectionsTrait;
use Brackets\Media\HasMedia\HasMediaThumbsTrait;
use Brackets\Media\HasMedia\ProcessMediaTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\Models\Media;
use Cviebrock\EloquentSluggable\Sluggable;

class Travel extends Model implements HasMedia
{
    use Sluggable;
    use AutoProcessMediaTrait;
    use HasMediaCollectionsTrait;
    use HasMediaThumbsTrait;
    use ProcessMediaTrait;
    /**
     * @var string
     */
    protected $table = 'travels';
    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'budget',
        'year',
        'number_peoples',
        'number_days',
        'minus',
        'plus',
        'recommendation',
        'description',
        'publish',
        'visa',
        'slug',
        'meta_keywords',
        'meta_description'
    ];

    /**
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',

    ];
    /**
     * @var array
     */
    protected $appends = ['resource_url',
        'url',
        'travelAddressAdress',
        'travelAddressCity',
        'travelAddressCountry',
        'countryIds',
        'travel_image_thumb_url',
        'coordMeTravel',
        'countryName',
        'cityName',
        'categoryName',
        'monthName',
        'complexityName',
        'transportName',
        'overNightStayName',

    ];

    /* ************************ ACCESSOR ************************* */

    /**
     * @return string|null
     */
    public function getTravelImageThumbUrlAttribute(): ?string
    {
        $travelImageThumbUrl = $this->getFirstMediaUrl('travelMainImage', 'thumb_200');
        if (!$travelImageThumbUrl) {
            $travelImageThumbUrl = $this->categories ? $this->categories[0]->category_image_thumb_url : Config::get('constants.image.defaultCatImage');
        }
        return $travelImageThumbUrl
            ?: Config::get('constants.image.defaultCatImage');

    }

    public function getResourceUrlAttribute()
    {
        return url('/admin/travels/' . $this->getKey());
    }

    public function getUrlAttribute()
    {
        return url('/travels/' . $this->slug);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'travel_user')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'travel_category')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function transports()
    {
        return $this->belongsToMany(Transport::class, 'travel_transport')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function month()
    {
        return $this->belongsToMany(Month::class, 'travel_month')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function complexity()
    {
        return $this->belongsToMany(Complexity::class, 'travel_complexity')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function overNightStay()
    {
        return $this->belongsToMany(OverNightStay::class, 'travel_over_night_stay')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function countries()
    {
        return $this->belongsToMany(Country::class, 'travel_country', 'travel_id', 'country_id')
            ->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function cities()
    {
        return $this->belongsToMany(City::class, 'travel_city', 'travel_id', 'city_id')
            ->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function travelAddress()
    {
        return $this->hasMany(TravelAddress::class);
    }

    public function getTravelAddressAdressAttribute()
    {
        return $this->travelAddress()->pluck('address');
    }

    public function getTravelAddressCityAttribute()
    {
        return $this->travelAddress()->pluck('city_id');
    }

    public function getCoordMeTravelAttribute()
    {
        return $this->travelAddress()->pluck('coord');
    }

    public function getTravelAddressCountryAttribute()
    {
        return $this->travelAddress()->pluck('country_id');
    }

    public function getcountryIdsAttribute()
    {
        return $this->countries()->pluck('countries.country_id');
    }

    public function getCountryNameAttribute()
    {
        $countriesName = $this->countries()->pluck('countries.title_' . config('app.locale'))->toArray();
        return implode(', ', $countriesName);
        //return $this->countries()->pluck('countries.title_' . config('app.locale'));
    }

    public function getCityNameAttribute()
    {
        $cityName = $this->cities()->pluck('cities.title_' . config('app.locale'))->toArray();
        return implode(', ', $cityName);
        //return $this->cities()->pluck('cities.title_' . config('app.locale'));
    }

    public function getCategoryNameAttribute()
    {
        $categoriesName = $this->categories()->pluck('categories.name')->toArray();
        return implode(', ', $categoriesName);
    }

    public function getMonthNameAttribute()
    {
        $monthName = $this->month()->pluck('month.name')->toArray();
        return implode(', ', $monthName);
    }

    public function getComplexityNameAttribute()
    {
        $complexityName = $this->complexity()->pluck('complexity.name')->toArray();
        return implode(', ', $complexityName);
    }

    public function getTransportNameAttribute()
    {
        $transportsName = $this->transports()->pluck('transport.name')->toArray();
        return implode(', ', $transportsName);
    }

    public function getOverNightStayNameAttribute()
    {
        $overnightstayName = $this->overNightStay()->pluck('over_night_stay.name')->toArray();
        return implode(', ', $overnightstayName);
    }


    public function delete()
    {
        $this->cities()->detach();
        $this->countries()->detach();

        $this->complexity()->detach();
        $this->transports()->detach();
        $this->overNightStay()->detach();
        $this->users()->detach();
        $this->month()->detach();
        $this->categories()->detach();

        $this->travelAddress()->delete();

        return parent::delete();
    }

    /* ************************ MEDIA ************************ */
    /**
     * Register media collections
     */
    public function registerMediaCollections()
    {
        $this->addMediaCollection('travelMainImage')
            ->maxFilesize(10 * 1024 * 1024)
            ->useDisk('s3')
            ->accepts('image/*');
    }

    /**
     * Register media conversions
     *
     * @param Media|null $media
     * @throws InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null)
    {
        $this->autoRegisterThumb200();

        $this->addMediaConversion('thumb_75')
            ->width(75)
            ->height(75)
            ->fit('crop', 75, 75)
            ->optimize()
            ->performOnCollections('travelMainImage')
            ->nonQueued();

        $this->addMediaConversion('thumb_150')
            ->width(150)
            ->height(150)
            ->fit('crop', 150, 150)
            ->optimize()
            ->performOnCollections('travelMainImage')
            ->nonQueued();
    }

    /**
     * Auto register thumb overridden
     */
    public function autoRegisterThumb200()
    {
        $this->getMediaCollections()->filter->isImage()->each(function ($mediaCollection) {
            $this->addMediaConversion('thumb_200')
                ->width(914)
                ->height(538)
                ->fit('crop', 914, 914)
                ->optimize()
                ->performOnCollections($mediaCollection->getName())
                ->nonQueued();
        });
    }

    public function sluggable()
    {
        return ['slug' => ['source' => 'name']];
    }

    public function setMetaKeywordsAttribute($value)
    {
        $this->attributes['meta_keywords'] = 'metravel, travel, путешествия, ' .
            $this->countryName . ', ' . $this->cityName . ', ' . $this->name;
    }

    public function setMetaDescriptionAttribute($value)
    {
        $this->attributes['meta_description'] = 'metravel, travel, путешествия, выбрать место для отдыха,' .
            $this->countryName . ', ' . $this->cityName . ', ' . $this->name;
    }


}
