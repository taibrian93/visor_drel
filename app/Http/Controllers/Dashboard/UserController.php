<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:Crear')->only('create','store');
        $this->middleware('can:Leer')->only('index', 'show');
        $this->middleware('can:Editar')->only('edit', 'update');
        $this->middleware('can:Eliminar')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::class;
        return view('dashboard.user.index')
                ->with(['user' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('dashboard.user.create')->with([
            'roles' => $roles
        ]);
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
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:4',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $user->roles()->attach($request->roles);
        return redirect()
                ->route('user.index')
                ->with([
                    'message' => 'El registro se agrego satisfactoriamente!',
                ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('dashboard.user.edit')
                ->with([
                    'user' => $user,
                    'roles' => $roles,
                ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        $update = [
            'name' => $request->name,
            'emai' => $request->email,
        ];

        $pass = ($request->password != '' ? [
            'password' => Hash::make($request->password), 
        ] : [

        ]);

        $data = array_merge($update,$pass);

        $user->update($data);

        $user->roles()->sync($request->roles);

        return redirect()
                ->route('user.index')
                ->with([
                    'message' => 'El registro se edito satisfactoriamente!',
                ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user)
    {
        User::find($user)->delete();
    }

    public function profile(){
        $user = User::find(Auth::user()->id);

        return view('dashboard.profiles.index', compact('user'));
    }

    public function updateProfile(Request $request, User $user){

        $request->validate([
            'oldPassword' => 'required|min:6',
            'newPassword' => 'required|min:6',
            'checkNewPassword' => 'required|min:6',
        ]);

        $hashedPassword = Auth::user()->password;
        if(Hash::check($request->oldPassword, $hashedPassword)){
            if(!Hash::check($request->newPassword, $hashedPassword)){
                if($request->newPassword === $request->checkNewPassword){
                    
                    session()->flash('success','¡La contraseña se actualizo correctamente!');
                    User::where('id', '=', Auth::user()->id)->update(['password' => Hash::make($request->newPassword)]);
                    return redirect()->back();
                } else {
                    session()->flash('info','¡La nueva contraseña no coincide con el verificador de contraseña!');
                    return redirect()->back();
                }
            } else {
                session()->flash('info','¡La nueva contraseña no puede ser igual a la antigua!');
                return redirect()->back();
            }
        } else {
            session()->flash('info','¡La contraseña antigua no coincide!');
            return redirect()->back();
        }
            
    }
}
