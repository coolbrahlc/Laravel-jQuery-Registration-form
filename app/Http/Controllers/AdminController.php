<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\People;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function admin()
    {

        return view('admin.admin_view', ['users' => with(new People)->getPeople()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function update(Request $request, $id)
    {
        $user = People::find($id);
        $user->hidden = $request->hidden;
        $user->save();

        return redirect('/admin')->with('success', 'User has been updated');
    }


    public function destroy($id)
    {
        $user = People::find($id);
        $user->delete();

        return redirect('/admin')->with('success', 'User has been deleted Successfully');
    }

}