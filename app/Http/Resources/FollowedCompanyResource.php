<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
            "company_id" => $this->company->id,
            "company_name" => $this->company->company_name,
            "location" => $this->company->location,
		];
    }
}
