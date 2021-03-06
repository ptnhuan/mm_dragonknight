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

    /*     * *******************************************
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
            $eloquent->where('posts.post_title', 'LIKE', '%' . $params['post_title'] . '%');
        }

        //Search by post status
        if (!empty($params['status_id'])) {
            $eloquent->where('posts.status_id', 'LIKE', '%' . $params['status_id'] . '%');
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

    /*     * *******************************************
     * updatePost
     *
     * @author: Kang
     * @web: http://tailieuweb.com
     * @date: 26/6/2016
     *
     * @status: REVIEWED
     */

    public function updatePost($input) {
        $post_images = $this->encodeImages($input);
        $post = self::find($input['id']);
        if (!empty($post)) {

            $post->post_title = $input['post_title'];
            $post->status_id = $input['status_id'];
            $post->category_id = $input['category_id'];
            $post->level_id = $input['level_id'];
            $post->post_overview = $input['post_overview'];
            $post->post_description = $input['post_description'];
            $post->post_image = $input['filename'];
            $post->post_images = $post_images;
            $post->save();
        } else {
            
        }
    }

    /*     * ********************************************
     * addPost
     *
     * @author: Kang
     * @web: http://tailieuweb.com
     * @date: 26/6/2016
     *
     * @status: REVIEWED
     */

    public function addPost($input) {

        $post_images = $this->encodeImages($input);
        $post = self::create([

                    'post_title' => $input['post_title'],
                    'status_id' => $input['status_id'],
                    'user_id' => $input['id'],
                    'category_id' => $input['category_id'],
                    'level_id' => $input['level_id'],   
                    'post_overview' => $input['post_overview'],
                    'post_description' => $input['post_description'],
                    'post_image' => $input['filename'],
                    'post_images' => $post_images,
        ]);
        return $post;
    }

    /*     * ********************************************
     * deletePostById
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

}
