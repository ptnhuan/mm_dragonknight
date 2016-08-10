<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App;
use DB;

class Statuses extends Model {

    protected $table = 'statuses';
    protected $primaryKey = 'status_id';
    public $timestamps = false;
    protected $fillable = [
        "status_id",
        "status_title",
        "status_description",
        "status_image"
    ];
    protected $guarded = ["status_id"];

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
        $results_per_page = $this->config_reader->get('dragonknight.status_admin_per_page');

        $eloquent = self::orderBy('statuses.status_id', 'DESC');

        //Search by status title
        if (!empty($params['status_title'])) {
            $eloquent->where('statuses.status_title', 'LIKE', '%'.$params['status_title'].'%');
        }
        

         
        $status = $eloquent->paginate($results_per_page);

        return $status;
    }

    public function pushSelectBox() {
        $statuses = self::orderBy('status_title', 'ASC')
                ->pluck('status_title', 'status_id');
        return $statuses;
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

    public function findStatusId($id) {
        $status = self::where('status_id', $id)
                ->first();
        return $status;
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

    public function updateStatus($input) {
        $status = self::find($input['id']);
        if (!empty($status)) {

            $status->status_title = $input['status_title'];
            $status->status_id = $input['status_id'];

            $status->save();
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

    public function addStatus($input) {

        $status = self::create([
                    'status_title' => $input['status_title'],
        ]);
        return $status;
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

    public function deleteStatusById($status_id) {
        $status = self::find($status_id);

        return $status->delete();
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
