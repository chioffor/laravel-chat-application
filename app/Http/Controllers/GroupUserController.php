<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Events\UserLeftGroup;
use App\Events\UserJoinedGroup;
use App\Events\ClickedFavorite;

class GroupUserController extends Controller
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
        // if (!Auth::check())
        //     return redirect('/');

        // $user = request()->user();    
        // $group = Group::find($groupID);
        // if (!$group->users()->find($user->id)) {
        //     $user->groups()->save($group);
        //     $url = url("/home/{$groupID}");
        //     $username = $user->name;
        //     $data = [
        //         'url' => $url,
        //         'username' => $username,
        //         'id' => $user->id,
        //     ];

        //     event(new UserJoinedGroup($data));

        //     return redirect(route('group-page', ['id' => $group->id]));
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $groupID)
    {
        $user = $request->user();        
        $group = Group::find($groupID);
        $username = $user->name;
        $url = route('group-page', ["id" => $group->id]);
        $data = [
            'url' => $url,
            'username' => $username,
            'id' => $user->id
        ];

        switch (url()->current()) {
            case route('leave-group', ["groupID" => $group->id]):
                $group->users()->detach($user);              
                event(new UserLeftGroup($data));
                return redirect('/home');
            
            case route('join-group', ["groupID" => $group->id]):
                if (!$group->users()->find($user->id)) {
                    $user->groups()->save($group);                    
                    event(new UserJoinedGroup($data));        
                    return redirect(route('group-page', ['id' => $group->id]));
                }

        }       
        
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
        //$id = request()->input('id');
        $group = Group::find($id);
        $user = $request->user();

        $info = false;

        $g = $user->groups->firstWhere('id', '=', $id);
        if ($g->pivot->favorite == true) {
            $g->pivot->favorite = false;
            $g->pivot->save();
            $info = false;
        } else {
            $g->pivot->favorite = true;
            $g->pivot->save();
            $info = true;
        }

        $data = [
            'id' => $id,
            'info' => $info,
        ];
        event(new ClickedFavorite($data));
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
