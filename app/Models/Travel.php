<?php

namespace App\Models;

use Brackets\Media\HasMedia\AutoProcessMediaTrait;
use Brackets\Media\HasMedia\HasMediaCollectionsTrait;
use Brackets\Media\HasMedia\HasMediaThumbsTrait;
use Brackets\Media\HasMedia\ProcessMediaTrait;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\MediaLibrary\HasMedia;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Arr;
use TravelSave;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Image\Manipulations;

/**
 * Class Travel
 * @package App\Models
 */
class Travel extends Model implements HasMedia
{
    use Sluggable;
    use Filterable;

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
        'meta_description',
        'sitemap',
        'moderation',
        'youtube_link'
    ];

    protected $casts = [
        'publish' => 'boolean',
        'sitemap' => 'boolean',
        'moderation' => 'boolean',
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
    protected $appends = [
        'resource_url',
        'url',
        'travelAddressAdress',
        'travelAddressCity',
        'travelAddressCountry',
        'travelAddressIds',
        'countryIds',
        'countriesCode',
        'travel_image_thumb_url',
        'travel_image_thumb_small_url',
        'gallery',
        'travelMainImage',
        'coordMeTravel',
        'coordsMeTravelArr',
        'imageMeTravelArr',
        'countryName',
        'cityName',
        'categoryName',
        'monthName',
        'complexityName',
        'transportName',
        'overNightStayName',
        'userIds',
        'userName',
        'totalLikes',
        'travelRoad',
        'countUnicIpView',
        'travelRoadFilename',
        'travelRoadUrl'
    ];

    public function modelFilter()
    {
        return $this->provideFilter(\App\ModelFilters\TravelFilter::class);
    }

    /* ************************ ACCESSOR ************************* */

    /**
     * @return string|null
     */
    public function getTravelImageThumbUrlAttribute(): ?string
    {
        $travelImageThumbUrl = '';
        $image = $this->getMedia('travelMainImage')->first();

        if ($image) {
            if (Storage::disk(config('filesystems.storageDisk'))->exists($image->getPath())) {
                Storage::disk(config('filesystems.storageDisk'))->delete($image->getPath());
            }
            //dd($image->hasGeneratedConversion('webpTravelMainImage_400'));
            if ($image->hasGeneratedConversion('webpTravelMainImage_400')) {
                $travelImageThumbUrl = $image->getUrl('webpTravelMainImage_400');
            } elseif ($image->hasGeneratedConversion('thumb_400')) {
                $travelImageThumbUrl = $image->getUrl('thumb_400');
            } elseif ($image->hasGeneratedConversion('webpTravelMainImage')) {
                $travelImageThumbUrl = $image->getUrl('webpTravelMainImage');
            } else {
                $travelImageThumbUrl = $image->getUrl('thumb_200');
            }
        }
        //    dd($image->getPath('webpTravelMainImage_400'));

        /*   if (app()->environment('production') && $travelImageThumbUrl) {
               $pattern = 'https://'.config('filesystems.disks.s3.bucket') .
                   '.' . config('filesystems.disks.s3.driver') .
                   '.' . config('filesystems.disks.s3.region')
                   . '.amazonaws.com';
               $newUrl = config('app.url').'/'.config('constants.resize.previewMainTravel');
               return str_replace($pattern, $newUrl, $travelImageThumbUrl);
           } else {
               return $travelImageThumbUrl
                   ?: config('constants.image.defaultCatImage');
           }*/
        return $travelImageThumbUrl
            ?: config('constants.image.defaultCatImage');
    }

    /**
     * @return string|null
     */
    public function getTravelImageThumbSmallUrlAttribute(): ?string
    {
        $travelImageThumbUrl = '';
        $image = $this->getMedia('travelMainImage')->first();

        if ($image) {
            if (Storage::disk(config('filesystems.storageDisk'))->exists($image->getPath())) {
                Storage::disk(config('filesystems.storageDisk'))->delete($image->getPath());
            }

            if ($image->hasGeneratedConversion('webpTravelMainImage')) {
                $travelImageThumbUrl = $image->getUrl('webpTravelMainImage');
            } else {
                $travelImageThumbUrl = $image->getUrl('thumb_200');
            }
        }
        return $travelImageThumbUrl
            ?: config('constants.image.defaultCatImage');
    }


    public function getGalleryAttribute()
    {
        $images = $this->getMedia('gallery');
        foreach ($images as $key => $image) {
            if (Storage::disk(config('filesystems.storageDisk'))->exists($image->getPath())) {
                Storage::disk(config('filesystems.storageDisk'))->delete($image->getPath());
            }
            $res[$key]['srcset'] = $image->getSrcset('detail_hd');
            $res[$key]['url'] = $image->getUrl('detail_hd');
            $res[$key]['title'] = $this->name;
        }
        return $res ?? null;
    }

    public function getTravelRoadAttribute()
    {
        $travelRoad = $this->getMedia('travelRoad');

        if (Arr::get($travelRoad, 0)) {
            $travelRoad['url'] = $travelRoad[0]->getUrl();
            $travelRoad['file_name'] = $travelRoad[0]->getCustomProperty('name');
        } else return null;
        return $travelRoad ?? null;

    }

    public function getTravelRoadFilenameAttribute()
    {
        $travelRoad = $this->getMedia('travelRoad')->first();
        return isset($travelRoad) ? $travelRoad->getCustomProperty('name') : '';

    }

    public function getTravelRoadUrlAttribute()
    {
        $travelRoad = $this->getMedia('travelRoad')->first();
        return  isset($travelRoad) ? $travelRoad->getUrl() : '';
    }

    public function getTravelMainImageAttribute()
    {
        $travelRoad = $this->getMedia('travelMainImage');
        if (Arr::get($travelRoad, 0)) {
            $travelRoad['url'] = $travelRoad[0]->getUrl();
            $travelRoad['file_name'] = $travelRoad[0]->getCustomProperty('name');
        } else return null;
        return $travelRoad ?? null;

    }

    public function getResourceUrlAttribute()
    {
        return url('/admin/travels/' . $this->slug);
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
        return $this->belongsToMany(\App\User::class, 'travel_user')->withTimestamps();
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
        return $this->belongsToMany(Complexity::class, 'travel_complexity')
            ->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function companion()
    {
        return $this->belongsToMany(Companion::class, 'travel_companion', 'travel_id', 'travel_companion_id')->withTimestamps();
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

    public function belTravels()
    {
        return $this->belongsToMany(Country::class, 'travel_country', 'travel_id', 'country_id')
            ->where('countries.country_id', '=', 3)
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

    public function views()
    {
        return $this->hasMany(TravelView::class);
    }

    public function likes()
    {
        return $this->belongsToMany(\App\User::class, 'travel_like');
    }

    public function travelLike()
    {
        return $this->hasMany(TravelLike::class);
    }

    public function userFavoriteTravel()
    {
        return $this->belongsToMany(\App\User::class, 'travel_save');
    }

    public function travelSave()
    {
        return $this->belongsToMany(TravelSave::class);
    }

    public function getTotalLikesAttribute()
    {
        return $this->travelLike()->count();
    }

    public function getCountUnicIpViewAttribute()
    {
        return $this->views()->distinct('ip')->count();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
        // return $this->morphMany(Comment::class)->whereNull('reply_id');
    }

    public function getThreadedComments()
    {
        return $this->comments()->with('user')->orderBy('created_at', 'desc')->get()->threaded();
    }

    public function getTravelAddressAdressAttribute()
    {
        return $this->travelAddress()->pluck('address');
    }

    public function getTravelAddressIdsAttribute()
    {
        return $this->travelAddress()->pluck('id');
    }

    public function getTravelAddressCityAttribute()
    {
        return $this->travelAddress()->pluck('city_id');
    }

    public function getCoordMeTravelAttribute()
    {
        return $this->travelAddress()->pluck('coord');
    }

    public function getCoordsMeTravelArrAttribute()
    {
        return $this->travelAddress()->pluck('coord')->toArray();
    }

    public function getImageMeTravelArrAttribute()
    {
        return $this->travelAddress()->get()->pluck('travelImageThumbUrl')->toArray();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getTravelAddressCountryAttribute()
    {
        return $this->travelAddress()->pluck('country_id');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getcountryIdsAttribute()
    {
        return $this->countries()->pluck('countries.country_id');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getCountriesCodeAttribute()
    {
        return $this->countries()->pluck('countries.country_code')->toArray() ?? [];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getUserIdsAttribute()
    {
        return $this->users()->pluck('users.id')->toArray();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getUserNameAttribute()
    {
        $userName = $this->users()->pluck('users.name')->toArray();
        return implode(', ', $userName);
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
        $this->companion()->detach();
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
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('travelMainImage')
            ->maxFilesize(20 * 1024 * 1024)
            ->useDisk(config('filesystems.storageDisk'))
            ->accepts('image/*')
            ->singleFile();

        $this->addMediaCollection('travelRoad')
            ->useDisk(config('filesystems.storageDisk'))
            ->singleFile();

        $this->addMediaCollection('gallery')
            ->maxNumberOfFiles(10)
            ->maxFilesize(20 * 1024 * 1024)
            ->useDisk(config('filesystems.storageDisk'))
            ->accepts('image/*')
            ->onlyKeepLatest(10);
    }

    /**
     * @param Media|null $media
     * @throws InvalidManipulation
     * @throws \League\Flysystem\FileNotFoundException
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->autoRegisterThumb200();

        $this->addMediaConversion('webpTravelMainImage')
            ->width(300)
            ->height(300)
            ->watermark(public_path('/media/slider/watermark.png'))
        //    ->watermarkOpacity(50)
            ->format(Manipulations::FORMAT_WEBP)
            ->quality(96)
            ->optimize()
            ->performOnCollections('travelMainImage')
            ->nonQueued();

        $this->addMediaConversion('webpTravelMainImage_400')
            ->width(800)
          //  ->height(400)
            ->watermark(public_path('/media/slider/watermark.png'))
          //  ->watermarkOpacity(50)
            ->format(Manipulations::FORMAT_WEBP)
            ->quality(96)
            ->optimize()
            ->performOnCollections('travelMainImage')
            ->nonQueued();

        $this->getMediaCollections()->filter->isImage()->each(function ($mediaCollection) {
            $this->addMediaConversion('thumb_400')
                ->width(400)
                ->height(400)
                ->watermark(public_path('/media/slider/watermark.png'))
                //->watermarkOpacity(50)
                ->quality(80)
                ->optimize()
                ->performOnCollections('travelMainImage')
                ->nonQueued();
        });
      /*  if (app()->environment('production')) {
            $this->watermarkOpacity(50);
        }*/
        $this->addMediaConversion('detail_hd')
            ->fit('crop', 1080, 1080)
            ->watermark(public_path('/media/slider/watermark.png'))
          //  ->watermarkOpacity(50)
            ->quality(96)
            ->optimize()
            ->withResponsiveImages()
            ->performOnCollections('gallery')
            ->nonQueued();
      /*  if (app()->environment('production')) {
            $this->watermarkOpacity(50);
        }*/
    }

    /**
     * Auto register thumb overridden
     */
    public function autoRegisterThumb200()
    {

        $this->getMediaCollections()->filter->isImage()->each(function ($mediaCollection) {
            $this->addMediaConversion('thumb_200')
                ->width(200)
                ->height(200)
                ->watermark(public_path('/media/slider/watermark.png'))
                ->quality(80)
          //      ->watermarkOpacity(50)
                ->optimize()
                ->performOnCollections($mediaCollection->getName())
                ->nonQueued();
        });
    }

    public function sluggable(): array
    {
        return ['slug' => ['source' => 'name']];
    }
    /*
        public function setMetaKeywordsAttribute($value)
        {
            $this->attributes['meta_keywords'] = mb_strimwidth('metravel, travel, путешествия, ' .
                $this->countryName . ', ' . $this->cityName . ', ' . $this->name, 0, 255);
        }

        public function setMetaDescriptionAttribute($value)
        {
            $this->attributes['meta_description'] = mb_strimwidth('metravel, travel, путешествия, выбрать место для отдыха,' .
                $this->countryName . ', ' . $this->cityName . ', ' . $this->name . ', ' . $this->categoryName, 0, 255);
        }*/
}
