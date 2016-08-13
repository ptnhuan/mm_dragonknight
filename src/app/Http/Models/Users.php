<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use \LaravelAcl\Authentication\Models\User;
use App;

class Users extends User {

    public function getUserByUID($uid) {
        $user = self::where('uid', $uid)->first();
        return $user;
    }
    public function exportListUser($params = array()) {
        $users = self::join('user_profile', 'users.id', '=', 'user_profile.user_id')
                ->select('users.uid', 'users.email', 'user_profile.first_name', 'user_profile.last_name')
                ->orderBy('users.uid', 'ASC')->get();
        return $users;
    }

    public function getUserProfileByUID($uid) {
        $user = self::join('user_profile', 'users.id', '=', 'user_profile.user_id')
                ->select('users.id', 'users.uid', 'users.email', 'user_profile.first_name', 'user_profile.last_name')
                ->where('uid', $uid)->first();
        return $user;
    }
    public function search_users($params) {
        $this->config_reader = App::make('config');
        $results_per_page = $this->config_reader->get('dragonknight.ajax_user_search_per_page');

        $eloquent = self::join('user_profile', 'users.id', '=', 'user_profile.user_id');

        //Search by task title
        if (!empty($params['keyword'])) {
            $eloquent->where('user_profile.first_name', 'LIKE', '%' . $params['keyword'] . '%');
            $eloquent->orwhere('user_profile.first_name', 'LIKE', '%' . $params['keyword'] . '%');
            $eloquent->orwhere('users.email', 'LIKE', '%' . $params['keyword'] . '%');
            $eloquent->orwhere('users.id', 'LIKE', '%' . $params['keyword'] . '%');
        }
        $eloquent->select('users.email, user_profile.first_name, user_profile.last_name');

        $users = $eloquent->paginate($results_per_page);

        return $users;

    }
}