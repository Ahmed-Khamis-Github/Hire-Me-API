<?php

namespace App\Http\Resources\EmployeeProfile;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Helpers\ApiResponse;
use App\Models\User;
use App\Http\Resources\EmployeeProfile\EmployeeSkills;
use App\Http\Resources\EmployeeProfile\SocialResource;
use App\Http\Resources\EmployeeProfile\HistoryResource;
class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
            "verafied" => $this->verified,
            "title"=>$this->title,
            "avatar" => $this->avatar,
            "aboat" => $this->about,

            "nationality"=>$this->nationality,
            "cv"=>$this->cv,

            'skill_name'=>EmployeeSkills::Collection($this->skills),
            'social_link'=>SocialResource::Collection($this->socials),
            'history'=>HistoryResource::Collection($this->histories),

        ];
    }
}
