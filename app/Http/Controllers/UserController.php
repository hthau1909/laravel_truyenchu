<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_user = User::all();
        return view('admin.user.index',compact('list_user'));
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

        //end
        $user = $request-> username;
        $email = $request-> email;

        $validator = Validator::make(
            array(
                'email' => $email
            ),
            array(
                'email' => 'required|email|unique:users'
            )
        );
        if ($validator->fails())
        {
            return redirect()->back()->with('status','Email Tồn Tại');
        }
        else {
            // Register the new user or whatever.
            $user = new User;
            $user->email = $request-> email;
            $user->name = $request-> username;

            $user->password = Hash::make($request-> password);
            $user->save();

            $theEmail = $request-> email;
             // passing data to thanks view
            return redirect()->back()->with('status','Thêm thành công');

        }
        // end
        // $data = $request->all(); // This will get all the request data.
        // $email = $request->validate([
        //     'email' => 'required|unique:users|max:255'
        // ]);
        // $user = new User();
        // $user->name = $data["username"];
        // $user->password = Hash::make($data["password"]);
        // $user->email = $email["email"];
        // $user->save();

        // return redirect()->back()->with('status','Thêm Thành Công');
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
        user::where('id',$id)->delete();

        return redirect() -> back()->with('status','Đã xóa thành công !!!!');
    }
}
