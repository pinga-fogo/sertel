<?php

namespace App\Http\Composers;
use App\Models\User;
use Auth;

use Illuminate\Contracts\View\View;

class NavigationComposer {

    public function __construct(Auth $auth, User $user){
        $this->auth = new $auth();
        $this->user = new $user();
    }

    public function topmenu(View $view){


        $id = Auth::user()->getId();
        // $id = $this->auth->user()->getId();
        $user = $this->user->find($id);


        $view->with('user', $user);
    }
}
