<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    public function __construct($resource, $attributes = null)
    {
        // Ensure you call the parent constructor
        parent::__construct($resource);
        $this->resource = $resource;

        $this->attributes = $attributes;
    }

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'cover' => $this->cover,
            'price' => $this->price, //already discounted (to be Added)
            $this->mergeWhen($this->attributes == 'description', [
                'description' => $this->description,

            ]),
            'authors' => ($this->authors)->implode('fullname',' ,'),
            'genres' => ($this->genres)->implode('name',' ,'),
        ];
    }
}
