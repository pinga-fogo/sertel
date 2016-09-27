<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Requests\AccountRequest;
// use App\Http\Controllers\Controller;
use Auth;
use Session;
use App\Models\User;
use App\Models\Profile;

class AccountsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $user, Profile $profile){

        $this->user = $user;
        $this->profile = $profile;
        $this->middleware('auth');

    }

    public function index(){

        $users = array();

        return view('admin.accounts.index');

    }

    public function create(){


        return view('admin.accounts.create');

    }

    public function store(AccountRequest $request){

        $user = $this->user->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $user->profile()->create([
            'lastname' => $request->lastname
        ]);

        Session::flash('message_type', 'success');
        Session::flash('message_text', 'Usuário salvo com sucesso!');

        return redirect()->route('admin.accounts.index');
    }

    public function edit($id){

        $user = \App\Models\User::find($id);

        return view('admin.accounts.edit', compact('user'));
    }

    public function update(AccountRequest $request){

        $user = $this->user->find($request->id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        $user->profile()->update([
            'lastname' => $request->lastname
        ]);

        Session::flash('message_type', 'success');
        Session::flash('message_text', 'Dados atualizados com sucesso!');

        return redirect()->route('admin.accounts.index');

    }

    public function destroy(){

        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        $status = $this->user->find($id)->delete();
        return response()->json(['status'=>$id]);

    }
}
