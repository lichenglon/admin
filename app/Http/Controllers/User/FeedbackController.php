<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/24
 * Time: 11:37
 */

namespace App\Http\Controllers\User;
use App\Http\Controllers\BaseController;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class FeedbackController extends BaseController{
	public function feedback(Request $request){

		$where = [];
		$search = isset($request->search) ? $request->search : false;
		$stime = isset($request->stime) ? $request->stime : false;
		$etime = isset($request->etime) ? $request->etime : false;
		$kwd_k = isset($request->kwd_k) ? $request->kwd_k : false;
		$msg = isset($request->msg) ? $request->msg : '%';
		if($kwd_k){

			$where[] = [$kwd_k, 'like', '%'.$msg.'%'];
		} else{
			$where[] = ['yourname', 'like', '%'];
		}
		if($stime && $etime){

			$where[] = ['time','>=',strtotime($stime.' 00:00:00')];
			$where[] = ['time','<=',strtotime($etime.' 23:59:59')];
		}

		if($search){
			$arr = DB::table('tb_email')->where($where)->paginate(5);
		} else{
			$arr = DB::table('tb_email')->paginate(5);
		}

		return view('user.feedback', [
				'arr'   => $arr,
				'total' => DB::table('tb_email')->count(),
				'kwd_k' => $kwd_k,
				'msg'   => $msg,
				'stime' => $stime,
				'etime' => $etime
		]);



	}

	/**
	 *用户评论
	 */
	public function comment(Request $request)
	{
		$where = [];
		$search = isset($request->search) ? $request->search : false;
		$stime = isset($request->stime) ? $request->stime : false;
		$etime = isset($request->etime) ? $request->etime : false;
		if($stime && $etime){
			$where[] = ['create_time','>=',strtotime($stime.' 00:00:00')];
			$where[] = ['create_time','<=',strtotime($etime.' 23:59:59')];
		}
		if($search)
		{
			$arr = DB::table('comment')->where($where)
					->join('tb_register','comment.user_id','=','tb_register.id')
					->join('house_message','comment.house_id','=','house_message.msgid')
					->select('comment.*','tb_register.user','tb_register.email','house_message.serial_number')
					->paginate(8);
			$total = DB::table('comment')->where($where)->count();
		}
		else
		{
			$arr = DB::table('comment')
					->join('tb_register','comment.user_id','=','tb_register.id')
					->join('house_message','comment.house_id','=','house_message.msgid')
					->select('comment.*','tb_register.user','tb_register.email','house_message.serial_number')
					->paginate(8);
			$total = DB::table('comment')->count();
		}



		return view('user.comment',['arr' => $arr, 'total' => $total,'stime' => $stime, 'etime' => $etime]);
	}

	/**
	 *评论删除
	 */
	public function delete($id){

		$rs = DB::table('comment')->where('id',$id)->delete();
		if($rs){
			return $this->ajaxSuccess('删除评论成功！', url('/user/comment'));
		}
		return $this->ajaxError('删除评论失败！', url('/user/comment'));
	}
}