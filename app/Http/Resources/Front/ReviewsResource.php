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
        // Convert the created_at timestamp to a DateTime object
        $createdDateTime = new DateTime($this->pivot->created_at);
        // Get the current date
        $currentDateTime = new DateTime();
        // Calculate the difference between the current date and the created_at date
        $interval = $createdDateTime->diff($currentDateTime);

        // Format the date based on the difference
        if ($interval->y >= 1) {
            $formattedDate = $interval->y . ' year' . ($interval->y > 1 ? 's' : '') . ' ago';
        } elseif ($interval->m >= 1) {
            $formattedDate = $interval->m . ' month' . ($interval->m > 1 ? 's' : '') . ' ago';
        } elseif ($interval->d >= 7) {
            $weeks = floor($interval->d / 7);
            $formattedDate = $weeks . ' week' . ($weeks > 1 ? 's' : '') . ' ago';
        } elseif ($interval->d >= 1) {
            $formattedDate = $interval->d . ' day' . ($interval->d > 1 ? 's' : '') . ' ago';
        } else {
            $formattedDate = 'Today';
        }

        return [
            'id' => $this->id,
            'title' => $this->pivot->title,
            'rating' => $this->pivot->rating,
            'comment' => $this->pivot->comment,
            'user_id' => $this->pivot->user_id,
            'user_name' => $this->getUserName($this->pivot->user_id),
            'date' => $formattedDate,
        ];
    }
}
