<?php

namespace App\Http\Controllers\Emailtool;

use App\Http\Controllers\Controller;
use App\Models\Email;
use App\Models\Sample;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\Emails\Save as SaveRequest;
use Illuminate\Support\Facades\Auth;

class Emails extends Controller
{
    public function index()
    {
        $username = Auth::user()->name;
        $email = Email::first();  
        
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $profile_image = $user->profile_image;

        return view('emails.index', compact('email', 'username', 'profile_image'));
    }

    public function edit()
    {
        $username = Auth::user()->name;
        $email = Email::first();

        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $profile_image = $user->profile_image;

        return view('emails.edit', compact('email', 'username', 'profile_image'));
    }

    public function update(SaveRequest $request, $id)
    {
        $spam = $request->spam;        
        $client = $request->client;
        $intro = $request->intro;        
                
        if($request->wordpress === 'Yes')
        {
            $wordpress = 'I am an experienced WordPress user. So, I can post articles, insert images and links into blog posts, update menus on site, etc.';
        } else {
            $wordpress = '';
        }

        if($request->seo === 'Yes')
        {
            $seo = 'I have been working as an assistant of SEO experts for a long time and have experience in writing SEO-optimized content.';
        } else {
            $seo = '';
        }
        
        $cost = $request->cost;
        $conclusion = $request->conclusion;

              
        $email = Email::first();

        $email->update([
            'spam' => $spam,
            'client' => $client,
            'intro' => $intro,
            'wordpress' => $wordpress,
            'seo' => $seo,
            'cost' => $cost,
            'conclusion' => $conclusion
        ]); 

        return redirect()->route('emails.index');
    }
    
}
