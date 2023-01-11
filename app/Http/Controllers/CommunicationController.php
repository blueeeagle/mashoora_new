<?php
namespace App\Http\Controllers;


// require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\User;
use App\Models\Firm;
use App\Models\Consultant;
use App\Models\Category;
use App\Models\Offer;
use App\Models\Customer;
use App\Models\Communication;
use App\Models\CommunicationSend;
use Illuminate\Support\Facades\Input;
use DataTables;
use Illuminate\Support\Collection;
use Validator;
use App\Jobs\CommunicationJob;

class CommunicationController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('Permissions:Communication_View',['only'=>['index']]);
        $this->middleware('Permissions:Communication_Create',['only'=>['create']]);
        $this->middleware('Permissions:Communication_delete',['only'=>['destroy']]);
    }
    
    public function index(){
        // $CommunicationJob = new CommunicationJob;
        // $this->dispatch($CommunicationJob);
        return view('communication.index');
    }

    public function sendTO_Datatable(Request $request){
        $search=[];
        $columns=$request->columns;
        foreach($columns as $colum){
            $search[] = $colum['search']['value'];
        }
        // dd($search);
        $datas = null;
        // dd($search[4]);
       
        
       
        if($search[4] == '1'){
            $datas = Customer::orderBy('id','desc')->get();
        }elseif($search[4] == '2'){
            $datas = Consultant::orderBy('id','desc')->get();            
        }
        else{
            $datas = new Collection;
        }        
        $datas->when($search[1],function($query,$search){
            return $query->where('name','LIKE',"%{$search}%");
        });
        
       
        return DataTables::of($datas)
        ->addIndexColumn()
        ->addColumn('action',function($datas){
            return "12";
        })
        ->toJson();
    }

    public function datatables(Request $request){
        $search=[];
        $columns=$request->columns;
        foreach($columns as $colum){
            $search[] = $colum['search']['value'];
        }

        $datas = Communication::with('getcommdata')
        ->when($search[1],function($query,$search){
            return $query->where('communication_mode','LIKE',"%{$search}%");
        })
        ->when($search[2],function($query,$search){
            return $query->where('send_to','LIKE',"%{$search}%");
        })
        ->orderBy('id','desc')->get();

        //  dd($datas);
        return DataTables::of($datas)
        ->addIndexColumn()
        ->addColumn('type', function($datas){
            $type=""; 
            if($datas->communication_mode == 1){
                $type="SMS";
            }
            elseif($datas->communication_mode == 2){
                $type="Push Notification";
            }
            else{
                $type="Email";
            }
            return $type;
        })
        ->addColumn('sendTo',function($datas){
            $send="";
            if($datas->send_to ==1){
                $send="Customer";
            }
            elseif($datas->send_to ==2){
                $send="Consultant";
            }
            else{
                $send="Others";
            }
            return $send;
        })
        ->addColumn('selectedUser',function($datas){
            $selectedUser=0;
            if($datas->send_to == 1){ //Customer counts
                $s=[];
                $s = explode(',',$datas->getcommdata->customer_id);
                $selectedUser= Count($s);
            }
            if($datas->send_to == 2){ //COnsulant Counts
                $c =[];
                $c = explode(',',$datas->getcommdata->consultant_id);
                $selectedUser= Count($c);
            }
            return $selectedUser;
        })
        ->addColumn('action',function($datas){
            return ['view'=> \route('other.communication.view',$datas->id),'delete'=>\route('other.communication.destroy',$datas->id)];
        })
        ->rawColumns(['selectedUser','sendTo','type','action'])
        ->toJson();
    }

    public function create(){
        
        return \view('communication.create');
    }

    public function store(Request $Request){
        $rules=[
			'communication_mode' => 'required',
			'send_to' => 'required',
			'subject' => 'required',
			'body' => 'required',
		];

		$customs=[
			// 'title.required'  => 'Title Name should be filled',
			// 'title.unique'      	=> 'Title Name already taken',
		];
        
       
        
        // dd($rows);
        $validator = Validator::make($Request->all(), $rules,$customs);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        $communication = new Communication;
        $communication->fill($Request->all());
        $communication->status = (isset($Request->status)?1:0);
        $communication->save();
    
        $communication_sends = new CommunicationSend;

        if($Request->customer_consultant_id !=''){
            $con= \implode(',', $Request->customer_consultant_id);
            $communication_sends->communication_id = $communication->id;
            if($Request->send_to == 1){
                $communication_sends->customer_id = $con;
            }
            if($Request->send_to == 2){
                $communication_sends->consultant_id = $con;
            }
          
            $communication_sends->save();
        }

        if($Request->others){
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($Request->others);
            $spreadsheet = $spreadsheet->getActiveSheet();
            $rows = $spreadsheet->toArray();
        
        
            if($rows != ''){
                foreach ($rows as $key => $value) {
                    foreach ($value as $key => $value) {
                        # code...
                        $data[] = [
                            'communication_id' => $communication->id,
                            'others' =>$value,
                        ];
                    } 
                }
                // dd($data);
                CommunicationSend::insert($data);
            }
        }
        

       return response()->json(['msg'=>'Communication Addes']);
    }

	

    public function status(Request $request,Communication $communication){
        $communication->status = $request->status;
        $communication->update();
        return response()->json(['status'=>true,'msg'=>'Status Updated']);
    }


    public function destroy(Communication $communication)
    {
        $communication->delete();
        $data1['msg'] = 'Data Deleted Successfully.';
        $data1['status'] = true;
        return response()->json($data1);
        //--- Redirect Section Ends
    }

    public function view(Communication $communication){
        $communication = Communication::with('getcommdata')->where('id',$communication->id)->first();
        $consultant = Consultant::whereIn('id',explode(',',$communication->getcommdata->consultant_id))->get();
        $customer = Customer::whereIn('id',explode(',',$communication->getcommdata->customer_id))->get();
       // dd($customer);
        return view('communication.view',['communication'=>$communication,'consultant'=>$consultant,'customer'=>$customer]);
	}

}
