<?php

namespace App\Http\Controllers;


use App\Swep\Services\MenuService;
use App\Http\Requests\MenuFormRequest;
use App\Http\Requests\MenuFilterRequest;



class MenuController extends Controller{


    protected $menu;



    public function __construct(MenuService $menu){

        $this->menu = $menu;

    }


    
    public function index(MenuFilterRequest $request){
        
        return $this->menu->fetchAll($request);

    }

    

    public function create(){
        
        return view('dashboard.menu.create');

    }

   

    public function store(MenuFormRequest $request){
        
        return $this->menu->store($request);

    }
 



    public function edit($slug){
        
        return $this->menu->edit($slug);

    }




    public function update(MenuFormRequest $request, $slug){
        
        return $this->menu->update($request, $slug);

    }

    


    public function destroy($slug){
        
        return $this->menu->destroy($slug);

    }



    
}
