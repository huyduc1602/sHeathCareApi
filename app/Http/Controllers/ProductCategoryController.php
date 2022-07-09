<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\libs\ResponseCode;
use Illuminate\Support\Facades\Schema;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productCategory = ProductCategory::all();

        return [
            'responseCode' => ResponseCode::SUCCESS,
            'message' => ResponseCode::getMessage(ResponseCode::SUCCESS),
            'data' => $productCategory
        ];
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
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCategory $productCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductCategory $productCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductCategory $productCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductCategory $productCategory)
    {
        Schema::disableForeignKeyConstraints();
        ProductCategory::truncate();
        Schema::enableForeignKeyConstraints();
    }

    public function insert()
    {
        $filename = 'productCategory';
        $path = storage_path() . "/json/${filename}.json"; // ie: /var/www/laravel/app/storage/json/filename.json

        $json = json_decode(file_get_contents($path), true);
        // dd($json);
        $sizeData = ProductCategory::all()->count();
        // dd($json);
        $count = 0;
        if (count($json) > 0 && $sizeData == 0) {
            foreach ($json as $j) {
                // die($j['categoryLists']);
                $object = [];
                $object['name'] = $j['name'];
                $object['parent_id'] = 0;
                $insert = DB::table('productCategory')->insert($object);
                if ($insert) {
                    $count++;
                }
                foreach($j['categoryLists'] as $c){
                    $child = [];
                    $child['name'] = $c;
                    $parent = DB::table('productCategory')->where('parent_id',0)->latest('id')->first();
                    $child['parent_id'] = $parent->id;
                    // var_dump($parent->id);
                    // die;
                    $insert = DB::table('productCategory')->insert($child);
                    if ($insert) {
                        $count++;
                    }
                }
            }
        }
        return view("insert", compact("count"));
    }
}
