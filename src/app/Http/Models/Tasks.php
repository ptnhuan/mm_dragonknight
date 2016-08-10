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

    public function findTaskId($id) {
        $task = self::where('task_id', $id)
                ->first();
        return $task;
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

    public function updateTask($input) {
        $task = self::find($input['id']);
        if (!empty($task)) {

            $task->task_title = $input['task_title'];
            $task->status_id = $input['status_id'];

            $task->save();
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

    public function addTask($input) {

        $task = self::create([

                    'task_title' => $input['task_title'],
                    'status_id' => $input['status_id'],
        ]);
        return $task;
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

    public function deleteTaskById($task_id) {

        $task = self::find($task_id);

        return $task->delete();
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
