<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'actual_comment' => $this->actual_comment,
            'created_at' => $this->get_days_ago_readable(),
            'user_id' => $this->user->name,
        ];
    }
}
