<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App;
use DB;

class Tasks extends Model {

    protected $table = 'tasks';
    protected $primaryKey = 'task_id';
    public $timestamps = false;
    protected $fillable = [
        "created_by_user_id",
        "level_id",
        "category_id",
        "task_points",
        "task_title",
        "task_overview",
        "task_description",
        "task_notes",
        "task_image",
        "task_images",
        "task_status",
        "task_created_at",
        "task_updated_at",
        "created_at",
        "updated_at",
    ];

    protected $guarded = ["task_id"];
    /*     * ********************************************
     * listRealEstate
     *
     * @author: Kang
     * @date: 26/6/2016
     *
     * @status: REVIEWED
     */

    public function getList($params = array()) {
        $this->config_reader = App::make('config');
        $results_per_page = $this->config_reader->get('dragonknight.tasks_admin_per_page');

        $tasks = self::orderBy('task_id', 'DESC')
                ->paginate($results_per_page);

        return $tasks;
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

    public function findRealEstateId($id) {
        $real_estate = self::where('real_estate_id', $id)
                ->first();
        return $real_estate;
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

    public function updateRealEstate($input) {
        $real_estate = self::find($input['id']);
        if (!empty($real_estate)) {

            $real_estate_images = $this->encodeImages($input);

            $real_estate->real_estate_title = $input['title'];
            $real_estate->real_estate_category_id = $input['datacat'];
            $real_estate->real_estate_description = $input['description'];
            $real_estate->real_estate_bedroom = $input['bedroom'];
            $real_estate->real_estate_bathroom = $input['bathroom'];
            $real_estate->real_estate_sq = $input['sq'];
            $real_estate->real_estate_year_build = $input['build_year'];

            $real_estate->real_estate_cost = (double)$input['cost'];

            $real_estate->real_estate_image = $input['filename'];
            $real_estate->real_estate_images = $real_estate_images;

            $real_estate->real_estate_map_address = $input['map-address'];
            $real_estate->real_estate_map_marker_lat = $input['map-marker-lat'];
            $real_estate->real_estate_map_marker_lng = $input['map-marker-lng'];
            $real_estate->real_estate_map_center_lat = $input['map-center-lat'];
            $real_estate->real_estate_map_center_lng = $input['map-center-lng'];
            $real_estate->real_estate_map_zoom = $input['map-zoom'];

            $real_estate->save();
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

    public function addRealEstate($input) {

        $real_estate_images = $this->encodeImages($input);

        $real_estate = self::create([

                    'real_estate_title' => $input['title'],
                    'real_estate_category_id' => $input['datacat'],
                    'real_estate_description' => $input['description'],
                    'real_estate_bedroom' => $input['bedroom'],
                    'real_estate_bathroom' => $input['bathroom'],
                    'real_estate_sq' => $input['sq'],
                    'real_estate_year_build' => $input['build_year'],
                    'real_estate_image' => $input['filename'],
                    'real_estate_images' => $real_estate_images,
                    'real_estate_cost' => @$input['cost'],
                    'real_estate_map_address' => $input['map-address'],
                    'real_estate_map_marker_lat' => $input['map-marker-lat'],
                    'real_estate_map_marker_lng' => $input['map-marker-lng'],
                    'real_estate_map_center_lat' => $input['map-center-lat'],
                    'real_estate_map_center_lng' => $input['map-center-lng'],
                    'real_estate_map_zoom' => $input['map-zoom'],
        ]);
        return $real_estate;
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

    public function deleteRealEstate($input) {

        $real_estate = self::find($input['id']);

        return $real_estate->delete();
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

    public function encodeImages($input){
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
    public function decodeImages($json_images){

    }


    /***************************************************************************
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
