<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;


use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class UserController extends Controller
{
    //
    public function index(){
        $users = User::with('roles')->get();
        // dd($users); // Uncomment for debugging
        return view("admin.users", compact('users'));
        
    }
    

    public function create(){
        return view("users.create");
    }
    
    public function edit(User $user) {
       
        return view('users.edit', ['user' => $user]);
    }
    public function update(User $user, Request $request) {
        $data = $request->validate([
            'name' => "required",
            'email' => "required",
            'roles' => "required",
        ]);

        $user->update($data);
        if($data['roles']=='artiste')  $user->roles()->sync(2) ;
        else $user->roles()->sync(1);

        return redirect(route("users"))->with('success', "user successfully updated");
    }

    public function destroy(User $user) {
        $user->delete();
        return redirect(route("users.index"))->with('success', "user successfully deleted"); 
    }

    public function searchusers(Request $request)
    {
        $query = $request->input('query');
        $users = User::where('title', 'like', "%{$query}%")->get();

        return response()->json($users);
    }

    public function store(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'roles' => "required",
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        var_dump($request);
        die;
        
        if($request['roles']=='artiste')  $user->roles()->sync(2) ;
        else $user->roles()->sync(1);

        // event(new Registered($user));

        // Auth::login($user);

        return redirect(route("users"))->with('success', "user successfully created");
    }
}
