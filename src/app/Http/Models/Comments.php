<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App;
use DB;

class Comments extends Model {

    protected $table = 'comments';
    protected $primaryKey = 'comment_id';
    public $timestamps = false;
    protected $fillable = [
        "comment_id_parent",
        "item_id",
        "context_id",
        "user_id",
        "status_id",
        "comment_description",
        "comment_likes",
        "comment_reports",
        "comment_created_at",
        "comment_updated_at",
        "created_at",
        "updated_at",
    ];
    protected $guarded = ["comment_id"];

    /*     * ********************************************
     * listRealEstate
     *
     * @author: Kang
     * @date: 26/6/2016
     *
     * @category: REVIEWED
     */

    public function getList($params = array()) {
        $this->config_reader = App::make('config');
        $results_per_page = $this->config_reader->get('dragonknight.comments_admin_per_page');

        $eloquent = self::orderBy('comment_id');

        //Search by category title
        if (!empty($params['keyword'])) {
            $eloquent->where('comments.comment_description', 'LIKE', '%' . $params['comment_description'] . '%');
        }

        $comments = $eloquent->paginate($results_per_page);

        return $comments;
    }

    public function getContextComments($comment) {
        $context_comments = self::where('context_id', $comment->context_id)
                                ->where('item_id', $comment->item_id)
                ->orderBy('comment_id', 'ASC')
                ->get();
        return $context_comments;
    }

    /*     * ********************************************
     * findRealEstateId
     *
     * @author: Kang
     * @web: http://tailieuweb.com
     * @date: 26/6/2016
     *
     * @category: REVIEWED
     */

    public function findCategoryId($id) {
        $category = self::where('category_id', $id)
                ->first();
        return $category;
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

    public function updateCategory($input) {
        $category_images = $this->encodeImages($input);
        $category = self::find($input['id']);
        if (!empty($category)) {

            $category->category_title = $input['category_title'];
            $category->category_id_parent = $input['category_id_parent'];
            $category->category_overview = $input['category_overview'];

            $category->category_description = $input['category_description'];
            $category->category_image = $input['filename'];
            $category->category_images = $category_images;


            $category->save();
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

    public function addCategory($input) {
        $category_images = $this->encodeImages($input);

        $category = self::create([

                    'category_title' => $input['category_title'],
                    'category_id_parent' => $input['category_id_parent'],
                    'category_overview' => $input['category_overview'],
                    'category_description' => $input['category_description'],
                    'category_image' => $input['filename'],
                    'category_images' => $category_images,
        ]);
        return $category;
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

    public function deleteCategoryById($category_id) {

        $category = self::find($category_id);

        return $category->delete();
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

}
