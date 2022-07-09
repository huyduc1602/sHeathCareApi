<?php

namespace App\Http\Controllers;

use App\Models\Slides;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\libs\ResponseCode;
use Exception;
use Illuminate\Support\Facades\Config;
use App\Service\ReadFile;

class SlidesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slides = Slides::all();
        // var_dump(resource_path());
        // die;
        foreach($slides as $s){
            $s['thumbnail'] = ReadFile::getLink($s['thumbnail']);
            $s['urlVideo'] = ReadFile::getLink($s['urlVideo']);
        }
        return [
            'responseCode' => ResponseCode::SUCCESS,
            'message' => ResponseCode::getMessage(ResponseCode::SUCCESS),
            'data' => $slides
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
     * @param  \App\Models\Slides  $slides
     * @return \Illuminate\Http\Response
     */
    public function show(Slides $slides)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slides  $slides
     * @return \Illuminate\Http\Response
     */
    public function edit(Slides $slides)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slides  $slides
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slides $slides)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slides  $slides
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slides $slides)
    {
        Slides::truncate();
    }
    public function insert()
    {
        ini_set('memory_limit', '1024M');
        $filename = 'slides';
        $path = storage_path() . "/json/${filename}.json"; // ie: /var/www/laravel/app/storage/json/filename.json

        $json = json_decode(file_get_contents($path), true);
        // dd($json);
        $sizeData = Slides::all()->count();
        // dd($json);
        $count = 0;
        if(count($json) > 0 && $sizeData == 0){
            foreach($json as $j){
                $object = [];
                $object['createAt'] = $j['createAt'];
                $object['description'] = $j['description'];
                try {
                    $image = file_get_contents($j['thumbnail']);
                } catch (Exception $ex) {
                    $image = file_get_contents('https://phutungnhapkhauchinhhang.com/wp-content/uploads/2020/06/default-thumbnail.jpg');
                }
                $filename = 'img/' . time() . rand(11, 99).'.png';
                file_put_contents(public_path($filename), $image);
                $object['thumbnail'] = $filename;

                try {
                    $urlVideo = file_get_contents($j['urlVideo']);
                } catch (Exception $ex) {
                    $urlVideo = file_get_contents('http://www.homeworkouts.tv/images/default/video.png');
                }
                $filenameVideo = 'video/' . time() . rand(11, 99).'.mp4';
                file_put_contents(public_path($filenameVideo), $urlVideo);
                $object['urlVideo'] = $filenameVideo;
                $object['title'] = $j['title'];
                $insert = DB::table('slides')->insert($object);
                if($insert) {
                    $count++;
                }
            }

        }
        return view("insert", compact("count"));
    }
}
