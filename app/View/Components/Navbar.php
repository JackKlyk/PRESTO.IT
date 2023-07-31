<?php

namespace App\View\Components;

use App\Models\Announcement;
use Closure;
use App\Models\Category;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class Navbar extends Component
{
    public $categories;
    public $announcements_to_check;

    public function __construct()
    {
        if (Lang::locale() == 'it') {$this->categories = Category::orderBy('name_it', 'asc')->get();} 
        elseif (Lang::locale() == 'eng') {$this->categories = Category::orderBy('name_en', 'asc')->get();} 
        elseif (Lang::locale() == 'es') {$this->categories = Category::orderBy('name_es', 'asc')->get();}
        
        if (Auth::user() != null) {
            $this->announcements_to_check = Announcement::where('is_accepted', null)->where('user_id', '!=', Auth::user()->id)->count();
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.navbar');
    }
}
