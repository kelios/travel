<?php

namespace App\Models;

use Brackets\Media\HasMedia\HasMediaCollectionsTrait;
use Brackets\Media\HasMedia\HasMediaThumbsTrait;
use Brackets\Media\HasMedia\ProcessMediaTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


class TravelAddress extends Model implements HasMedia
{

    use HasMediaCollectionsTrait;
    use HasMediaThumbsTrait;
    use ProcessMediaTrait;

    protected $table = 'travel_address';

    protected $fillable = [
        'travel_id',
        'country_id',
        'city_id',
        'coord',
        'address',
        'lat',
        'lng'
    ];


    protected $dates = [
        'created_at',
        'updated_at',

    ];

    protected $appends = [
        // 'lat',
        //   'lng',
        'coords',
        'travelImageAddress',
        'travelImageThumbUrl',
        'thumbs200Collection',
        'ImagesAddress'
    ];

    /* ************************ ACCESSOR ************************* */
    /*   public function getLatAttribute()
       {
           return Arr::get($this->coords, 'lat');
       }*/

    public function getCoordsAttribute()
    {
        if ($this->coord) {
            $coords = explode(',', $this->coord);

            return [
                'lat' => Arr::get($coords, 0),
                'lng' => Arr::get($coords, 1)
            ];
        } else {
            return [];
        }
    }

    public function getImagesAddressAttribute()
    {
        if ($this->travelImageThumbUrl) {
            return [
                $this->travelImageThumbUrl
            ];
        } else {
            return [];
        }
    }

    /* public function getlngAttribute()
     {
         return Arr::get($this->coords, 'lng');
     }*/


    public function travels()
    {
        return $this->belongsTo(Travel::class);
    }

    /**
     * @return string|null
     */
    public function getTravelImageThumbUrlAttribute(): ?string
    {
        $travelImageThumbUrl = '';
        $image = $this->getMedia('travelImageAddress');

        if (Arr::get($image, 0)) {
            if (Storage::disk(config('filesystems.storageDisk'))->exists($image[0]->getPath())) {
                Storage::disk(config('filesystems.storageDisk'))->delete($image[0]->getPath());
            }
            $travelImageThumbUrl = $image[0]->getUrl('thumb_200');
        }
        return $travelImageThumbUrl
            ?: '';

    }

    public function getTravelImageAddressAttribute()
    {
        $travelImageAddress = $this->getMedia('travelImageAddress');

        if (Arr::get($travelImageAddress, 0)) {
            $travelImageAddress['url'] = $travelImageAddress[0]->getUrl();
            $travelImageAddress['file_name'] = $travelImageAddress[0]->getCustomProperty('name');
        } else return null;
        return $travelImageAddress ?? null;

    }

    /* ************************ MEDIA ************************ */
    /**
     * Register media collections
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('travelImageAddress')
            ->maxFilesize(20 * 1024 * 1024)
            ->useDisk(config('filesystems.storageDisk'))
            ->accepts('image/*')
            ->singleFile();
    }

    /**
     * Register media conversions
     *
     * @param Media|null $media
     * @throws InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->autoRegisterThumb200();
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

    public function getThumbs200CollectionAttribute()
    {
        return $this->getThumbs200ForCollection('travelImageAddress');
    }

    public function сloseTo($radius = 60, $location = [])
    {
        $travelAddress = $this
            ->selectRaw("travel_id,
            ( 6371 * acos( cos( radians(" . $location['lat'] . ") ) *
            cos( radians(lat) ) *
            cos( radians(lng) - radians(" . $location['lng'] . ") ) +
            sin( radians(" . $location['lat'] . ") ) *
            sin( radians(lat) ) ) )
            AS distance")
            ->having("distance", "<", $radius)
            ->orderBy("distance")
            ->limit(20)
            ->get();
        foreach ($travelAddress as $travelAdd) {
            $ids[] = $travelAdd->travel_id;
        }
        return array_unique($ids);
    }

}
