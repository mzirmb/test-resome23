<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\http\Requests\UpdateAvatarRequest;
use Illuminate\Support\Facades\Storage;

class AvatarController extends Controller
{
    public function update(UpdateAvatarRequest $request)
    {
        //return 'hell';
       // return response()->redirectTo(route('profile.edit')) ;
      // good // return back()->with( 'message' , 'Avatar changed successfully!!!!' );
 
 

      // save avatar in storage/app/avatars...
       $path = $request->file('avatar')->store('avatars','public');

       if($oldAvatar = $request->user()->avatar)
       {
        Storage::disk('public')-> delete( $oldAvatar );
        
       }
       auth()->user()->update(['avatar' => $path]);
       

       return redirect( route('profile.edit'))->with('message','Avatar is updated') ;

    }
}
