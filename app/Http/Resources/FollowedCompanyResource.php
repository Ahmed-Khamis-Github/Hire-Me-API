<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class FollowedCompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "logo" => $this->logo,
            "company_id" => $this->id,
            "company_name" => $this->company_name,
            "location" => $this->location,
			"about"=>$this->about,
		];
    }
	private function isFollowed($authUser,$company_id){
		return $authUser->follows()->where('company_id',$company_id)->exists();
	}
}
