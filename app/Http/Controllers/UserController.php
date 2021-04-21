<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Group;
use App\Models\Image;
use App\Models\UserGroup;
use Illuminate\Http\Request;
use App\Jobs\RemoveUserGroup;
use App\Events\addImagenEvent;
use App\Jobs\sendEmailVerifiedToUser;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {

        // $array = [1,2,3,4,5,6];
        // $collect = collect($array);
        // $result = $collect->filter(function($item){
        //     return $item % 2 == 0;
        // })->map(function($item){
        //     return $item * 2;
        // })->values()->all();
        // // return ($result);
        // dd($result);
        
        
        
        $users = User::with('groups')->get();
        // $users = auth()->user()->groups;
        // return $users;
        // $saludo = ' Hola como estas ? ';
        // $test = $users->filter(function($item){
        //     return $item->id >= 2;
        // })->map(function($item){
        //     return $item->name;
        // })->values()->each(function($item) use(&$saludo){
        //     echo $saludo . $item;
        // });
        // return $test;
        // $otherArray = ['Jorge Almarales'];
        // $otherCollect = collect($otherArray);
        // $test2  = $test->concat($otherCollect);
        // return ($test2);
        
        
        $groups = Group::get();
        return view('dashboard.home', compact('users','groups'));
    }
    public function store(Request $request)
    {
        $user = $request->user();
        $user->groups()->sync($request->groups);
        return back()->with('status', 'succesfully');
    }
    public function storeImg(Request $request)
    {
        // return $request->user();
        $request->validate([
            'name' => 'required|min:3',
            'img' => 'required|image',
        ]);
        if($request->hasFile('img'))
        {
            $image = new Image();
            $path = $request->img->store('public');
            $image->name = $path;
            $image->url = $request->name;
            $image->save();
        }
        event(new addImagenEvent($request->user()));
        return back()->with('status', 'succesfully');
    }
    public function remove($group)
    {
        $remove = UserGroup::where('group_id', $group)->first();
        dispatch(new RemoveUserGroup($remove->user_id));
        $remove->delete();
        return back()->with('status', 'succesfully');
        // return $group;
    }
    
    public function addPosts(Request $request)
    {
        $request->user()->posts()->create($request->all());
        // Post::create($request->all());
        return back()->with('status', 'succesfully');
    }

    public function responseJson(Request $request)
    {
        $request->user()->posts()->create($request->all());
        return response()->json([
            'success' => true
        ], 200);
    }
}
