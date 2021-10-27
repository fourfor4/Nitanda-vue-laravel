<?php

namespace App\Http\Controllers;

use App\Models\RoleMaster;
use Illuminate\Http\Request;

class RoleMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $roles = RoleMaster::where('del_flag', '0')->get();
        if ($roles) {
            return response()->json([
                'success' => true,
                'msg' => [
                    'roles' => $roles
                ]
            ], 200);
        } else {
            return response()->json([
                'success' => false,
            ], 200);   
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RoleMaster  $roleMaster
     * @return \Illuminate\Http\Response
     */
    public function show(RoleMaster $roleMaster)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RoleMaster  $roleMaster
     * @return \Illuminate\Http\Response
     */
    public function edit(RoleMaster $roleMaster)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RoleMaster  $roleMaster
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RoleMaster $roleMaster)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RoleMaster  $roleMaster
     * @return \Illuminate\Http\Response
     */
    public function destroy(RoleMaster $roleMaster)
    {
        //
    }
}
