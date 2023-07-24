<?php

namespace App\Http\Controllers\Emailtool;

use App\Http\Controllers\Controller;
use App\Models\Email;
use App\Models\Sample;
use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Requests\Emails\Save as SaveRequest;

class Emails extends Controller
{
    public function index()
    {
        $emails = Email::all();               
        return view('emails.index', compact('emails'));
    }

    public function edit($id)
    {
        $email = Email::findOrFail($id);
        return view('emails.edit', compact('email'));
    }

    public function update(SaveRequest $request, $id)
    {
        $email = Email::findOrFail($id);
        
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
            $seo = 'I have been working as an assistant of SEO experts for a long time and have experience in writing SEO friendly articles.';
        } else {
            $seo = '';
        }
        
        $cost = $request->cost;
        $conclusion = $request->conclusion;

        $email = Email::findOrFail($id);       
        if ($spam === null)
        {
            $spam = '';               
        } 
        else 
        {
            $spam = $request->spam; 
        }         
        
        $email->spam = $spam;
        $email->client = $client;
        $email->intro = $intro;

        $email->wordpress = $wordpress;        
        $email->seo = $seo;        

        $email->cost = $cost;
        $email->conclusion = $conclusion;
        $email->save();

        return redirect()->route('emails.index');
    }
    
}
