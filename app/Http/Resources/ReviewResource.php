<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class ReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = Auth::user();
        $data = [
            'title' => $this->title,
            'comment' => $this->comment,
            'rating' => $this->rating,
            'created_at' => $this->created_at
        ];
        if (!isset($user->company_name)) {
            $data +=[
            'company_id' => $this->company_id,
            'company_name' => $this->company->company_name,
            'logo' => $this->company->logo,
        ];
        }
        return $data;
    }
}
