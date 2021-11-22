<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Group;
use App\Models\Member;
use App\Events\NewUserJoined;


class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $request->user();
        if ($request->input('group-name')) {
            $name = $request->input('group-name');
            $group = new Group;
            $group->name = $name;
            $user->groups()->save($group);
            return redirect(route('group-page', ["id" => $group->id]));
        } else {
            return redirect('/home');
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $user = Auth::user();
        $main = Group::find(1);
        $welcome = null;

        if (!$main->users->containsStrict('id', $user->id)) {
            $main->users()->save($user);
            $welcome = true;
            $data = [
                "url" => url('/chatapp/main'),
                "welcomeMessage" => $welcome,
                "new_user_name" => $user->name,
            ];
            
            event(new NewUserJoined($data));
        } else {
            $welcome = false;
        }


        return view('main', [
            "user" => $user, 
            "group" => Group::find(1), 
            "groups" => Group::all(),
            "otherGroups" => Group::all()->diff($user->groups),
            "welcome" => $welcome,      
        ]);    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
