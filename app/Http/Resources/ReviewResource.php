<?php

namespace App\Http\Resources;
use App\Models\User;
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
    private function getUser($user_id)
    {
        $user = User::find($user_id);
        if ($user) {
            return [
				'user_name'=>$user->first_name . " " . $user->last_name,
				'logo'=> $user->avatar,
                'user_id'=>$user_id
			];
        }else{
            return [];
        }
    }
    public function toArray(Request $request): array
    {
        $data = [
            'id' => $this->id,
            'title' => $this->title,
            'comment' => $this->comment,
            'rating' => $this->rating,
            'created_at' => $this->created_at,

        ];
        $user = Auth::user();
		if (isset($user->company_name)) {
            $data=array_merge($this->getUser($this->user_id),$data);
        }else{
            $data['company_id'] = $this->company_id;
            $data['company_name'] = $this->company->company_name;
            $data['logo'] = $this->company->logo;
        }
        return $data;
    }
}
