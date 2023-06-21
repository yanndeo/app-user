<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GroupeResource;
use App\Models\Groupe;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class GroupeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return  GroupeResource::collection(Groupe::all());
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Groupe  $groupe
     * @return \Illuminate\Http\Response
     */
    public function show(Groupe $groupe)
    {
        if($groupe) {
            return response(['groupe' => new GroupeResource($groupe), 'message' => 'Retrieved Successfully'], Response::HTTP_OK);
        }
        return response(['groupe' => new GroupeResource($groupe), 'message' => 'Group not exist'], Response::HTTP_NOT_FOUND);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Groupe  $groupe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Groupe $groupe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Groupe  $groupe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Groupe $groupe)
    {
        //
    }
}
