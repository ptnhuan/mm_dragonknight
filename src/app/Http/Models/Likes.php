<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App;
use DB;

class Likes extends Model {

    protected $table = 'likes';
    protected $primaryKey = 'like_id';
    public $timestamps = false;
    protected $fillable = [
        "user_id",
        "item_id",
        "type",
        "url",
        "like_created_at",
        "created_at",
        "updated_at",
    ];
    protected $guarded = ["like_id"];

    /*     * *******************************************
     * getList
     */

    public function isLiked($params) {
        $eloquent = self::where('user_id', '=', @$params['user_id']);

        if ($params['url']) {

            $eloquent->where('url', '=', $params['url']);
        } elseif ($params['item_id'] && $params['type']) {

            $eloquent->where('item_id', '=', $params['item_id']);
            $eloquent->where('type', '=', $params['type']);
        }
        $likes = $eloquent->get();
        return $likes;
    }

    public function likeItem($input) {
        $like = self::create([
            'context_id' => $input['context_id'],
            'item_id' => $input['item_id'],
            'url' => $input['url'],
            'user_id' => $input['user_id'],
            'like_created_at' => time(),
        ]);
        return $like;
    }

}
