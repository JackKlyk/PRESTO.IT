<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class AdminController extends Controller
{
    public function dashboard(){
        $announcements = Announcement::orderBy('updated_at', 'desc')->get();
        if (Lang::locale() == 'it') {$categories = Category::orderBy('name_it', 'asc')->get();} 
        elseif (Lang::locale() == 'eng') {$categories = Category::orderBy('name_en', 'asc')->get();} 
        elseif (Lang::locale() == 'es') {$categories = Category::orderBy('name_es', 'asc')->get();}
        $users = User::orderBy('name', 'asc')->get();

        return view('admin.dashboard', compact('announcements', 'categories', 'users'));
    }

    public function beHidden(Announcement $announcement){
        $announcement->setAccepted(false);
        return redirect()->back()->with('delete', 'Annuncio nascosto');
    }

    public function beVisible(Announcement $announcement){
        $announcement->setAccepted(true);
        return redirect()->back()->with('success', 'Annuncio visibile');
    }
}
