<?php

namespace App\Http\Controllers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use App\User;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;

class CandidatController extends Controller
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
        $candidat = User::all();
 
        return view('candidat.gest-candidats', compact('candidat'));
    }
  

    public function create()
    {
        return view('candidats.create');
    }
  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
                    $request->validate([
                        'name' => ['required', 'string', 'max:255'],
                        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                        'password' => ['required', 'string', 'min:8', 'confirmed'],
                    ]);

                    event(new Registered($user = User::create($request->all())));
            
                    return redirect('/admin/gest-candidats')->with('success', 'Contact saved!');
    }
   
    /**
     * Display the specified resource.
     *
     * @param  \App\Formateur  $formateur
     * @return \Illuminate\Http\Response
     */
    public function show(User $candidat)
    {
        return view('candidats.show',compact('candidat'));
    }
   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $candidat
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('user.user-profile')->with('user', auth()->user());
    }
  
   
    public function update(Request $request)
     { 
       /*  $request->validate([
            'name'=>'required',
         
            'email'=>'required'
        ]);*/
        $user = auth()->user();
        if ($request->hasFile('image')) {
            $imagePath=request('image')->store('uploads/ImageUser','public');
            $image      = $request->file('image');
            $fileName   = time() . '.' . $image->getClientOriginalExtension();

            $img = Image::make($image->getRealPath());
            $img = $img->resize(320, 280, function ($constraint) {
                $constraint->aspectRatio();                 
            });

            $img->save($imagePath); // <-- Key point

            //dd();
            Storage::disk('local')->put('uploads'.'/'.$fileName, $img, 'public');
             $user->image = $imagePath;
        }
        
        $user->name =  $request->get('name');
        $user->email = $request->get('email');
        
       
        $user->save();

        return redirect()->route('user.profile')
                        ->with('success','User updated successfully');
        
    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $candidat
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $candidat)
    {
        $candidat->delete();
  
        return redirect()->route('admin.gestion.candidat')
                        ->with('success','candidat deleted successfully');
    }
}

