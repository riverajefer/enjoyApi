<?php

namespace App\Http\Controllers\Math;
use Illuminate\Support\Arr;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TypeOperations;
use App\Models\Operations;

class TypeOperationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function add()
    {
        // return Operations::all();

        $collection = Operations::where('level', 'easy')->get();
        $random = $collection->random(1);

        return $random;


        for ($i = 10; $i <= 20; $i++) {
            for ($j = 20; $j <= 70; $j++) {
                $k = ($i + $j);
/*                 echo "<b>i:</b> " . $i . "  <b>j:</b> " . $j . "  <b>k:  </b> " . $k;
                echo "<br>"; */
/*                 $opt = new Operations();
                $opt->val1 = $i;
                $opt->val2 = $j;
                $opt->resul = $k;
                $opt->level = 'hard';
                $opt->type_operations_id = 1;
                $opt->save(); */
            }
        }
        // return;
        return Operations::all();





        // return TypeOperations::all();
        $opt = new Operations();
        $opt->val1 = 5.0;
        $opt->val2 = 5.0;
        $opt->resul = 10.0;
        $opt->level = 'easy';
        $opt->type_operations_id = 1;
        //return $opt;
        // $opt->save();



        $type = new TypeOperations();
        $type->name = 'División';
        $type->save();
        // return $type;
    }
}
