<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Discount;
use App\Models\Offer;
use App\Models\Category;
use App\Models\Config;
use Auth;
use Validator;
use DataTables;

class ConfigController extends Controller
{
    public function __construct()
    {
        $this->middleware('Permissions:Config_View',['only'=>['index']]);
        $this->middleware('Permissions:Config_Create',['only'=>['create']]);
        $this->middleware('Permissions:Config_Edit',['only'=>['edit']]);
        $this->middleware('Permissions:Config_delete',['only'=>['destroy']]);
    }

	public function datatableForHome(Request $request){
            
        $datas = Config::with('discount')->with('offer')->where('choose_section',1)->orderBy('id','desc')->get();
                   
        return DataTables::of($datas)
        ->addIndexColumn()
        ->addColumn('typeOfConfig', function(Config $datas) {
            $type ='';
            if($datas->type==1){
                return 'Discount';
            }
            if($datas->type==2){
                return 'Offer';
            }
            
        })
        ->addColumn('discount_offer',function(Config $datas){
            $dis_off = '';
            if($datas->discount!='' && $datas->type==1){
                $dis_off = $datas->discount->promo_title;
            }
            if($datas->offer!='' && $datas->type==2){
                $dis_off = $datas->offer->offer_title;
            }
            return $dis_off;
            
        })
        ->addColumn('status', function(Config $datas) {
            $status = ($datas->status == 1)?'checked':'' ;
            $route = \route('activities.config.status',$datas->id);
                return "<div class='form-check form-switch form-check-custom form-check-solid'>
                        <input class='form-check-input' type='checkbox' status data-url='$route' value='' $status />
                    </div>";
        })
        ->addColumn('categoryId', function(Config $datas){
            $cat = Category::whereIn('id',explode(',',$datas->category_id))->get();
            $template='';
            for($i = 0;$i<count($cat); $i++){
                $template .= "<span class='badge badge-success'>".$cat[$i]->name."</span>"."<br/>";          
            }
            return $template;
          
        })
        ->addColumn('action', function(Config $datas){
            return ['Delete'=> \route('activities.config.destroy',$datas->id),'edit'=> \route('activities.config.edit',$datas->id)];
        })
        ->rawColumns(['typeOfConfig','discount_offer','status','action','categoryId'])
            //--- Returning Json Data To Client Side
        ->toJson();
    }
	public function datatableForAllCategory(Request $request){
        
        $datas = Config::with('discount')->with('offer')->where('choose_section',2)->orderBy('id','desc')->get();
                   
        return DataTables::of($datas)
        ->addIndexColumn()
        ->addColumn('typeOfConfig', function(Config $datas) {
            $type ='';
            if($datas->type==1){
                return 'Discount';
            }
            if($datas->type==2){
                return 'Offer';
            }
            
        })
        ->addColumn('discount_offer',function(Config $datas){
            $dis_off = '';
            if($datas->discount!='' && $datas->type==1){
                $dis_off = $datas->discount->promo_title;
            }
            if($datas->offer!='' && $datas->type==2){
                $dis_off = $datas->offer->offer_title;
            }
            return $dis_off;
            
        })
        ->addColumn('status', function(Config $datas) {
            $status = ($datas->status == 1)?'checked':'' ;
            $route = \route('activities.config.status',$datas->id);
                return "<div class='form-check form-switch form-check-custom form-check-solid'>
                        <input class='form-check-input' type='checkbox' status data-url='$route' value='' $status />
                    </div>";
        })
        ->addColumn('action', function(Config $datas){
            return ['Delete'=> \route('activities.config.destroy',$datas->id),'edit'=> \route('activities.config.edit',$datas->id)];
        })
        ->addColumn('categoryId', function(Config $datas){
            $cat = Category::whereIn('id',explode(',',$datas->category_id))->get();
            $template='';
            for($i = 0;$i<count($cat); $i++){
                $template .= "<span class='badge badge-success'>".$cat[$i]->name."</span>"."<br/>";          
            }
            return $template;
        })
        ->rawColumns(['typeOfConfig','discount_offer','status','action','categoryId'])
            //--- Returning Json Data To Client Side
        ->toJson();
    }
	public function datatableForCategory(Request $request){
        
        $datas = Config::with('discount')->with('offer')->where('choose_section',3)->orderBy('id','desc')->get();
                   
        return DataTables::of($datas)
        ->addIndexColumn()
        ->addColumn('typeOfConfig', function(Config $datas) {
            $type ='';
            if($datas->type==1){
                return 'Discount';
            }
            if($datas->type==2){
                return 'Offer';
            }
            
        })
        ->addColumn('discount_offer',function(Config $datas){
            $dis_off = '';
            if($datas->discount!='' && $datas->type==1){
                $dis_off = $datas->discount->promo_title;
            }
            if($datas->offer!='' && $datas->type==2){
                $dis_off = $datas->offer->offer_title;
            }
            return $dis_off;
            
        })
        ->addColumn('status', function(Config $datas) {
            $status = ($datas->status == 1)?'checked':'' ;
            $route = \route('activities.config.status',$datas->id);
                return "<div class='form-check form-switch form-check-custom form-check-solid'>
                        <input class='form-check-input' type='checkbox' status data-url='$route' value='' $status />
                    </div>";
        })
        ->addColumn('action', function(Config $datas){
            return ['Delete'=> \route('activities.config.destroy',$datas->id),'edit'=> \route('activities.config.edit',$datas->id)];
        })
        ->addColumn('categoryId', function(Config $datas){
            $cat = Category::whereIn('id',explode(',',$datas->category_id))->get();
            $template='';
            for($i = 0;$i<count($cat); $i++){
                $template .= "<span class='badge badge-success'>".$cat[$i]->name."</span>"."<br/>";          
            }
            return $template;
        })
        ->rawColumns(['typeOfConfig','discount_offer','status','action','categoryId'])
            //--- Returning Json Data To Client Side
        ->toJson();
    }


	public function index(){
		return view('config.index');
	}

	public function create(){
		$discount=Discount::where('status','1')->get();
		$offer=Offer::where('status','1')->get();
		
        $tree = [];
        $Category = Category::where('status',1)->where('type',0)->get();
        foreach ($Category as $key => &$value) {
            # code...
            $temp = null;
            $temp = [
                'id' => $value->id,
                'text' => $value->name,
            ];
            $Category = Category::where('status',1)->where('categories_id',$value->id)->where('type',1)->get();
            foreach ($Category as $key1 => $value1) {
                # code...
                $temp['children'][] = [
                    'id' => $value1->id,
                    'text' => $value1->name,
                ];
            }
        
            $tree[] = $temp;
        }
		return view('config.create',compact('discount','offer','tree'));
	}

    public function store(Request $Request){
        
        $config_home_Screen = new Config;

        $config_home_Screen->fill($Request->all());
        $config_home_Screen->category_id = $Request->categorie_id;
        $config_home_Screen->status = (isset($Request->status)?1:0);
        $config_home_Screen->save();
    
        return response()->json(['msg'=>'Config Home Screen Addes']);
    }
    
    public function update(Request $Request,Config $config){
    
        $config->status = (isset($Request->status)?1:0);
        
        $config->update($Request->all());
        $config->category_id = $Request->categorie_id;
        $config->update();
        return response()->json(['msg'=>'Updated Successfully']);
    }

	public function status(Request $request,Config $config){
        $config->status = $request->status;
        $config->update();
        return response()->json(['status'=>true,'msg'=>'Status Updated']);
    }
    public function edit(Request $request,Config $config ){
        $discount=Discount::where('status','1')->get();
		$offer=Offer::where('status','1')->get();
		$category_id = \explode(',',$config->category_id);
        $tree = [];
        $Category = Category::where('status',1)->where('type',0)->get();
        foreach ($Category as $key => &$value) {
            # code...
            $temp = null;
            $temp = [
                'id' => $value->id,
                'text' => $value->name,
            ];
            $Category = Category::where('status',1)->where('categories_id',$value->id)->where('type',1)->get();
            foreach ($Category as $key1 => $value1) {
                # code...
                $temp['children'][] = [
                    'id' => $value1->id,
                    'text' => $value1->name,
                    'state' => [
                        'selected' => \in_array($value1->id,$category_id)  //'selected' does NOT take effect after refresh
                    ]
                ];
            }
            $tree[] = $temp;
        }
		
        // dd($configHomeScreen->all());
        return \view('config.edit',
        [   'config'=>$config,
            'offer'=>$offer,'discount'=>$discount,
            'tree'=>$tree,
        ]);
    }



    public function destroy(Config $config)
    {
        $config->delete();
        $data1['msg'] = 'Data Deleted Successfully.';
        $data1['status'] = true;
        return response()->json($data1);
        //--- Redirect Section Ends
    }

}
