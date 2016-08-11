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
        "status_id",
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
        $results_per_page = $this->config_reader->get('dragonknight.tasks_admin_per_page');

        $eloquent = self::orderBy('tasks.task_id', 'DESC');

        //Search by task title
        if (!empty($params['task_title'])) {
            $eloquent->where('tasks.task_title', 'LIKE', '%' . $params['task_title'] . '%');
        }

        //Search by task status
        if (!empty($params['status_id'])) {
            $eloquent->where('tasks.status_id', 'LIKE', '%' . $params['status_id'] . '%');
        }




        $tasks = $eloquent->paginate($results_per_page);

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

    /*********************************************
     * updateTask
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
            $task->task_image = $input['filename'];

            $task->save();
        } else {

        }
    }

    /*     * ********************************************
     * addTask
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
     * deleteTaskById
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

}
