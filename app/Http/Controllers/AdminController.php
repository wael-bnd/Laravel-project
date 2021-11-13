<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Formateur;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use App\User;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.admin-dashboard');
    }
    

    
    //Gestion Formatreur

    public function index_formateur()
    {
        $formateur = Formateur::get();
        return view('admin.admin-formateurs', compact('formateur'));
    }
    public function create_formateur()
    {
        return view('crud-formateurs.create');
    }
  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_formateur(Request $request)
    {
                    $data = $request->all();

                    $request->validate([
                        'first_name' => ['required', 'string', 'max:255'],
                        'last_name' => ['required', 'string', 'max:255'],
                        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                        'city' => ['required', 'string', 'max:255'],
                        'country' => ['required', 'string', 'max:255'],
                        'job_title' => ['required', 'string', 'max:255'],
                        'phone' => ['required', 'string', 'max:255'],
                        'password' => ['required', 'string', 'min:8', 'confirmed'],
                    ]);
                    Validator::make($data, [
                    'first_name' => ['required', 'string', 'max:255'],
                    'last_name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    'city' => ['required', 'string', 'max:255'],
                    'country' => ['required', 'string', 'max:255'],
                    'job_title' => ['required', 'string', 'max:255'],
                    'phone' => ['required', 'string', 'max:255'],
                    'password' => ['required', 'string', 'min:8', 'confirmed'],
                ]);

                    event(new Registered($user = Formateur::create([
                        'first_name'=> $data['first_name'],
                        'last_name'=> $data['last_name'],
                        'email' => $data['email'],
                        'city'=> $data['city'],
                        'country'=> $data['country'],
                        'job_title' => $data['job_title'],
                        'phone' => $data['phone'],
                        'password' => Hash::make($data['password']),
                    ])));
            
                    return redirect()->route('admin.gestion.formateur')
                    ->with('success','Formateur Added successfully');
    }
   
    /**
     * Display the specified resource.
     *
     * @param  \App\Formateur  $formateur
     * @return \Illuminate\Http\Response
     */
    public function show_formateur(Formateur $formateur)
    {
        return view('crud-formateurs.show',compact('formateur'));
    }
   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Formateur  $formateur
     * @return \Illuminate\Http\Response
     */
    public function edit_formateur(Formateur $formateur)
    {
        return view('crud-formateurs.edit',compact('formateur'));
    }
  
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Formateur  $formateur
     * @return \Illuminate\Http\Response
     */

    public function update_formateur(Request $request,$id)
    {
        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required'
        ]);
        
        $formateur = Formateur::find($id);
        $formateur->first_name =  $request->get('first_name');
        $formateur->last_name = $request->get('last_name');
        $formateur->email = $request->get('email');
        $formateur->job_title = $request->get('job_title');
        $formateur->city = $request->get('city');
        $formateur->country = $request->get('country');
        $formateur->phone = $request->get('phone');
        $formateur->save();

        return redirect()->route('admin.gestion.formateur')
                        ->with('success','Formateur updated successfully');
    }

  
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Formateur  $formateur
     * @return \Illuminate\Http\Response
     */
    public function destroy_formateur($id)
    {
        $formateur = Formateur::find($id);
        foreach ($formateur->formations as $formation){
            $formation->delete();
        }
        $formateur->delete();
        return redirect()->route('admin.gestion.formateur')
                        ->with('success','Formateur deleted successfully');
    }

    public function index_user()
    {
        $user = User::get();
        return view('admin.admin-users', compact('user'));
    }

    public function create_user()
    {
        return view('crud-users.create');
    }
  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_user(Request $request)
    {
                    $data = $request->all();

                    $request->validate([
                        'name' => ['required', 'string', 'max:255'],
                        
                        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                        'password' => ['required', 'string', 'min:8', 'confirmed'],
                    ]);
                    Validator::make($data, [
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    
                    'password' => ['required', 'string', 'min:8', 'confirmed'],
                ]);

                    event(new Registered($user = User::create([
                        'name'=> $data['name'],
                        'email' => $data['email'],
                        
                        'password' => Hash::make($data['password']),
                    ])));
            
                    return redirect()->route('admin.gestion.user')
                    ->with('success','User Added successfully');
    }
   
    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
      public function edit_user(User $user)
    {
        return view('crud-users.edit',compact('user'));
    }
  
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
     public function update_user(Request $request,$id)
    {
        $request->validate([
            'name'=>'required',
            
            'email'=>'required'
        ]);
        
        $user = User::find($id);
        $user->name =  $request->get('name');
        
        $user->email = $request->get('email');
        
        $user->save();

        return redirect()->route('admin.gestion.user')
                        ->with('success','User updated successfully');
    }

  
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy_user($id)
    {
        $user = User::find($id);
        
        $user->delete();
        return redirect()->route('admin.gestion.user')
                        ->with('success','User deleted successfully');
    }


}