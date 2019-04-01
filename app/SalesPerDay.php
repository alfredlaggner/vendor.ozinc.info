<?php

namespace App;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class SalesPerDay extends Model
{
	//use Searchable;
	protected $fillable = ['order_id','order_date','name','quantity','cost', 'margin', 'sales_person_id', 'code'];
}
