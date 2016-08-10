<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App;
use DB;

class Posts extends Model {

    protected $table = 'posts';
    protected $primaryKey = 'post_id';
    public $timestamps = false;
    protected $fillable = [
      "post_id",
      "category_id",
      "user_id",
      "level_id",
      "post_title",
      "post_overview",
      "post_description",
      "post_image",
      "post_images",
      "post_views",
      "post_like",
      "status_id",
      "post_created_at",
      "post_updated_at",
      "updated_at",
      "created_at",
      "post_cache_page",
    ];

    protected $guarded = ["post_id"];

    /*********************************************
     * getList
     *
     * @author: Kang
     * @date: 26/6/2016
     *
     * @status: REVIEWED
     */

    public function getList($params = array()) {
        $this->config_reader = App::make('config');
        $results_per_page = $this->config_reader->get('dragonknight.posts_admin_per_page');

        $eloquent = self::orderBy('posts.post_id', 'DESC');

        //Search by post title
        if (!empty($params['post_title'])) {
            $eloquent->where('posts.post_title', 'LIKE', '%'.$params['post_title'].'%');
        }

        //Search by post status
        if (!empty($params['status_id'])) {
            $eloquent->where('posts.status_id', 'LIKE', '%'.$params['status_id'].'%');
        }




        $posts = $eloquent->paginate($results_per_page);

        return $posts;
    }

    /*     * ********************************************
     * findRealEstateId
     *
     * @author: Kang
     * @web: http://tailieuweb.com
     * @date: 26/6/2016
     *
     * @status: REVIEWED
     */

    public function findPostId($id) {
        $post = self::where('post_id', $id)
                ->first();
        return $post;
    }

    /*     * ********************************************
     * updateRealEstate
     *
     * @author: Kang
     * @web: http://tailieuweb.com
     * @date: 26/6/2016
     *
     * @status: REVIEWED
     */

    public function updatePost($input) {
        $post = self::find($input['id']);
        if (!empty($post)) {

            $post->post_title = $input['post_title'];
            $post->status_id = $input['status_id'];

            $post->save();
        } else {

        }
    }

    /*     * ********************************************
     * addRealEstate
     *
     * @author: Kang
     * @web: http://tailieuweb.com
     * @date: 26/6/2016
     *
     * @status: REVIEWED
     */

    public function addPost($input) {

        $post = self::create([

                    'post_title' => $input['post_title'],
                    'status_id' => $input['status_id'],
        ]);
        return $post;
    }

    /*     * ********************************************
     * deleteRealEstate
     *
     * @author: Kang
     * @web: http://tailieuweb.com
     * @date: 26/6/2016
     *
     * @status: REVIEWED
     */

    public function deletePostById($post_id) {

        $post = self::find($post_id);

        return $post->delete();
    }

    /*     * ********************************************
     * viewRe
     *
     * @author: Kang
     * @web: http://tailieuweb.com
     * @date: 26/6/2016
     *
     * @status: REVIEWED
     */

    public function viewRe($params = array()) {

        $real_estate = self::where('real_estate_id', $params['real_estate_id'])
                ->first();

        return $real_estate;
    }

    public function encodeImages($input) {
        $json_images = array();

        if (!empty($input['images_name'])) {
            foreach ($input['images_name'] as $index => $image_name) {
                $json_images[] = array(
                    'name' => $image_name,
                    'info' => @$input['images_info'][$index]
                );
            }
        }

        if ($input['filename'] && !$input['set_to']) {
            $json_images[] = array_merge($json_images, array(
                'name' => $input['filename'],
                'info' => ''
            ));
        }
        return json_encode($json_images);
    }

    public function decodeImages($json_images) {

    }

    /*     * *************************************************************************
      /***************************************************************************
      /*****************************USER FRONT PAGE*******************************
      /***************************************************************************
      /***************************************************************************
     * getHighlightRe
     *
     * @author: Kang
     * @web: http://tailieuweb.com
     * @date: 04/08/2016
     *
     * @status: TODO: RE-CODE
     */

    public function getHighlightRe() {
        $real_estate = self::first();
        return $real_estate;
    }

}