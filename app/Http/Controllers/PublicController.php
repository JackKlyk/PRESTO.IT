<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Laravel\Socialite\Facades\Socialite;


class PublicController extends Controller
{
   

    public function searchAnnouncements(Request $request){
        $announcements= Announcement::search($request->searched)->where('is_accepted', true)->paginate(12);
        return view('announcements.index', compact('announcements'));
    }


    public function homepage() {
        if (Lang::locale() == 'it') {$categories = Category::orderBy('name_it', 'asc')->get();} 
        elseif (Lang::locale() == 'eng') {$categories = Category::orderBy('name_en', 'asc')->get();} 
        elseif (Lang::locale() == 'es') {$categories = Category::orderBy('name_es', 'asc')->get();}
        $announcements = Announcement::orderBy('created_at', 'desc')->where('is_accepted', true)->take(4)->get();
        return view('homepage', compact('categories', 'announcements'));
    }

    public function search(Request $request) 
    {
        $announcement_search = '';
        if($request->search_category != 'Tutte le categorie') {
            $announcement_search = Announcement::orderBy('created_at', 'desc')->where('title', 'like', '%'.$request->search_announcement.'%')->where('category_id', $request->search_category)->get();
        }
        else {
            $announcement_search = Announcement::orderBy('created_at', 'desc')->where('title', 'like', '%'.$request->search_announcement.'%')->get();
        }
        
        return view('announcements.index', ['announcements' => $announcement_search]);
    }

    public function macro($macro) {
        if (Lang::locale() == 'it') {$categories = Category::orderBy('name_it', 'asc')->get();} 
        elseif (Lang::locale() == 'eng') {$categories = Category::orderBy('name_en', 'asc')->get();} 
        elseif (Lang::locale() == 'es') {$categories = Category::orderBy('name_es', 'asc')->get();}
        $announcements = Announcement::orderBy('created_at', 'desc')->get();
        return view('macro', compact('categories', 'announcements', 'macro'));
    }

    public function socialLoginRedirect($social) {
        return Socialite::driver($social)->redirect();
    }
    
    public function socialCallbackGoogle() {
        $googleUser = Socialite::driver('google')->user();

        $user = User::where('email', $googleUser->email)->first();

        if(!$user) {
        $user = User::updateOrCreate(
            [
            'name' => $googleUser->name,
            'email' => $googleUser->email,
            'gender' => 'Non specificato',
            'phone' => ' ' ,
            'password' => bcrypt(''),
            ]
        );

        Auth::login($user);

        }
        else {
            Auth::login($user);
 
            return redirect('/');
        }

        return redirect()->route('users.edit', ['user' => $user]);
    }

    public function socialCallbackGithub() {
        $githubUser = Socialite::driver('github')->user();

        $user = User::where('email', $githubUser->email)->first();

        if(!$user) {
        $user = User::updateOrCreate(
            [
            'name' => $githubUser->nickname,
            'email' => $githubUser->email,
            'gender' => 'Non specificato',
            'phone' => ' ' ,
            'password' => bcrypt(''),
            ]
        );
        }
 
        Auth::login($user);
 
        return redirect()->route('users.edit', ['user' => $user]);
    }

    // // //storage img profilo ??
    // // public function store(Request $request) {
    // //     $path_image='';
    // //     if($request->hasFile('img') && $request->file('img')->isValid()){
    // //         $path_name=$request->file('img')->getClientOriginalName();
    // //         $path_image=$request->file('img')->storeAs('public/images/profile',$path_name);
    // //     }
        
    // //     User::create([
    // //         'name'=>$request->name,
    // //         'email'=>$request->email,
    // //         'gender'=>$request->gender,
    // //         'phone'=>$request->phone,
    // //         'img'=>$path_image,
    // //         'birthday'=>$request->birthday,
    // //     ]);

    //     return redirect()->route('homepage')->with('success', 'Sei un utente!');
    // }

    public function setLanguage($lang)
    {
        session()->put('locale', $lang);
        return redirect()->back();
    }
}
