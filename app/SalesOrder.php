<?php

namespace App;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
  //  use Searchable;
//	use \Swis\LaravelFulltext\Indexable;
    protected $table = 'salesorders';

    public function saleinvoice()
    {
        return $this->hasMany('App\SaleInvoice', 'order_id', 'sales_order_id');
    }

	public function customer()
	{
		return $this->hasOne('App\Customer', 'ext_id','customer_id' );
	}

	public function salesperson()
	{
		return $this->hasOne('App\SalesPerson', 'sales_person_id','salesperson_id' );
	}

}
