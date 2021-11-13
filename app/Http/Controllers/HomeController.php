<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Formation;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('user.user-dashboard');
    }
    public function profile()
    {
        $user = auth()->user();
        return view('user.user-profile',compact('user',$user));
    }

    public function table()
    {
        return view('user.user-table');
    }

    public function show_formation($id)
    {
        $formation = Formation::find($id) ;
        return view('crud-formation.show' ,compact('formation'));

    }
  
    

}
