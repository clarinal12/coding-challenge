<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
Use App\Passers;
use App\Http\Resources\Passers as PassersResource;

class PassersController extends Controller
{
    public function index(Request $request)
    {
        $limit = (int)$request->input('limit');

        if($request->input('name')) {
            return new PassersResource(Passers::orderBy('name', 'asc')->where('name', 'LIKE', '%'.$request->input('name').'%')->paginate($limit));
        }
        else if($request->input('school')){
            return new PassersResource(Passers::orderBy('name', 'asc')->where('school', 'LIKE', '%'.$request->input('school').'%')->paginate($limit));
        }
        else if($request->input('division')){
            return new PassersResource(Passers::orderBy('name', 'asc')->where('division', 'LIKE', '%'.$request->input('division').'%')->paginate($limit));
        }
        else{
            return new PassersResource(Passers::orderBy('name', 'asc')->paginate($limit));
        }
    }

    public function store(Request $request){
        $passer = Passers::create($request->all());

        return response()->json($passer, 201);
    }

    public function display(){
        return new PassersResource(Passers::orderBy('passers', 'desc')->groupBy('school')->select('school', DB::raw('count(*) as passers'))->get());
    }
    
}