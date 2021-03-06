<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TodoItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'main_key' => uniqid(),
            'id' => $this->id,
            'name' => $this->name,
            'pinned' => $this->pinned  ? true : false,
            'completed' => ($this->completed) ? true : false,
            'user_id' => $this->user_id,
            'date' => $this->date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'memo' => new MemoResource($this->memo),
        ];
    }
}
