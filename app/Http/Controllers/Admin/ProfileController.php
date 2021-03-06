<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Profile;

class ProfileController extends Controller
{
    //
    public function add()
    {
        return view('admin.profile.create');
    }

    public function create(Request $request)
    {
        //validationを行う
        $this->validate($request,Profile::$rules);

        $profile = new Profile;
        $form = $request->all();

        //フォームから送信されてきた_tokenを削除する
        unset($form['_token']);

        //DBに保存
        $profile->timestamps = false; 
        $profile->fill($form);
        $profile->save(); 
 
        return redirect('admin/profile/create');
    }

    public function edit(Request $request)
    {
        $profile = Profile::find($request->id);
        if (empty($profile)){
        abort(404);
        }
        return view('admin.profile.edit',['profile_form' => $profile]);
    }

    public function update()
    {
        return redirect('admin/profile/edit');
    }
}
