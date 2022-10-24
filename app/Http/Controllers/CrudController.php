<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth;
use Mail;

use App\Enrolment;
use App\BusinessPlanPackage;

class CrudController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $ds = $request->ds;
        $from = $request->from;
        $to = $request->to;
        $res = $request->res;
        $with = $request->with=="" ? [] : explode(',',$request->with);

        $key = $request->key;
        $val = $request->val;
        $model_name = '\\App\\Models\\'.$request->model;
        $model = new $model_name;
        $query = $model::query();
        $q = explode(',', $request->q);
        $s = sizeof($q);
        if($s % 3 == 0 && $s != 0){
            $i = 0;
            for($i =0; $i< $s/3; $i++){
                $m = $i * 3;
                $k = ($m + 0);
                $o = ($m + 1);
                $v = ($m + 2);
                if($q[$o] == "=="){
                    $query = $query->where($q[$k], $q[$v]);
                } else {
                    $query = $query->where($q[$k], $q[$o], $q[$v]);
                }
            }
        }
        if($key != ""){
            switch($res){

                case "Start";
                $query = $query->where($key, 'like', $val . '%');
                break;

                case "Exact";
                $query = $query->where($key, $val);
                break;

                case "Anywhere";
                $query = $query->where($key, 'like', '%' . $val . '%');
                break;
            }
        }
        if($ds == 'Yes'){
            $query = $query->where('created_at', '>=', $from)->where('created_at', '<=', $to);
        }
        if(sizeof($with) > 0){
            $query = $query->with($with);
        }
        $query = $query->orderBy('id', 'desc')->paginate($request->r)->jsonSerialize();
        return response($query, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $crudnames = explode("," ,$request->crudnames);
        $crudtypes = explode("," ,$request->crudtypes);
        $crudvalidation = explode("," ,$request->crudvalidation);

        $data = [];
        foreach($crudnames as $key=>$value){
            if($request->id == 0){
                if($crudtypes[$key] != "file" || $crudtypes[$key] != "image"){
                    $data[$value] = $crudvalidation[$key];
                }
            } else {
                $data[$value] = $crudvalidation[$key];
            }
        }

        $request->validate($data);
        $input = $request->all();

        if( $request->form_action == "MAIL"){

            $data = [];

            $dd = "";
            unset($input['model']);
            unset($input['id']);
            unset($input['form_action']);
            unset($input['to']);
            unset($input['subject']);
            unset($input['crudnames']);
            unset($input['crudtypes']);
            unset($input['crudvalidation']);

            foreach($input as $k => $v){
                if(gettype($v) == "object"){
                } else {
                    $dd .= "<p>".$k.": ".$v."</p>";
                }
            }

            Mail::send([], [], function($message) use($request, $dd) {
                $message
                ->to($request["to"], $request["name"])
                ->subject($request["subject"])
                ->setBody('<h1>Form Data</h1>'.$dd.'<br>','text/html');

                foreach($request->all() as $k => $v){
                    if(gettype($v) == "object"){
                        if($file = $request->file($k)){
                            $message->attach($file->getRealPath(), array(
                                'as' => $file->getClientOriginalName(),
                                'mime' => $file->getMimeType())
                            );
                        }
                    }
                }

            });

            return response(["message" => "Success"], Response::HTTP_OK);

        } else {

            if(isset($input["password"])){
                $input["password"] = bcrypt($input["password"]);
            }
            foreach($input as $k => $v){
                if(gettype($v) == "object"){
                    if($file = $request->file($k)){
                        $name = time().'_'.mt_rand(100000,999999).'_'.$file->getClientOriginalName();
                        $file->move($input["model"], $name);
                        $input[$k] = "/".$input["model"]."/".$name;
                        if($input["id"] != 0){
                            $model_name = '\\App\\Models\\'.$request->model;
                            $model = new $model_name;
                            $fl = $model->find($input["id"])[$k];
                            if($fl != null || $fl != ""){
                                if(file_exists(substr($fl, 1))){
                                    unlink(substr($fl, 1));
                                }
                            }
                        }
                    }
                }
            }
            if( $input["id"] == 0){
                if(!isset($input["user_id"])){
                    $input["user_id"] = Auth::id();
                }
                $model_name = '\\App\\Models\\'.$request->model;
                $model = new $model_name;
                $crud = $model->create($input);

                /* This is Custom Code Start */
                if($request->model =="ScrapReport"){
                    $user = Auth::user();
                    $crud->inventory()->create([
                        'user_id' => $user->id,
                        'product_id' => $request->product_id,
                        'warehouse_id' => $user->warehouse_id,
                        'qty' => $request->qty,
                        'flow' => 'Out',
                        'narration' => 'Scrap',
                    ]);
                }
                /* Custom Code End */

                return response()->json($crud->id);
            } else {

                $model_name = '\\App\\Models\\'.$request->model;
                $model = new $model_name;
                $model->find($input["id"])->update($input);

                /* This is Custom Code Start */
                if($request->model =="ScrapReport"){
                    $model->find($input["id"])->inventory()->update([
                        'product_id' => $request->product_id,
                        'qty' => $request->qty,
                    ]);
                }
                /* Custom Code End */

                return response()->json("ok");
            }

        }
    }

    public function show($id, Request $request)
    {
        $model_name = '\\App\\Models\\'.$request->model;
        $model = new $model_name;
        //return response($model->find($id)->jsonSerialize(), Response::HTTP_OK);
        return response($model->find($id), Response::HTTP_OK);
    }

    public function destroy($id, Request $request)
    {
        $files = explode("," ,$request->all()["files"]);
        foreach($files as $file){
            $model_name = '\\App\\Models\\'.$request->model;
            $model = new $model_name;
            $fl = $model->find($id)[$file];
            if($fl != null || $fl != ""){
                if(file_exists(substr($fl, 1))){
                    unlink(substr($fl, 1));
                }
            }
        }
        $model_name = '\\App\\Models\\'.$request->model;
        $model = new $model_name;

        /* This is Custom Code Start */
        if($request->model =="ScrapReport"){
            $model->find($id)->inventory()->delete();
        }
        /* Custom Code End */

        $model->find($id)->delete();
        return response()->json("ok", Response::HTTP_OK);
    }

    public function showall(Request $request){
        $request;
        $key = $request->key;
        $val = $request->val;
        $model_name = '\\App\\Models\\'.$request->model;
        $model = new $model_name;
        return $query = $model::get([$key . ' as key', 'id as value']);
    }

    public function getuser(){
        return Auth::user();
    }

    public function email(Request $request){
    }

}
