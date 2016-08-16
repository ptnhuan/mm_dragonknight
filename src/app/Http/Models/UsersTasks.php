<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App;
use DB;

class UsersTasks extends Model {

    protected $table = 'users_tasks';
    protected $primaryKey = 'user_task_id';
    public $timestamps = false;
    protected $fillable = [
        "user_id",
        "task_id",
        "status_id",
        "user_id_reviewer",
        "user_task_points",
        "user_task_attachment",
        "user_task_logs",
        "user_task_created_at",
        "user_task_updated_at",
        "created_at",
        "updated_at",
    ];
    protected $guarded = ["user_task_id"];

    /*     * *******************************************
     * getList
     *
     * @author: Kang
     * @date: 26/6/2016
     *
     * @status: REVIEWED
     */

    public function userGetTasks($params = array()) {
        $this->config_reader = App::make('config');
        $results_per_page = $this->config_reader->get('dragonknight.tasks_admin_per_page');

        $eloquent = self::join('tasks', 'tasks.task_id', '=', 'users_tasks.task_id')
                        ->select('task_title', 'users_tasks.status_id', 'users_tasks.user_task_id' )
                        ->where('users_tasks.user_id', '=', $params['current_user']['id']);

        //Search by task title
        if (!empty($params['task_title'])) {
            $eloquent->where('tasks.task_title', 'LIKE', '%' . $params['task_title'] . '%');
        }

        //Search by task status
        if (!empty($params['status_id'])) {
            $eloquent->where('tasks.status_id', 'LIKE', '%' . $params['status_id'] . '%');
        }

        $users_tasks = $eloquent->paginate($results_per_page);

        return $users_tasks;
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

    public function getUserByTaskId($task_id) {
        $users_tasks = self::where('users_tasks.task_id', '=', $task_id)
                ->join('user_profile', 'user_profile.user_id', '=', 'users_tasks.user_id')
                ->select('user_profile.first_name', 'user_profile.last_name', 'users_tasks.status_id', 'users_tasks.user_id')
                ->get();
        return $users_tasks;
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

    public function assignTask($user_ids, $status_ids, $task_id) {
        $this->deleteUsersTasks($task_id);
        if (!empty($user_ids)) {
            foreach ($user_ids as $index => $user_id) {
                $this->addUserTask(array('user_id' => $user_id, 'task_id' => $task_id, 'status_id' => $status_ids[$index]));
            }
        }
    }

    public function updateStatus($user_id, $task_id, $status_id) {
        $user_task = self::where('user_id', '=', $user_id)
                ->where('task_id', '=', $task_id)
                ->get();
        if (!empty($user_task)) {
            $user_task->status_id = $status_id;
            $user_task->save();
        }
        return $user_task;
    }

    public function findUserTask($user_id, $task_id) {
        $user_task = self::where('user_id', '=', $user_id)
                ->where('task_id', '=', $task_id)
                ->get();
        return $user_task;
    }

    public function deleteUsersTasks($task_id) {

        $users_tasks = self::where('task_id', '=', $task_id);

        if (!empty($users_tasks)) {
            return $users_tasks->delete();
        }
    }


    /*     * *******************************************
     * updateTask
     *
     * @author: Kang
     * @web: http://tailieuweb.com
     * @date: 26/6/2016
     *
     * @status: REVIEWED
     */

    public function updateUserTask($input) {
        $task = self::find($input['id']);
        if (!empty($task)) {

            $task->task_title = $input['task_title'];
            $task->status_id = $input['status_id'];
            $task->task_overview = $input['task_overview'];
            $task->task_description = $input['task_description'];
            $task->task_notes = $input['task_notes'];
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

    public function addUserTask($input) {

        $user_task = self::create([
                    'user_id' => $input['user_id'],
                    'task_id' => $input['task_id'],
                    'status_id' => $input['status_id'],
        ]);
        return $user_task;
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
