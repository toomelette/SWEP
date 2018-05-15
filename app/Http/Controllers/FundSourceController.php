<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Swep\Services\FundSourceService;
use App\Http\Requests\FundSourceFormRequest;


class FundSourceController extends Controller{

	protected $fund_source;



    public function __construct(FundSourceService $fund_source){

        $this->fund_source = $fund_source;

    }



    
    public function index(Request $request){

        return $this->fund_source->fetchAll($request);
    
    }

    


    public function create(){

        return view('dashboard.fund_source.create');

    }

    


    public function store(FundSourceFormRequest $request){

         return $this->fund_source->store($request);
        
    }




    public function show($id){


        
    }




    public function edit($slug){

        return $this->fund_source->edit($slug);
        
    }




    public function update(FundSourceFormRequest $request, $slug){

        return $this->fund_source->update($request, $slug);

    }

    


    public function destroy($slug){

       return $this->fund_source->destroy($slug); 

    }
    
}