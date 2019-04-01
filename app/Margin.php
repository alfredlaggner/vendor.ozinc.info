<?php

	namespace App;

	use Laravel\Scout\Searchable;
	use Illuminate\Database\Eloquent\Model;

	class Margin extends Model
	{
	//	use Searchable;

		protected $fillable = ['units_sold'];

		public function stock_moves()
		{
			return $this->hasMany('App\StockMove', 'product_id', 'ext_id');
		}

	}
