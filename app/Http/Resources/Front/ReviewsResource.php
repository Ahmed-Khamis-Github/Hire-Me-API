<?php

namespace App\Http\Resources\Front;

use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewsResource extends JsonResource
{

    private function getUserName($user_id)
    {
        $user = User::find($user_id);
        if ($user) {
            $userName = $user->first_name . " " . $user->last_name;
            return $userName;
        }
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->pivot->title,
            'rating' => $this->pivot->rating,
            'comment' => $this->pivot->comment,
            'user_id' => $this->pivot->user_id,
            'user_name' => $this->getUserName($this->pivot->user_id),
            'date' => $this->pivot->created_at,
        ];
    }
}
