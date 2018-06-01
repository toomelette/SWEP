<?php

namespace App\Http\Controllers;

use App\Swep\Services\AccountService;
use App\Http\Requests\AccountFormRequest;
use App\Http\Requests\AccountFilterRequest;


class AccountController extends Controller{



	protected $account;



    public function __construct(AccountService $account){

        $this->account = $account;

    }



    
    public function index(AccountFilterRequest $request){

    	return $this->account->fetchAll($request);
    
    }

    


    public function create(){

        return view('dashboard.account.create');

    }

    


    public function store(AccountFormRequest $request){

    	return $this->account->store($request);
        
    }




    public function edit($slug){

    	return $this->account->edit($slug);
        
    }




    public function update(AccountFormRequest $request, $slug){

    	return $this->account->update($request, $slug);

    }

    


    public function destroy($slug){

    	return $this->account->destroy($slug);

    }




}
