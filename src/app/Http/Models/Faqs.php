<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App;
use DB;

class Faqs extends Model {

    protected $table = 'faqs';
    protected $primaryKey = 'faq_id';
    public $timestamps = false;
    protected $fillable = [
        "create_by_user_id",
        "level_id",
        "status_id",
        "category_id",
        "faq_title",
        "faq_overview",
        "faq_description",
        "faq_image", // làm k lo lam ..cmt :(
        "faq_views",
        "faq_like",
        "faq_cache_page",
        "faq_created_at",
        "faq_updated_at",
        "updated_at",
        "created_at",
    ];
    protected $guarded = ["faq_id"];

    /*     * ********************************************
     * getList
     *
     * @author: Kang
     * @date: 26/6/2016
     *
     * @status: REVIEWED
     */

    public function getList($params = array()) {
        $this->config_reader = App::make('config');
        $results_per_page = $this->config_reader->get('dragonknight.faq_admin_per_page');

        $eloquent = self::orderBy('faqs.faq_id', 'DESC');

        //Search by faq title
        if (!empty($params['faq_title'])) {
            $eloquent->where('faqs.faq_title', 'LIKE', '%' . $params['faq_title'] . '%');
        }

        //Search by faq status
        if (!empty($params['status_id'])) {
            $eloquent->where('faqs.status_id', 'LIKE', '%' . $params['status_id'] . '%');
        }




        $faq = $eloquent->paginate($results_per_page);

        return $faq;
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

    public function findFaqId($id) {
        $faq = self::where('faq_id', $id)
                ->first();
        return $faq;
    }

    /*     * *******************************************
     * updateFaq
     *
     * @author: Kang
     * @web: http://tailieuweb.com
     * @date: 26/6/2016
     *
     * @status: REVIEWED
     */

    public function updateFaq($input) {
        $faq = self::find($input['id']);
        if (!empty($faq)) {

            $faq->faq_title = $input['faq_title'];
            $faq->status_id = $input['status_id'];
            $faq->faq_overview = $input['faq_overview'];
            $faq->faq_description = $input['faq_description'];
            $faq->faq_image = $input['filename'];
            $faq->save();
        } else {
            
        }
    }

    /*     * ********************************************
     * addFaq
     *
     * @author: Kang
     * @web: http://tailieuweb.com
     * @date: 26/6/2016
     *
     * @status: REVIEWED
     */

    public function addFaq($input) {

        $faq = self::create([

                    'faq_title' => $input['faq_title'],
                    'status_id' => $input['status_id'],
                    'faq_overview' => $input['faq_overview'],
                    'faq_description' => $input['faq_description'],
                    'faq_image' => $input['filename'],
        ]);
        return $faq;
    }

    /*     * ********************************************
     * deleteFaqById
     *
     * @author: Kang
     * @web: http://tailieuweb.com
     * @date: 26/6/2016
     *
     * @status: REVIEWED
     */

    public function deleteFaqById($faq_id) {

        $faq = self::find($faq_id);

        return $faq->delete();
    }
 
}
