<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Photo;
use App\Role;
use App\User;
use Illuminate\Support\Facades\Session;
use Symfony\Component\Console\Input\Input;

class UsersController extends Controller
{
    public function index()
    {
        abort_unless(\Gate::allows('user_access'), 403);

        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        abort_unless(\Gate::allows('user_create'), 403);

//
        $roles = Role::all()->pluck('title', 'id');

        return view('admin.users.create', compact('roles'));
    }


    public function store(StoreUserRequest $request, User $input)
    {
        abort_unless(\Gate::allows('user_create'), 403);

//
        $input = $request->all();

        if($request->file('photo_id')){
                //Get filename with the extension
                $filenameWithExt = $request->file('photo_id')->getClientOriginalName();
                //Get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                //Get extension
                $extension = $request->file('photo_id')->getClientOriginalExtension();
                //File name to store
                $fileNameToStore= $filename.'_'.time().'.'.$extension;
                // Upload Image
                $file = $request->file('photo_id')->storeAs('public/images', $fileNameToStore);

                $photo = Photo::create(['file'=>$fileNameToStore]);

                $input['photo_id'] = $photo->id;

            }

            User::create($input)->roles()->sync($request->input('roles', []));;

        return redirect()->route('admin.users.index');
    }

    public function edit(User $user)
    {
        abort_unless(\Gate::allows('user_edit'), 403);

        $roles = Role::all()->pluck('title', 'id');

        $user->load('roles');

        return view('admin.users.edit', compact('roles', 'user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        abort_unless(\Gate::allows('user_edit'), 403);

//
        $input = $request->all();

        if($request->file('photo_id')){
            //Get filename with the extension
            $filenameWithExt = $request->file('photo_id')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get extension
            $extension = $request->file('photo_id')->getClientOriginalExtension();
            //File name to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $file = $request->file('photo_id')->storeAs('public/images', $fileNameToStore);

            $photo = Photo::create(['file'=>$fileNameToStore]);

            $input['photo_id'] = $photo->id;

        }

//        User::create($input)->roles()->sync($request->input('roles', []));
        $user->update($input);
        $user->roles()->sync($request->input('roles', []));
        return redirect()->route('admin.users.index');
    }


    public function show(User $user)
    {
        abort_unless(\Gate::allows('user_show'), 403);

        $user->load('roles');

        return view('admin.users.show', compact('user'));
    }

    public function destroy(User $user)
    {
        abort_unless(\Gate::allows('user_delete'), 403);


        $user->delete();

        unlink(public_path() . $user->photo->file);

        Session::flash('deleted_user', $user->name . " has been removed" );

        return back();
    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();


        return response(null, 204);
    }
}
