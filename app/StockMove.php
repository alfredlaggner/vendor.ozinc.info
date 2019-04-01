<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockMove extends Model
{
	public function margin(){
		return $this->belongsTo(Margin::class, 'ext_id','product_id');
	}}
