<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\BaseController;
use App\libraries\libs\pinyin;
use App\Models\TbuyDzd;
use App\Models\Order;
use App\Models\Product;
use App\Models\Store;
use App\Models\TbuyLogistics;
use App\Models\TbuyOrderDetails;
use DB;
use Illuminate\Http\Request;

class OrderController extends BaseController
{
    public $payStatus = [
        0=>'等待支付',
        1=>'支付成功',
        2=>'支付失败',
        3=>'订单关闭',
    ];
    //订单状态
    public $orderStatus = [
        '1' => '未审核',
        '2' => '审核中',
        '3' => '订单驳回',
        '4' => '订单确认',
        '5' => '订单取消',
        '6' => '合同上传',
        '7' => '未付款'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $status_all = $this->getOrderStatus();
        $status = $request->input('status');

        $where = [];


//        $where['order_status'] = $status;

        /*$pay_status = $request->input('pay_status');
        $status = $request->input('status');
        $order_no = $request->input('order_no');
        unset($_REQUEST['_token']);*/
        //搜索
        $status = $request->input('status');
        echo $status;

        if(isset($request->search)){
            if(!empty($_REQUEST['status'])){
                $where['order_status'] = $_REQUEST['status'];
            }

//            if(!empty($order_no)){
//                $where['tbuy_order.order_no'] = $order_no;
//            }
//            if(!empty($status)){
//                $where['tbuy_order_details.status'] = $status;
//            }
//            if($request->is_balance !== null){
//                $where['tbuy_order_details.is_balance'] = $request->is_balance ;
//            }
//            if($pay_status != ''){
//                $where['tbuy_order.status'] = $pay_status;
//            }
//            if(!empty($request->keyword)){
//                $where[] = [$request->keyword_type, 'like', '%'.$request->keyword.'%'];
//            }
//            $where[] = ['create_time', '>=', $request->begin_time];
//            $where[] = ['create_time', '<=', $request->end_time];
        }

        $total = DB::table('order')->where($where)->orderBy('order_id', 'desc')->count();
        $order_list = DB::table('order')->where($where)->orderBy('order_id', 'desc')->paginate(10);

        return view('order.order.index',['data'=>$order_list, 'total'=>$total, 'status_all'=>$status_all, 'orderStatus'=>$this->orderStatus, 'a_status'=>$status]);

    }



    //订单详情
    public function detail($id) {
        $result = DB::table('order')
            ->where('order_id', $id)
            ->join('house_message','order.house_id','=','msgid')
            ->first();
        return view("order.order.detail",['result'=>$result,'orderStatus'=>$this->orderStatus]);
    }

    /**
     *导出详情
     */
    public function detail_excel($id)
    {
        $data = DB::table('order')
            ->where('order_id', $id)
            ->select('order_no','creat_time','name','house_no','house_name','house_position','house_price','rent_time','sign_time','sign_position','order_status','house_eva','intermediary_eva')
            ->get()
            ->toArray();
        $title = ['订单号','日期','租客姓名','房源编号','房源名称','房源位置','价格','租期','签约时间','签约地点','订单状态','房屋评价','中介评价'];
        exportData($title,$data,'房源信息'.date('Y-m-d'));
    }
}
