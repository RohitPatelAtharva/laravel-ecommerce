<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index(Request $request){
       $user=User::where('role', 1)->where('status', 1)->latest();
       if(!empty($request->get('keyword'))){
        $user=$user->where('name','like','%'.$request->get('keyword').'%');
        $user=$user->Orwhere('email','like','%'.$request->get('keyword').'%');
       }
       $user=$user->paginate();
       return view('admin.user.list',compact('user'));

    }
    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|integer',
            'password' => 'required|min:5'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
 
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->status = $request->status;
        $user->save();
        $message = "User added successfully";
        session()->flash('success', $message);
        return response()->json([
            'status' => true,
            'message' => $message
        ]);
    }

    public function edit($id)
    {
        $user = user::find($id);
        if ($user == null) {
            session()->flash('error', 'user not Found');
            return redirect()->route('users.index');
        }
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
{
    // Find the user by ID
    $user = User::find($id);
    if ($user == null) {
        session()->flash('error', 'User not found');
        return response()->json([
            'status' => false,
            'message' => 'User not found'
        ]);
    }

    // Validate the request data
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required|email|unique:users,email,' . $id,
        'phone' => 'required|integer',
        'password' => 'sometimes|nullable|min:5'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'errors' => $validator->errors()
        ]);
    }

    // Update the user with new data
    $user->name = $request->name;
    $user->email = $request->email;

    // Only update the password if it is provided
    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    $user->phone = $request->phone;
    $user->status = $request->status;
    $user->save();

    // Flash a success message and return a JSON response
    $message = "User updated successfully";
    session()->flash('success', $message);
    return response()->json([
        'status' => true,
        'message' => $message
    ]);
}
    public function destroy($id)
    {
        $page=User::find($id);
        if($page == null){
            session()->flash('error','Page not found');
            return response()->json([
                'status'=>true,
            ]);
        }
       $page->delete();
       $message = "Page deleted successfully";
       session()->flash('success',$message);
       return response()->json([
        'status'=>true,
        'message'=>$message,
    ]);

    }

    
}
