<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = User::all();
        return view('user.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $roles = Role::all();
        return view('user.create', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        try {
            $user = User::create([
                'first_name' => $request['first_name'],
                'last_name' => $request['last_name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password'])
            ]);

            // Adicionando a role no usuário
            $user->assignRole($request['role_id']);
        } catch (\Exception $exception) {
            return back()->withInput()->withError('Usuário não cadastrado! Verifique com o suporte.');
        }

        return redirect()->route('user.index')->withSuccess('Usuário cadastrado!');
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
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('user.edit', ['user' => $user, 'roles' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @param User $user
     * @return mixed
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            $data = $request->all();
            if($data['password'] == null)
                unset($data['password']);
            else
                $data['password'] = Hash::make($data['password']);
            $user->update($data);

            $user->roles()->detach();
            $user->assignRole($data['role_id']);
        } catch (\Exception $exception) {
            return back()->withInput()->withError('Usuário não atualizado! Verifique com o suporte.');
        }

        return redirect()->route('user.index')->withSuccess('Usuário atualizado!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return mixed
     */
    public function destroy(User $user)
    {
        try {
            if($user->active == true)
                $user->active = false;
            else
                $user->active = true;

            $user->save();
        } catch (\Exception $exception) {
            return back()->withInput()->withError('Usuario não alterado! Verifique com o suporte.');
        }

        return back()->withSuccess('Usuário alterado!');
    }
}
