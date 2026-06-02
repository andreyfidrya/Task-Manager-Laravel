<?php

namespace App\Http\Controllers\Answertool;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\User;
use App\Models\Notification;
use App\Models\Category;
use App\Models\Script;
use Illuminate\Http\Request;
use App\Http\Requests\Answers\Save as SaveRequest;
use Illuminate\Support\Facades\Auth;

class Answers extends Controller
{
    public function index()
    {
        $username = Auth::user()->name;          
        
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $profile_image = $user->profile_image;

        $unread_notifications_number = Notification::with('user')->where('is_read',0)->count();
        $unread_notifications = Notification::with('user')->where('is_read',0)->get();               
        
        $categories_before_main_text = Category::where('beforemaintext', 1)->get();
        $categories_after_main_text = Category::where('beforemaintext', 0)->get();        

        return view('answers.index', compact('unread_notifications', 'unread_notifications_number', 'username', 'profile_image', 'categories_before_main_text', 'categories_after_main_text'));
    }
    
    public function generate(Request $request)
    {
        $username = Auth::user()->name;          
        
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $profile_image = $user->profile_image;

        $unread_notifications_number = Notification::with('user')->where('is_read',0)->count();
        $unread_notifications = Notification::with('user')->where('is_read',0)->get();
        
        $answer = '';

        // Скрипты до основного текста
        $beforeCategories = Category::where('beforemaintext', 1)->get();

        foreach ($beforeCategories as $category) {

            $scriptId = $request->categories[$category->id] ?? null;

            if ($scriptId) {
                $script = Script::find($scriptId);

                if ($script) {
                    $answer .= $script->text . "\n\n";
                }
            }
        }

        // Основной текст
        $answer .= $request->MainText . "\n\n";

        // Скрипты после основного текста
        $afterCategories = Category::where('beforemaintext', 0)->get();

        foreach ($afterCategories as $category) {

            $scriptId = $request->categories[$category->id] ?? null;

            if ($scriptId) {
                $script = Script::find($scriptId);

                if ($script) {
                    $answer .= $script->text . "\n\n";
                }
            }
        }

        return view('answers.result', compact('answer', 'unread_notifications', 'unread_notifications_number', 'username', 'profile_image'));
    }
}
