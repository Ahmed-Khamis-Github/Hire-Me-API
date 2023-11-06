<?php

namespace App\Http\Controllers\API\Front;

use App\Events\Contact;
use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\User;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contact(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $subject = $request->input('subject');
        $comments = $request->input('comments');

         $question = new Question();
        $question->name = $name;
        $question->email = $email;
        $question->subject = $subject;
        $question->message = $comments;

        $question->save();
        event(new Contact($question));

    }

    //get admin info

    public function getAdmin(){
        $admin = User::where('role', 'admin')->with('socials')->get();
        return ApiResponse::sendResponse(200,"response is sucssefully",$admin);
    }
}
