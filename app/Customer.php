<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
//	use Searchable;

    public function saleinvoices()
    {
        return $this->hasMany('App\SaleInvoice', 'ext_id_shipping', 'ext_id');
    }

    public function sales_orders()
    {
        return $this->hasMany('App\SalesOrder', 'customer_id', 'ext_id');
    }
	public function toSearchableArray()
	{
		$array = $this->toArray();

		return array(
			'id' => $array['id'],
			'name' => $array['name'],
			'street' => $array['street'],
			);
	}
}
