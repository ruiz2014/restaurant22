<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin\Employee;
use App\Models\Admin\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
// use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $select = ['users.id', 'users.name', 'users.email', 'r.name', 'e.dni', 'e.phone'];
        $users = User::select('users.id', 'users.name', 'users.email', 'r.name as rol', 'e.dni', 'e.phone')
            ->join('roles as r', 'r.id', '=', 'users.rol')
            ->join('employees as e', 'e.user_id', '=', 'users.id')
            ->Where(function($query) use ($select, $search) {
                foreach($select as $col){
                    $query->orWhere($col,'LIKE',"%$search%");
                }
            })->paginate(); 
       
        // dd(auth()->user(), auth()->user()->name, auth()->id());
        return view('admin.user.index', compact('users', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = new User();

        return view('admin.user.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {

            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'unique:users,email', 'max:250'],
                'password' => ['required', "min:8"],
                'rol' => ['required', "integer"]
            ]);
     
            return redirect()->route('users.index')
                ->with('success', 'User created successfully.');    
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::find($id);

        return view('admin.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::find($id);
        $data = Employee::where('user_id', $id)->first();
        $roles = Role::all()->skip(1);
        // dd($roles);
        return view('admin.user.edit', compact('user', 'data', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $fields = [
            'name' => "required",
            'dni' => "string|nullable",
            'rol' => "required|numeric",
            'address' => "string|nullable",
            'email' => "required|email",
            'phone' => "string|nullable",
        ];
        // $mensajes =[
        // ]; 

        // $validator = Validator::make($request->all(), $campos);
        Validator::make($request->all(), $fields)->validate();
             
        // dd($user->id);
        $user->name = $request->name;
        $user->rol = $request->rol;
        $user->email = $request->email;
        $user->save();

        $employee = Employee::updateOrCreate(
            ['user_id' => $user->id], 
            [
            'dni' => $request->dni,
            'address' => $request->address,
            'phone' => $request->phone,
            ]
        );
        // $user = User::where('id', request('$user->id'))->firstOr(function () {
        //     $account = Account::create([ //... ]);
         
        //     return User::create([
        //         'account_id' => $account->id,
        //         'email' => request('email'),
        //     ]);
        // });
        // dd($employee);

        return Redirect::route('users.index')
            ->with('success', 'Usuario actualizado correctamente ......');
    }
}
