<?php

	namespace App;

	use Laravel\Scout\Searchable;
	use Illuminate\Database\Eloquent\Model;
	use \Swis\LaravelFulltext\Indexable;

	class SaleInvoice extends Model
	{
//		use Searchable;

		protected $indexTitleColumns = ['name'];

		protected $table = 'saleinvoices';
		protected $fillable = ['invoice_number', 'ext_id', 'order_date', 'ext_id_shipping', 'name', 'quantity', 'ext_id_unit', 'unit_price', 'sales_person_id', 'code', 'updated_at', 'created_at'];

		public function customer()
		{
			return $this->belongsTo('App\Customer', 'ext_id_shipping', 'ext_id');
		}

		public function product()
		{
			return $this->hasOne('App\Margin', 'ext_id', 'product_id');
		}

		public function salesperson()
		{
			return $this->hasOne('App\SalesPerson', 'sales_person_id', 'ext_id');
		}

		public function toSearchableArray()
		{
			$array = $this->toArray();

			// Customize array...

			return $array;
		}

		public function sales_order()
		{
			return $this->belongsTo('App\SalesOrder', 'ext_id_shipping', 'ext_id_contact');
		}

	}
