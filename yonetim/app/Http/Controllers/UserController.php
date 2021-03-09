<?php

namespace App\Http\Controllers;

use App\User;
use App\YetkiModel;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user=User::where('durum','=', 1)->get();

        return view('user.index',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $yetki=YetkiModel::all();

        return view('user.create',compact('yetki'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=bcrypt($request->password);
        $user->yetki=implode(",", (array)$request->yetki);

        $user->renk=$request->renk;
        $saved=$user->save();

        if(!$saved){
            return redirect(route('user.index'))->with('error','Kullanıcı Eklenemedi');
        }
        else
        {

            return redirect(route('user.index'))->with('success','Kullanıcı Eklendi');
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

        $user=User::find($id);

        $yetki=YetkiModel::all();

        return view('user.edit',compact('yetki','user'));


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
        $user=User::find($id);
        $user->name=$request->name;
        $user->email=$request->email;
        $user->renk=$request->renk;

        if ($request->password!='')
        {
            $user->password=bcrypt($request->password);
        }
        $user->yetki=implode(",", (array)$request->yetki);
        $saved=$user->save();

        if(!$saved){
            return redirect(route('user.index'))->with('error','Kullanıcı Düzenlenemedi');
        }
        else
        {

            return redirect(route('user.index'))->with('success','Kullanıcı Düzenlendi');
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted=User::find($id)->update(['durum' => 0]);

        if(!$deleted){
            return redirect(route('user.index'))->with('error','Kullanıcı Silinemedi');
        }
        else
        {
            return redirect(route('user.index'))->with('success','Kullanıcı Silindi');
        }


    }
}
