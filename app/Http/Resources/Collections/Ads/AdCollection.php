<?php
namespace App\Http\Resources\Collections\Ads;

use Illuminate\Http\Resources\Json\JsonResource;

class AdCollection extends JsonResource
{
    public function toArray($request)
    {
        $data = [
            'title' => $this->title,
            'price' => $this->price,
            'main_photo' => $this->photos[0] ?? null,
        ];

        if ($request->has('fields')) {
            $fields = explode(',', $request->fields);

            if (in_array('description', $fields)) {
                $data['description'] = $this->description;
            }

            if (in_array('photos', $fields)) {
                $data['photos'] = $this->photos;
            }
        }

        return $data;
    }
}
