<?php

namespace App\Http\Controllers\Dash;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;



class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if($user->hasRole(['superadmin']))
        {
            $data = User::whereHasRole(['admin', 'user'])->paginate();
        }else{
            $data = User::whereHasRole(['user'])->paginate();

        }
        // $data = User::paginate();

        return view('dashboard.users.all' , compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();

        return view('dashboard.users.add' , compact('roles') );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:2|max:35',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:16',
            'role' => 'required|' . Rule::in(['user' , 'admin' , 'superadmin']),
        ]);

         $newUser =  User::create($request->all());
        $newUser->addRole($request->role);
        $newUser->update(['role' => $request->role]);

        Alert::toast('Done Add', 'success')->timerProgressBar();

        return redirect()->route('dash.users.index');
        // return to_route('dashboard.users.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();

        return view('dashboard.users.edit' , compact('user','roles') );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:2|max:35',
            'email' => 'required|email|'. Rule::unique('users')->ignore($user->id),
            'password' => 'required|min:6',
            'role' => 'required|' . Rule::in(['user' , 'admin' , 'superadmin']),
        ]);

        $requestDate = $request->except('password','_token');

        if(!Hash::check($request->password, $user->password)){

            $requestDate['password']= Hash::make($request->password);
        }
        $user->update($requestDate);
        $roleChoosen = Role::where('name',$request->input('role'))->first();
        $user->syncRoles([$roleChoosen->id]);
        // $user->removeRole($user->role);
        // $user->addRole($request->role);
        Alert::toast('User updated Successfully ....', 'success')->timerProgress();
        return redirect()->route('dash.users.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        $user->removeRoles([$user->role]);
        return redirect()->route('dash.users.index');


    }
}
