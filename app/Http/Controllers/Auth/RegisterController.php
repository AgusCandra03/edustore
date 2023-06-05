<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $roles = Role::with('roles');
        if(auth()->user()->can('get admin')){
            return view('auth.register',compact('roles'));
        } else {
            return abort('403');
        }
    }

    public function api()
    {
        $users = User::with('roles')->get();
        $datatables = datatables()->of($users)
        ->addColumn('date', function($users){
            return convert_date($users->created_at);
        })
        ->addIndexColumn();
        return $datatables->make(true);
    }

    public function test_spatie()
    {
                // get role and permission
        // $role = Role::create(['name' => 'admin']);
        // $permission = Permission::create(['name' => 'get admin']);
        // $role->givePermissionTo($permission);
        // $permission->assignRole($role);

        // $role = Role::create(['name' => 'admin']);
        // $permission = Permission::create(['name' => 'get admin']);
        // $role->givePermissionTo($permission);
        // $permission->assignRole($role);

                // view user with roles
        $user = User::with('roles')->get();
        return $user;
        
                // get roles to user
        // merujuk ke user lain
        // $user = User::where('id', 2)->first();

        // merujuk ke user yang lagi login
        // $user = auth()->user();
        // $user->assignRole('admin');
        // return $user;

                // remove roles and permission
        // $user = auth()->user();
        // $user->removeRole('kasir');
        // return $user;

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // return User::create([
        //     'name' => $data['name'],
        //     'email' => $data['email'],
        //     'password' => Hash::make($data['password']),
        // ]);
    }

    
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'  => 'required',
            'email'  => 'required',
            'password'  => 'required',
        ]);

        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        return redirect('registers');
    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $user)
    {
        //
    }

    public function editProfile()
    {
        return view('auth.edit-profile'); 
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $this->validate($request,[
            'name'=> 'required',
            'email'  => 'required',
        ]);
        

        $user->update($request->all());
        return redirect('edit-profile');
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $this->validate($request,[
            'name'=> 'required',
            'email'  => 'required',
        ]);
        

        $user->update($request->all());
        return redirect('registers');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
    }

}
