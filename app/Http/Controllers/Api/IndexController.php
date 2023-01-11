<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Video;
use App\Models\Article;
use App\Models\Config;
use App\Http\Controllers\Controller;
use DataTables;
use Validator;
use DB;
use App\Models\Offer;
class IndexController extends Controller
{
    public function index(){
        $banner = Config::where('type',1)->get();
        $allCategory = Category::where('type',0)->withCount('child')->where('status',1)->where('display_in_home',1)->orderBy('sort_no_home')->take(6)->get();
        $Video = Video::where('display_in_home',1)->orderBy('sort_no')->take(6)->where('status',1)->get();
        $Article = Article::take(6)->where('status',1)->get();
        return response()->json(['banner'=>$banner,'allCategory' => $allCategory,'allvideo'=>$Video,'allarticle'=>$Article], 200);
    }

    public function viewallcategoty($id = null){
        $allCategory = Category::where('type',0)->where('status',1);
        $offers = [];
        if($id){ 
            $paymentDate = strtotime(date("Y-m-d H:i:s"));
            $allCategory = $allCategory->with('child')->where('id',$id)->first(); 
            $ids = $allCategory->child->pluck("id");
            $offers = Offer::whereIn('sub_category_id',$ids)->where('category_id',$allCategory->id)->where('status',1)->get();
            $offers = $offers->map(function($data,$key) use ($paymentDate) {
                
                $from_date = strtotime($data->from_date);
                $to_date = strtotime($data->to_date);
                if($data->has_validity != 1) return $data;
                if($paymentDate > $from_date && $paymentDate < $to_date) {
                  return $data;
                } 
            });
        }
        else $allCategory = $allCategory->withCount('child')->orderBy('sort_no_list')->get();
        return response()->json(['allCategory' => $allCategory, 'offers'=>$offers ], 200);
    }

    public function viewallvideo($id = null){
        $Video = Video::orderBy('sort_no')->where('status',1);
        if($id) $Video = $Video->where('id',$id)->first();
        else $Video = $Video->get();
        return response()->json(['video' => $Video], 200);
    }

    public function viewallartical($id = null){
        $Article = Article::where('status',1);
        if($id) $Article = $Article->where('id',$id)->first();
        else $Article = $Article->get();
        return response()->json(['Article' => $Article], 200);
    }
}
