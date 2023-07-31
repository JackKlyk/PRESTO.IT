<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $announcements = Announcement::orderBy('created_at', 'desc')->get();
        return view('announcements.index', compact('announcements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('announcements.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Announcement $announcement)
    {

        $announcements = Announcement::orderBy('created_at', 'desc')->where('is_accepted', true)->take(4)->get();
        $users = User::all();
        if($announcement->is_accepted || Auth::user()->is_admin){
            $announcement = $announcement;
        }
        else {
            abort(404);
        }
        return view('announcements.show', compact('announcement', 'users', 'announcements'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Announcement $announcement)
    {
        if($announcement->user_id == Auth::user()->id || Auth::user()->is_admin){
            $announcement = $announcement;
        }
        else {
            abort(404);
        }
        return view('announcements.edit', compact('announcement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Announcement $announcement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Announcement $announcement)
    {
        if($announcement->user_id == Auth::user()->id || Auth::user()->is_admin){
            $announcement->delete();
        }
        else {
            abort(404);
        }
        return redirect()->back()->with('delete', 'Annuncio eliminato!');
    }

    public function likeAnnouncement(Announcement $announcement) {
        $announcement->users()->attach(Auth::user()->id);
        return redirect()->back()->with('success', 'Annuncio aggiunto ai tuoi preferiti!');
    }

    public function dislikeAnnouncement(Announcement $announcement) {
        $announcement->users()->detach(Auth::user()->id);
        return redirect()->back()->with('delete', 'Annuncio rimosso dai tuoi preferiti!');
    }
}
