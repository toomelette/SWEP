<?php

namespace App\Swep\Interfaces;
 


interface FundSourceInterface {

	public function fetch($request);

	public function store($request);

	public function update($request, $slug);

	public function destroy($slug);

	public function findBySlug($slug);

	public function getAll();
		
}