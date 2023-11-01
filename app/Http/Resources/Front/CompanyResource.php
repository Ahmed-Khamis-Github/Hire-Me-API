<?php

namespace App\Http\Resources\Front;
use DateTime;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */ 
    public function toArray(Request $request): array
    {
        //calculating the average company rating
        $rating = number_format($this->users->pluck('pivot.rating')->filter()->average(),1);

        $openJobs = $this->jobs->map(function ($job) {
            // Convert the created_at timestamp to a DateTime object
            $createdDateTime = new DateTime($job->created_at);
            // Get the current date
            $currentDateTime = new DateTime();
            // Calculate the difference between the current date and the created_at date
            $interval = $createdDateTime->diff($currentDateTime);
            
            // Format the date based on the difference
            if ($interval->y >= 1) {
                $job_date = $interval->y . ' year' . ($interval->y > 1 ? 's' : '') . ' ago';
            } elseif ($interval->m >= 1) {
                $job_date = $interval->m . ' month' . ($interval->m > 1 ? 's' : '') . ' ago';
            } elseif ($interval->d >= 7) {
                $weeks = floor($interval->d / 7);
                $job_date = $weeks . ' week' . ($weeks > 1 ? 's' : '') . ' ago';
            } elseif ($interval->d >= 1) {
                $job_date = $interval->d . ' day' . ($interval->d > 1 ? 's' : '') . ' ago';
            } else {
                $job_date = 'Today';
            }
        
            return [
                'id' => $job->id,
                'title' => $job->name,
                'location' => $job->location,
                'type' => $job->type,
                'post_date' => $job_date,
                'is_bookmarked' => $job->isBookmarked(),
            ];
        });

        return [
            'id'=>$this->id ,
            'logo'=>$this->logo ,
            'name'=>$this->company_name,
            'title' => $this->title,
            'location' => $this->location,
            'about' => $this->about,
            'nationality' => $this->nationality,    
            'verified' => $this->verified,
            'rating' => $rating,
            'open_jobs' => $openJobs,
            'reviews' => ReviewsResource::collection($this->users),
            // 'social_medias' => $this->socials->profile_link,
        ];
    }
}
