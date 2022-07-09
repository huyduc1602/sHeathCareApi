<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\libs\ResponseCode;
use Exception;
use App\Service\ReadFile;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::all();
        foreach($product as $p){
            $p['image'] = ReadFile::getLink($p['image']);
        }
        return [
            'responseCode' => ResponseCode::SUCCESS,
            'message' => ResponseCode::getMessage(ResponseCode::SUCCESS),
            'data' => $product
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
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        Product::truncate();
    }
    public function insert()
    {
        $filename = 'product';
        $path = storage_path() . "/json/${filename}.json"; // ie: /var/www/laravel/app/storage/json/filename.json

        $json = json_decode(file_get_contents($path), true);
        // dd($json);
        $sizeData = Product::all()->count();
        // dd($json);
        $count = 0;
        if(count($json) > 0 && $sizeData == 0){
            foreach($json as $j){
                $object = [];
                $object['idComment'] = $j['idComment'];
                try {
                    $image = file_get_contents($j['image']);
                } catch (Exception $ex) {
                    $image = file_get_contents('https://phutungnhapkhauchinhhang.com/wp-content/uploads/2020/06/default-thumbnail.jpg');
                }
                $filename = 'img/' . time() . rand(11, 99).'.png';
                file_put_contents(public_path($filename), $image);
                $object['image'] = $filename;
                $object['ingredient'] = $j['ingredient'];
                $object['licenseNumber'] = $j['licenseNumber'];
                $object['likeNumber'] = $j['likeNumber'];
                $object['name'] = $j['name'];
                $object['origin'] = $j['origin'];
                $object['sideEfects'] = $j['sideEfects'];
                $object['userManual'] = $j['userManual'];
                $object['uses'] = $j['uses'];
                $type = explode("/",$j['type']);
                // var_dump($type[2]);
                // die;
                switch($type[2]){
                    case 'X2htlKH0CNpYmKzypEbZ':
                        // parent_id = 1
                        $parent = DB::table('productCategory')->where('parent_id',1)->get();
                        $category = $parent[(int)$type[4]];
                        // dd($category->id);
                        $object['type'] = $category->id;
                        break;
                    case 'ZfHusG0EOexx4kJWSZfk':
                        // parent_id = 8
                        $parent = DB::table('productCategory')->where('parent_id',8)->get();
                        $category = $parent[(int)$type[4]];
                        // dd($category->id);
                        $object['type'] = $category->id;
                        break;
                    case 'hYx0pgvF5ABY27FOyrBU':
                         // parent_id = 14
                        $parent = DB::table('productCategory')->where('parent_id',14)->get();
                        $category = $parent[(int)$type[4]];
                        // dd($category->id);
                        $object['type'] = $category->id;
                        break;
                    default:

                        break;
                }
                $insert = DB::table('product')->insert($object);
                if($insert) {
                    $count++;
                }
            }

        }
        return view("insert", compact("count"));
    }
}
