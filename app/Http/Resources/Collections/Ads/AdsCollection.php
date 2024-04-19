<?php

namespace App\Http\Resources\Collections\Ads;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AdsCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return ['data' => $this->collection->transform(function ($ad) {
            $photos = $ad->photos??[];
            array_unshift($photos, $ad->photo);
            return [
                'id' => $ad->id,
                'title' => $ad->title,
                'photo' => $photos[0],
                'price' => $ad->price
            ];
        }),
            'meta' => [
                'total' => $this->total(),
                'count' => $this->count(),
                'per_page' => $this->perPage(),
                'current_page' => $this->currentPage(),
                'total_pages' => $this->lastPage()
            ]
        ];
    }
}
