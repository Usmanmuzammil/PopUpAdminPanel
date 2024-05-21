<?php

namespace App\Http\Controllers\OrderBookerController;

use App\Http\Controllers\Controller;
use App\Models\OrderBooker;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(){
        return view('order-booker-pannel.user.profile');
    }

    public function update(Request $req , $id){
        // return $req->file('image');
        // return $req->all();
        try {
            $req->validate([
                'name' => 'required',
                'password' => 'confirmed|min:8|nullable',
            ]);

            $profile = OrderBooker::find($id);

            if ($req->filled('password')) {
                $password = Hash::make($req->password);
                $profile->update(['password' => $password]);
            }


            if ($req->hasFile('image')) {
                if($profile->image){

                    $path = public_path('app_assets/images/user/'.$profile->image);
              if(file_exists($path)){
                  unlink($path);
              }
            }



                $uploadedImage = $req->file('image');
                $rand = rand(0, 999999);
                $imageName = $rand . Auth::user()->id . $uploadedImage->getClientOriginalName();
                $destinationPath = public_path('app_assets/images/user/'); // Use public_path to get the absolute path

                // Move the uploaded file to the destination path
                $uploadedImage->move($destinationPath, $imageName);

                // Update the image path in the database
                $profile->image = $imageName;
                $profile->save();
            }

            $profile->update(['name' => $req->name]);

            return redirect()->back()->with('success', 'Profile updated successfully..!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage());
        }



    }

}
