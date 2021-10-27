<?php

namespace App\Http\Controllers;

use App\Models\TagMaster;
use Illuminate\Http\Request;

class TagMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tags = TagMaster::where('del_flag', '0')->get();
        if ($tags) {
            return response()->json([
                'success' => true,
                'msg' => [
                    'tags' => $tags
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
     * @param  \App\Models\TagMaster  $tagMaster
     * @return \Illuminate\Http\Response
     */
    public function show(TagMaster $tagMaster)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TagMaster  $tagMaster
     * @return \Illuminate\Http\Response
     */
    public function edit(TagMaster $tagMaster)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TagMaster  $tagMaster
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TagMaster $tagMaster)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TagMaster  $tagMaster
     * @return \Illuminate\Http\Response
     */
    public function destroy(TagMaster $tagMaster)
    {
        //
    }
}
