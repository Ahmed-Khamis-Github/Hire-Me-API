<?php

namespace App\Http\Resources\EmployeeProfile;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SocialResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "github"=>$this->github_account,
            "linkedin"=>$this->linkedin_account,
            "twitter"=>$this->twitter_account,
        ];
    }
}
