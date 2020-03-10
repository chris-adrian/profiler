<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use App\User;
use Auth;


class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
       
    }

    public function index($username)
    {   
        $user = User::where('username', $username)->first();
        if (is_null($user)) {
            return abort(404);
        } else {
            // dd($user->id);
            return view('profile/home', compact('user'));
        }
    }

    public function display($id, $type)
    {
        $user = User::findOrFail($id);

        switch ($type) {
            case 'details':
                return view('profile/details', compact('user'));
                # code...
                break;
            case 'image':
                return view('profile/image', compact('user'));
            default:
                return abort(404);
                break;
        }
        // $userInfo = DB::table('profiles')->where('user_id',$id);
        // return view('profile/profile-update')->with('profileDetails',$user);
    }

    public function update($id, $type) {
        $user = User::findOrFail($id);

        switch ($type) {
            case 'details':
                $data = request()->validate([
                    'username' => ['required', 'string', 'max:100',Rule::unique('users')->ignore($id)],
                    'email' => ['required','string','email','max:255',Rule::unique('users')->ignore($id)],
                    'current_password' => ['required','string', 'min:8'],
                    'new_password' => ['nullable','string', 'min:8'],
                    'confirm_password' => ['nullable','required_with:new_password', 'string', 'min:8', 'same:new_password'],
                    'first_name' => ['required', 'string', 'max:255'],
                    'last_name' => ['required', 'string', 'max:255'],
                    'position' => [ 'max:100'],
                ]);

                if(!\Hash::check($data['current_password'], $user->password)){
                    throw ValidationException::withMessages(['current_password' => 'Current password is incorrect']);
                } else {

                    // $user->update([
                    //     'username' => $data['username'],
                    //     'email' => $data['email']
                    // ]);
                    $user->username = $data['username'];
                    $user->email = $data['email'];

                    if (isset($data['new_password'])) {
                        $user->password = Hash::make($data['new_password']);
                        // $user->update([
                        //     'password' => Hash::make($data['new_password'])
                        // ]);
                    }
                    $user->save();

                    $user->profile()->updateOrCreate(['user_id' => $user->id], [
                        'first_name' => $data['first_name'],
                        'last_name' => $data['last_name'],
                        'position' => $data['position']
                    ]);

                    // The line below can only update existing data
                    // $user->profile->first_name = $data['first_name'];
                    // $user->profile->last_name = $data['last_name'];
                    // $user->profile->position = $data['position'];
                    // $user->push();

                    return redirect()->back()->with('success', 'Update Successful');
                }
                break;
            case 'image':

                $data = request()->validate([
                    'image' => [ 'required', 'image'],
                ]);
                if($user->profile()->where(['user_id' => $user->id])->first()){
                    $currentImage = $user->profile()->where(['user_id' => $user->id])->first()->image;
                    if( isset($currentImage) ) {
                        if ($currentImage !== '') {
                            if (!Storage::delete('public/'.$currentImage)) {
                                return redirect()->back()->with('fail', 'Failed to remove current profile image');
                            }
                        }
                    }
                }
                $imagePath = request('image')->store('uploads', 'public');

                $image = Image::make(storage_path("app/public/{$imagePath}"))->fit(400,400);
                $image = Image::make(public_path("storage/{$imagePath}"))->fit(400,400);
                $image->save();

                $user->profile()->updateOrCreate(['user_id' => $user->id], [
                    'image' => $imagePath,
                ]);

                return redirect()->back()->with('success', 'Image updated');
                break;
            default:
                return abort(404);
                break;
        }
        
        

    }
}
