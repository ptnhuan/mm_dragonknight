<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App;
use DB;

class Categories extends Model {

    protected $table = 'Categories';
    protected $primaryKey = 'category_id';
    public $timestamps = false;
    protected $fillable = [
        "category_id",
        "category_title",
        "category_description",
        "category_image"
    ];
    protected $guarded = ["category_id"];

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
        $results_per_page = $this->config_reader->get('dragonknight.category_admin_per_page');

        $eloquent = self::orderBy('categories.category_id', 'DESC');

        //Search by category title
        if (!empty($params['category_title'])) {
            $eloquent->where('categories.category_title', 'LIKE', '%' . $params['category_title'] . '%');
        }

        $categories = $eloquent->paginate($results_per_page);

        return $categories;
    }

    public function pushSelectBox() {
        $categories = self::orderBy('category_title', 'ASC')
                ->pluck('category_title', 'category_id');
        return $categories;
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
        $category = self::find($input['id']);
        if (!empty($category)) {

            $category->category_title = $input['category_title'];

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

        $category = self::create([

                    'category_title' => $input['category_title'],
//                    'status_id' => $input['status_id'],
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
