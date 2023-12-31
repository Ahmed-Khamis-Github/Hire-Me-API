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
		$jobName = $this->apply->isNotEmpty() ? $this->Apply->first()->name : null;
        return [
            'f-name'=>$this->first_name ,
            'l-name'=>$this->last_name ,
            'email'=>$this->email ,
            'logo'=>$this->avatar,
            'mobile'=>$this->mobile_number,
            'nationality'=>$this->nationality,
            'cv'=>$this->cv,
			'id'=>$this->id,
			'job' =>$jobName,
            // 'company'=>$this->Apply->company_id,
            // 'job'=>$this->Apply->job_id,


        ];
}
}
