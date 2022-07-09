<?php

namespace App\Http\Controllers;

use App\Models\HeathNews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\libs\ResponseCode;
use Exception;
use App\Service\ReadFile;

class HeathNewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $heathNews = HeathNews::all();
        foreach($heathNews as $h){
            $h['imageNews'] = ReadFile::getLink($h['imageNews']);
        }
        return [
            'responseCode' => ResponseCode::SUCCESS,
            'message' => ResponseCode::getMessage(ResponseCode::SUCCESS),
            'data' => $heathNews
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
     * @param  \App\Models\HeathNews  $heathNews
     * @return \Illuminate\Http\Response
     */
    public function show(HeathNews $heathNews)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HeathNews  $heathNews
     * @return \Illuminate\Http\Response
     */
    public function edit(HeathNews $heathNews)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HeathNews  $heathNews
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HeathNews $heathNews)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HeathNews  $heathNews
     * @return \Illuminate\Http\Response
     */
    public function destroy(HeathNews $heathNews)
    {
        HeathNews::truncate();
    }
    public function insert()
    {
        $filename = 'healthNews';
        $path = storage_path() . "/json/${filename}.json"; // ie: /var/www/laravel/app/storage/json/filename.json

        $json = json_decode(file_get_contents($path), true);
        // dd($json);
        $sizeData = HeathNews::all()->count();
        // dd($json);
        $count = 0;
        if(count($json) > 0 && $sizeData == 0){
            foreach($json as $j){
                $object = [];
                $object['createAt'] = date('Y-m-d H:m:i',strtotime($j['createAt']));
                // dd($object['createAt']);
                try {
                    $image = file_get_contents($j['imageNews']);
                } catch (Exception $ex) {
                    $image = file_get_contents('https://phutungnhapkhauchinhhang.com/wp-content/uploads/2020/06/default-thumbnail.jpg');
                }
                $filename = 'img/' . time() . rand(11, 99).'.png';
                file_put_contents(public_path($filename), $image);
                $object['imageNews'] = $filename;
                $object['prevention'] = $j['prevention'];
                $object['symptom'] = $j['symptom'];
                $object['titleNews'] = $j['titleNews'];
                $insert = DB::table('healthNews')->insert($object);
                if($insert) {
                    $count++;
                }
            }

        }
        return view("insert", compact("count"));
    }
}
