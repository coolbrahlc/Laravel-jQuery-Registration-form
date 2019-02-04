<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\People;
use App\Http\Requests\PeopleStoreRequest;
use App\Http\Requests\PeopleUpdateRequest;
use App\Services\FileSaveService;

use Auth;
use Cookie;



class PeopleController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('people.index', ['users' => with(new People)->getPeople() ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        if ($request->cookie('last_id')) {

            $id =  $request->cookie('last_id');
            return redirect('/people/' . $id . '/edit')->withCookie(Cookie::forget('last_id'));
        }

        else {
            return view('people.create');
        }

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PeopleStoreRequest $request)
    {

        $user = new People($request->all());

        $user->save();
        $last_id = $user->id;

        return redirect('/people/'.$last_id.'/edit')->cookie('last_id', $last_id);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $user = People::find($id);

        return view('people.edit', compact('user'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PeopleUpdateRequest $request, $id)
    {

        $user = People::find($id);
        $image_path = with(new FileSaveService)->handleUpload($request->file('photo'));

        $user->photo = $image_path;
        $user->about = $request->about;
        $user->company = $request->company;
        $user->position = $request->position;
        $user->save();

        return redirect('/people')->with('success', 'Participant has been updated')->withCookie(Cookie::forget('last_id'));
    }


    public function update_hidden(Request $request, $id)
    {
        $user = People::find($id);
        $user->hidden = $request->hidden;
        $user->save();

        return redirect('/people')->with('success', 'Participant has been updated');
    }

    public function vue()
    {
        return view('people.vue_test');
    }

}