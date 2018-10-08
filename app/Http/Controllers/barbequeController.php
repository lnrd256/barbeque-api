<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barbeque;
use App\User;
use Carbon\Carbon;
class barbequeController extends Controller
{
    public function index(Request $request){
        return response()->json(Barbeque::all()); 
    }

    public function store(Request $request){
        $request->validate([
            'name'     => 'required|string',
            'model'    => 'required|string',
        ]);
        $barbeque=new Barbeque([
            'name'=>$request->name,
            'model'=>$request->model,
            'description'=>$request->description,
            'zipcode'=>$request->zipcode,
            'image'=>'imagenpordefecto.jpg',
            'rented'=>false
        ]);

        $barbeque->save();

        return response()->json([
            'message' => 'Successfully created barbeque!'], 201);
    }

    public function show($id){
        $barbeque=Barbeque::find($id);
        return response()->json($barbeque); 
    }
    public function getRented(Request $request){
        $user=User::findOrFail($request->user()->id);
        return response()->json($user->barbeque->where('rented','1'));
    }
    public function rent(Request $request){
        $user=User::findOrFail($request->user()->id);
        $barbeque=Barbeque::findOrFail($request->id_barbeque);
        $user->barbeque()->save($barbeque,['rent_date'=>Carbon::now(),'return_date'=>Carbon::now()]);
        $barbeque->rented=1;
        $barbeque->save();
        return $user->barbeque;
    }
    public function return(Request $request){
        $barbeque=Barbeque::findOrFail($request->id_barbeque);
        $barbeque->user()->detach($request->user()->id);
        $barbeque->rented=0;
        $barbeque->save();
        return $barbeque->user;
        
    }
}
