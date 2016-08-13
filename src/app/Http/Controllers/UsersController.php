<?php namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use View,
    Redirect;
use Illuminate\Http\Request;
use LaravelAcl\Authentication\Controllers\UserController as RootUserController;
use App\Http\Models\Users;

class UsersController extends RootUserController {

    public function ajax_search_user(Request $request) {
//        if ($request->ajax()) {
            $obj_users = new Users;
            $params = array();
            $params = array_merge($request->all(), $params);
            $users = $obj_users->search_users($params);

            $arr_users = array();
            foreach ($users as $user) {
                $arr_users[] = $user->toArray();
            }
            return json_encode($arr_users);
//        }
    }

}
