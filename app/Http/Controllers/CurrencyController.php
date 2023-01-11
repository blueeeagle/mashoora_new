<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\CurrencyDataTable;
use App\Models\Currency;
use App\Models\Companysetting;
use DataTables;

class CurrencyController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('Permissions:Currency_View',['only'=>['index']]);
    }
    
    public function index()
    {
        return view('currency.index');
    }
    public function datatable(Request $request){
        $Companysetting = Companysetting::where('id',1)->first();
        $search=[];
        $columns=$request->columns;
        foreach($columns as $colum){
            $search[] = $colum['search']['value'];
        }

        $datas = Currency::orderBy('countryname','ASC')
        ->when($search[1],function($query,$search){
            return $query->where('countryname','LIKE',"%{$search}%");
        })
        ->when($search[2],function($query,$search){
            return $query->where('countrycode','LIKE',"%{$search}%");
        })
        ->when($search[3],function($query,$search){
            return $query->where('currencycode','LIKE',"%{$search}%");
        })
        ->when($search[5],function($query,$search){
            return $query->where('price','<',$search);
        })
        ->get();
        return DataTables::of($datas)
			->addIndexColumn()
			->addColumn('action', function(Currency $data){
                return ['edit'=> \route('master.currency.edit',$data->id)];
            })
            ->editColumn('created_at', function(Currency $data) use($Companysetting){
                if($data->created_at){
                    $temp = $Companysetting->custom_date_time($data->created_at);
                    return $temp;
                }
                return '-';
            })->editColumn('updated_at', function(Currency $data) use($Companysetting){
               if($data->updated_at){
                    $temp = $Companysetting->custom_date_time($data->updated_at);
                    return $temp;
                }
                return '-';
            })
            ->addColumn('status', function(Currency $data) {
                $status = ($data->status == 1)?'checked':'' ;
                $route = \route('master.currency.status',$data->id);
                return "<div class='form-check form-switch form-check-custom form-check-solid'>
                        <input class='form-check-input' type='checkbox' status data-url='$route' value='' $status />
                    </div>";
            })
            ->rawColumns(['status','action'])
            ->toJson();
    }
    
    public function edit(Currency $currency ){
        return \view('currency.edit',['currency'=>$currency]);
    }
    
    public function update(Request $Request,Currency $currency){
        $currency->update($Request->all());
        return response()->json(['msg'=>'Updated Successfully']);
    }


    public function destroy($id, Currency $Currency)
    {
        return $Currency->find($id)->delete();
    }
    
    public function status(Request $request,Currency $Currency){
        $Currency->status = $request->status;
        $Currency->update();
        return response()->json(['status'=>true,'msg'=>'Status Updated']);
    }
}
