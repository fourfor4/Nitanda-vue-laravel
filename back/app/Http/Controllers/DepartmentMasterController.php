<?php

namespace App\Http\Controllers;

use App\Models\DepartmentMaster;
use Illuminate\Http\Request;

class DepartmentMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $departments = DepartmentMaster::all();
        if ($departments) {
            return response()->json([
                'success' => true,
                'msg' => [
                    'departments' => $departments
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
     * @param  \App\Models\DepartmentMaster  $departmentMaster
     * @return \Illuminate\Http\Response
     */
    public function show(DepartmentMaster $departmentMaster)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DepartmentMaster  $departmentMaster
     * @return \Illuminate\Http\Response
     */
    public function edit(DepartmentMaster $departmentMaster)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DepartmentMaster  $departmentMaster
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DepartmentMaster $departmentMaster)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DepartmentMaster  $departmentMaster
     * @return \Illuminate\Http\Response
     */
    public function destroy(DepartmentMaster $departmentMaster)
    {
        //
    }
}
