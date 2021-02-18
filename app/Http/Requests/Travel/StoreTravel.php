<?php

namespace App\Http\Requests\Travel;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\Support\Arr;

class StoreTravel extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'id' => ['nullable', 'integer'],
            'name' => ['nullable', 'string'],
            'budget' => ['nullable', 'integer'],
            'year' => ['nullable', 'integer'],
            'number_peoples' => ['nullable', 'integer'],
            'number_days' => ['nullable', 'integer'],
            'minus' => ['nullable', 'string'],
            'plus' => ['nullable', 'string'],
            'recommendation' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'publish' => ['nullable', 'boolean'],

            'slug' => ['nullable', 'string'],
            'meta_keywords' => ['nullable', 'string'],
            'meta_description' => ['nullable', 'string'],
            //images
            'pathToFile' => ['nullable', 'string']
        ];
    }

    /**
     * Modify input data
     *
     * @return array
     */
    public function getSanitized(): array
    {
        $sanitized = $this->validated();

        //Add your code for manipulation with request data here

        return $sanitized;
    }

    /**
     * @param $keyEntity
     * @param string $searchKey
     * @return array|null
     */
    public function getRelationIds($keyEntity, $searchKey = 'id')
    {
        if ($this->has($keyEntity) && !is_null($this->get($keyEntity))) {
            $data = [];
            foreach ($this->get($keyEntity) as $entity) {
                $data[] = Arr::get($entity, $searchKey);
            }
            return $data;
        }
        return null;
    }

    public function getRelationAddress()
    {
        $data = [];
        $travelAddress = $this->get('travelAddressAdress', []);
        $travelAddressCountry = $this->get('travelAddressCountry', []);
        $travelAddressCity = $this->get('travelAddressCity', []);
        $coordsMeTravel = $this->get('coordsMeTravel', []);
        $travelAddressIds = $this->get('travelAddressIds');
        $travelImageAddress = $this->get('travelImageAddress');

        foreach ($travelAddress as $key => $value) {
            $data[$key]['id'] = Arr::get($travelAddressIds, $key, '');
            $data[$key]['address'] = $value;
            $data[$key]['coord'] = implode(',', Arr::get($coordsMeTravel, $key, []));
            $data[$key]['city_id'] = Arr::get($travelAddressCity, $key) != '-1' ? Arr::get($travelAddressCity, $key) : null;
            $data[$key]['country_id'] = $travelAddressCountry[$key];
            $data[$key]['travelAddrMedia'] = Arr::get($travelImageAddress, $key);
        }
        return $data;
    }

    public function getRelationMedia()
    {
        $data = [];
        $travelImageAddress = $this->get('travelImageAddress');
        $travelAddressIds = $this->get('travelAddressIds');
        foreach ($travelAddressIds as $key => $value) {
            $data[$value] = array_get($travelImageAddress, $key, []);
        }
        return $data;
    }


}
