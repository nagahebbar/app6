<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Page extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'display_name' => $this->display_name,
            'name' => $this->name,
            'content' => $this->content,
            'author_id' => $this->author_id()
        ];
    }
}
