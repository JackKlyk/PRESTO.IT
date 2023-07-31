<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\BecomeRevisor;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redis;

class RevisorController extends Controller
{
    public function index()
    {
        if(Auth::user()->is_admin){
            $announcement_to_check = Announcement::where('is_accepted', null)->first();
        }
        else{
            $announcement_to_check = Announcement::where('is_accepted', null)->where('user_id', '!=', Auth::user()->id)->first();
        }

        if (Lang::locale() == 'it') {$categories = Category::orderBy('name_it', 'asc')->get();} 
        elseif (Lang::locale() == 'eng') {$categories = Category::orderBy('name_en', 'asc')->get();} 
        elseif (Lang::locale() == 'es') {$categories = Category::orderBy('name_es', 'asc')->get();}
        $announcements = Announcement::orderBy('created_at', 'desc')->where('is_accepted', true)->take(4)->get();

        if ($announcement_to_check == null) {
            return redirect()->route('homepage', compact('categories', 'announcements'))->with('success', 'Non ci sono annunci da revisionare! Torna più tardi!');
        }
        else {
            return view('revisor.index', compact('announcement_to_check'));
        }
    }

    public function acceptAnnouncement(Announcement $announcement)
    {
        Auth::user()->wallet += 0.05;
        Auth::user()->save();
        $announcement->setAccepted(true);
        return redirect()->back()->with('revisorSuccess', 'Annuncio accettato!');
    }

    public function rejectAnnouncement(Announcement $announcement)
    {
        Auth::user()->wallet += 0.05;
        Auth::user()->save();
        $announcement->setAccepted(false);
        return redirect()->back()->with('revisorDelete', 'Annuncio rifiutato!');
    }

    public function becomeRevisor(Request $request)
    {
        Auth::user()->description = $request->input('description');
        Auth::user()->save();
        Mail::to('admin@presto.it')->send(new BecomeRevisor(Auth::user()));
        return redirect()->back()->with('success', 'Hai chiesto di diventare revisore!');
    }

    public function makeRevisor(User $user)
    {
        Artisan::call('presto:makeUserRevisor', ["email"=>$user->email]);

        return redirect()->route('admin.dashboard')->with('success', 'L\'utente è diventato revisore!');
    }

    public function dismissRevisor(User $user)
    {
        $user->is_revisor = false;
        $user->save();

        return redirect()->route('admin.dashboard')->with('delete', 'L\'utente è stato licenziato!');
    }

    public function undoAnnouncement(Announcement $announcement_to_undo) {
        Auth::user()->wallet -= 0.05;
        Auth::user()->save();
        $announcement_to_undo = Announcement::orderBy('updated_at', 'desc')->where('is_accepted', '!=', null)->where('user_id', '!=', Auth::user()->id)->first();
        $announcement_to_undo->setAccepted(null);

        return redirect()->back()->with('edit', 'Annuncio ripristinato! Revisionalo nuovamente!');

    }
}
