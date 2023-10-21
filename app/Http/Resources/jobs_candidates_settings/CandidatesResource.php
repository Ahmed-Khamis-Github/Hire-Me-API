<?php

namespace App\Http\Resources\jobs_candidates_settings;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CandidatesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'f-name'=>$this->first_name ,
            'l-name'=>$this->last_name ,
            'email'=>$this->email ,
            'logo'=>$this->profile->avatar,
            'mobile'=>$this->profile->mobile_number,
            'nationality'=>$this->profile->nationality,
            'cv'=>$this->cv,

            
        ];
}
}
