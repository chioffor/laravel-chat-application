<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Direct;

class DirectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $direct = Direct::find($id);
        $user_id = request()->user()->id; 
        $friend = $direct->friend($user_id);
        return view('direct', [
            "friend" => $friend, 
            "id" => $friend->id, 
            "direct" => $direct,
            "userID" => $user_id,
        ]);        
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
    public function store(Request $request, $id)
    {
        $friend = User::find($id);
        $user = $request->user();
        if ($user->directs->count() > 0) {
            foreach ($user->directs as $direct) {
                if ($direct->users->contains('id', '=', $friend->id)) {
                    return redirect(url('/home/private/'.$direct->id));
                } else {
                    $newDirect = new Direct;
                    $user->directs()->save($newDirect);
                    $friend->directs()->save($newDirect);
                    return redirect(url('/home/private/'.$newDirect->id));
                }
            }    
        } else {
            $newDirect = new Direct;
            $user->directs()->save($newDirect);
            $friend->directs()->save($newDirect);
            return redirect(url('/home/private/'.$newDirect->id));
        }
        
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
