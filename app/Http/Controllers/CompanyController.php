<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\libs\ResponseCode;
use App\Service\ReadFile;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = Company::all();
        foreach($company as $c){
            $c['imageCompany'] = ReadFile::getLink($c['imageCompany']);
        }
        return [
            'responseCode' => ResponseCode::SUCCESS,
            'message' => ResponseCode::getMessage(ResponseCode::SUCCESS),
            'data' => $company
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
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        Company::truncate();
    }

     /**
     * Insert a listing firebase of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function insert()
    {
        $filename = 'company';
        $path = storage_path() . "/json/${filename}.json"; // ie: /var/www/laravel/app/storage/json/filename.json

        $json = json_decode(file_get_contents($path), true);
        // dd($json);
        $sizeData = Company::all()->count();
        // dd($json);
        $count = 0;
        if(count($json) > 0 && $sizeData == 0){
            foreach($json as $j){
                $object = [];
                $object['address'] = $j['address'];
                $object['city'] = $j['city'];
                $image = file_get_contents($j['imageCompany']);
                $filename = 'img/' . time() . rand(11, 99).'.png';
                file_put_contents(public_path($filename), $image);
                $object['imageCompany'] = $filename;
                $object['latitude'] = $j['location']['latitude'];
                $object['longtitude'] = $j['location']['longitude'];
                $object['name'] = $j['name'];
                $object['phoneNumber'] = $j['phoneNumber'];
                $object['type'] = $j['type'];
                $insert = DB::table('company')->insert($object);
                if($insert) {
                    $count++;
                }
            }

        }
        return view("insert", compact("count"));
    }

}
