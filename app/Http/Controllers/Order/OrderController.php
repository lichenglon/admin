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
        '1' => '订单未付款',
        '2' => '订单未审核',
        '3' => '订单审核中',
        '4' => '审核已通过',
        '5' => '订单驳回',
        '6' => '订单已确认',
        '7' => '合同已上传',
        '8' => '订单已完成',
        '9' => '订单取消'
    ];

    public function index(Request $request)
    {
        $where = [];
        //订单状态值
        $status_all = DB::table('order_status')->get();

        //接收搜索值
        $status = $request->input('status');
        $stime = $request->input('stime') ? $request->input('stime') : '';
        $etime = $request->input('etime') ? $request->input('etime') : date('Y-m-d');
        $kwd_k = $request->input('kwd_k') ? $request->input('kwd_k') : '';
        $kwd_v = $request->input('kwd_v') ? $request->input('kwd_v') : '';

        //判断搜索框
        /*if(isset($request->search))
        {*/
            if(!empty($_REQUEST['status'])){
                $where['order_status'] = $_REQUEST['status'];
            }
            if(!empty($stime) && !empty($etime)){
                $where[] = ['creat_time','>=',strtotime($stime.' 00:00:00')];
                $where[] = ['creat_time','<=',strtotime($etime.' 23:59:59')];
            }
            if(!empty($kwd_k) && !empty($kwd_v)){
                $where[] = ['order.'.$kwd_k, 'like', '%'.$kwd_v.'%'];
            }
        //}
        //判断是否导出excel
        if(isset($request->excel))
        {
            $data = DB::table('order')->where($where)->join('tb_register','order.uid','=','id')->select('order.order_no','tb_register.uname as u_name','order.name','order.tel','order.creat_time','order.order_status','order.order_remark')->orderBy('id', 'desc')->get()->toArray();
            $arr = [];
            foreach($data as $v)
            {
                $v['creat_time'] = date('Y-m-d H:i:s',$v['creat_time']);
                $v['order_status'] = $this->orderStatus[$v['order_status']];
                $arr[] = $v;
            }
            $title = ['订单号','下单人','租客姓名','租客手机号码','下单时间','订单状态','备注信息'];
            exportData($title,$arr,'订单信息'.date('Y-m-d'));
        }

        $total = DB::table('order')->where($where)->orderBy('id', 'desc')->count();
        $order_list = DB::table('order')->where($where)->orderBy('id', 'desc')->paginate(10);
        return view('order.order.index', ['data'=>$order_list, 'total'=>$total, 'status_all'=>$status_all, 'orderStatus'=>$this->orderStatus, 'a_status'=>$status, 'stime' => $stime, 'etime' => $request->etime, 'kwd_k' => $kwd_k, 'kwd_v' =>$kwd_v]);

    }
    //审核订单页面
    public function check($id){
        DB::table('order')->where('id',$id)->update(['order_status'=>'3']);
        $order_no = DB::table('order')->where('id',$id)->value('order_no');
        $renter = DB::table('renter')->where('order_no',$order_no)->first();
        $result = DB::table('order')->where('id', $id)->join('house_message','order.house_id','=','msgid')->first();
        return view("order.order.check",['result'=>$result,'renter'=>$renter,'orderStatus'=>$this->orderStatus]);
    }
    //审核订单提交
    public function saveChk(){
        $id = $_REQUEST['id'];
        if($_REQUEST['order_status'] == '4'){
            DB::table('order')->where('id',$id)->update(['order_status'=>'4']);
        }
        if($_REQUEST['order_status'] == '5'){
            DB::table('order')->where('id',$id)->update(['order_status'=>'5','reject_reason'=>$_REQUEST['reject_reason']]);
        }
        return redirect('order/order');
    }
    

    //审核状态更改,他已经废了。也可能还有用
    public function isCheck(){
        if($_GET['order_status'] && $_GET['order_id'])
        {
            //接收审核状态
            $order_status = $_GET['order_status'];
            //接收ID
            $order_id = (int)$_GET['order_id'];
            //数据库更改状态
            $result = DB::table('order')->where('order_id',$order_id)->update(['order_status'=>$order_status]);
            //判断并返回
            if($result){return '1';}else{return '0';}}
    }

    //订单详情
    public function detail($id) {
        $result = DB::table('order')->where('id', $id)->join('house_message','order.house_id','=','msgid')->first();
        $order_no = DB::table('order')->where('id',$id)->value('order_no');
        $renter = DB::table('renter')->where('order_no',$order_no)->first();
        return view("order.order.detail",['result'=>$result,'renter'=>$renter,'orderStatus'=>$this->orderStatus]);
    }

}
