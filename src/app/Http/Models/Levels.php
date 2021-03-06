<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App;
use DB;

class Levels extends Model {

    protected $table = 'levels';
    protected $primaryKey = 'level_id';
    public $timestamps = false;
    protected $fillable = [
        "level_id",
        "level_points",
        "level_title",
        "level_overview",
        "level_description",
        "level_notes",
        "level_image",
        "level_images",
        "level_created_at",
        "level_updated_at",
        "created_at",
        "updated_at",
    ];
    protected $guarded = ["level_id"];

    /*     * *******************************************
     * getList
     */

    public function getList($params = array()) {
        $this->config_reader = App::make('config');
        $results_per_page = $this->config_reader->get('dragonknight.levels_admin_per_page');

        $eloquent = self::orderBy('levels.level_id', 'DESC');

        //Search by level title
        if (!empty($params['level_title'])) {
            $eloquent->where('levels.level_title', 'LIKE', '%' . $params['level_title'] . '%');
        }
        $levels = $eloquent->paginate($results_per_page);
        return $levels;
    }

    /*     * ********************************************
     * findLevelById
     */

    public function findLevelById($level_id) {

        $level = self::where('level_id', $level_id)
                ->first();
        return $level;
    }

    /*     * ********************************************
     * updatedataLevel
     */

    public function updateLevel($input) {
        $level = self::find($input['id']);
        if (!empty($level)) {

            $level->level_title = $input['level_title'];
            $level->level_overview = $input['level_overview'];
            $level->level_description = $input['level_description'];
            $level->level_points = $input['level_points'];
            $level->level_image = $input['filename'];
//            $level->level_images = $level_images;
            $level->save();
        } else {

        }
    }

    /*     * ********************************************
     * addLevel
     */

    public function addLevel($input) {

        $level = self::create([
                    'level_title' => $input['level_title'],
                    'level_overview' => $input['level_overview'],
                    'level_description' => $input['level_description'],
                    'level_points' => $input['level_points'],
                    'level_image' => $input['filename'],
//                    'level_images' => $level_images,
        ]);
        return $level;
    }

    /*     * ********************************************
     * deleteLevelById
     */

    public function deleteLevelById($level_id) {

        $level = self::find($level_id);
        return $level->delete();
    }
    
    
    /**
     * push select
     */

    public function pushSelectBox() {
        $levels = self::orderBy('level_title', 'ASC')
                ->pluck('level_title', 'level_id');
        return $levels;
    }
}
