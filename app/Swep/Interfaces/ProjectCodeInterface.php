<?php

namespace App\Swep\Interfaces;
 


interface ProjectCodeInterface {

	public function fetchAll($request);

	public function store($request);

	public function update($request, $slug);

	public function destroy($slug);

	public function findBySlug($slug);
		
}