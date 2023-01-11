<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Consultantcategory;
use App\Models\Consultant;
use DataTables;
use Validator;
use DB;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{

    public function index(Request $request){

        $article = Article::where('consultant_id',Auth::guard('consultant')->user()->id)->get();
        return DataTables::of($article)->addIndexColumn()->toJson();
    }

    public function store(Request $Request)
    {
        $rules=[
            'title' => "required|unique:articles,title,$Request->title",
			'describtion' => 'required',
			'image' => 'required',
		];

		$customs=[
			'title.required'  => 'Title Name should be filled',
			'title.unique'  => 'Title Name Taken',
			'describtion.required'  => 'Description Name should be filled',
			'image.required'  => 'image shout be choosen',
		];

        $validator = Validator::make($Request->all(), $rules,$customs);
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $Article = new Article;
        $Article->from_user = 1;
        $Article->consultant_id = Auth::guard('consultant')->user()->id;
        $Article->title = $Request->title;
        $Article->describtion = $Request->describtion;
        $Article->status = (isset($Request->status)?1:0);
        if($Request->has('image')){
            $Article->image = $Request->file('image')->store("uploadFiles/Articel/",'public_custom');
        }
        $Article->save();

       return response()->json(['msg'=>'Article Addes']);
    }

    public function edit(Article $article){
        return response()->json(['article'=>$article] ,200);
    }

    public function update(Request $Request, Article $article)
    {
        $rules=[
            'title' => "required|unique:articles,title,$article->id,id",
			'describtion' => 'required',
		];

		$customs=[
			'title.required'  => 'Title Name should be filled',
			'title.unique'  => 'Title Name Taken',
			'describtion.required'  => 'Description Name should be filled',
		];

        $validator = Validator::make($Request->all(), $rules,$customs);
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $article->title = $Request->title;
        $article->describtion = $Request->describtion;
        $article->status = (isset($Request->status)?1:0);
        if($Request->has('image')){
            $article->image = $Request->file('image')->store("uploadFiles/Articel/",'public_custom');
        }

        $article->update();
        return response()->json(['msg'=>'Update Successfully']);
    }

    public function destroy(Request $request, Article $article){
        $article->delete();
        $data1['msg'] = 'Data Deleted Successfully.';
        $data1['status'] = true;
        return response()->json($data1);
    }
}
