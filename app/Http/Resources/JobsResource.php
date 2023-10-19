<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            '7amada'=>$this->name ,
            'maxsalary'=>$this->max_salary ,
            'logo'=>$this->company->logo
        ];
    }
}
