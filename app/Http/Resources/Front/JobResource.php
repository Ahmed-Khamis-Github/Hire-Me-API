<?php

namespace App\Http\Resources\Front;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // $rating = $this->company->users->pluck('pivot.rating')->filter()->average();

        // Convert the created_at timestamp to a DateTime object
        $createdDateTime = new DateTime($this->created_at);

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
            'job_id'=>$this->id ,
            'job_name'=>$this->name ,
            'min_salary' => $this->formatSalary($this->min_salary),
            'max_salary' => $this->formatSalary($this->max_salary),
            'job_type'=>$this->type ,
            'job_experience'=>$this->experience ,
            'job_location' => $this->location,
            'job_description' => $this->about,
            'job_date' => $job_date,
            'job_bookmarked'=>$this->isBookmarked(),
            'category_id' => $this->category_id,
            'category_name' => $this->category->name,
            'company_id' => $this->company_id,
            'company_logo'=>$this->company->logo ,
            'company_name' => $this->company->company_name,
            'company_rating' => number_format($this->company->users->avg('pivot.rating'), 1),
            'company_nationality' => $this->company->nationality,
            'company_verified' => !is_null($this->company->email_verified_at),
        ];
    }
    
    
    function formatSalary($salary) {
        // Convert the binary(10,2) value to a regular float
        $floatSalary = floatval($salary);
    
        // Define the symbols for thousands and millions
        $symbols = array('', 'K', 'M', 'B', 'T');
    
        // Initialize the symbol index
        $symbolIndex = 0;
    
        // While the salary is greater than or equal to 1000 and there are more symbols
        while ($floatSalary >= 1000 && $symbolIndex < count($symbols)) {
            $floatSalary /= 1000;
            $symbolIndex++;
        }
    
        // Format the salary as a string
        $formattedSalary = number_format($floatSalary) . $symbols[$symbolIndex];
    
        return $formattedSalary;
    }
}
