<?php
namespace App\Models;

use App\Models\Base;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Order_status extends Base
{
	protected $table = 'order_status';

	/**
	 * 获取订单状态
	 */
	public function get_order_status($statusId = 1)
	{
		$rs = $this->where('id',$statusId)->first();
		if($rs)
		{
			if(Session::get('lang') == 'en')
			{
				return $rs->en_order_status;
			}
			else
			{
				return $rs->order_status;
			}
		}
		else
		{
			return '未知状态';
		}

	}

}