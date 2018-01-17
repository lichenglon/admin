<?php
namespace App\Http\Controllers\House;
use App\Http\Controllers\BaseController;
use App\Models\House_type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use DB;
class TypeController extends BaseController {
	/**
	 * 房源类型首页
	 */
	public function index() {
		$menu_list = DB::table('house_type')->get()->toArray();
		$menu_list = genTree($menu_list);
		return view('house.type.index',['tree'=>$menu_list]);
	}

	public function tree($tree = null){
		return view('house/type/tree',['tree'=>$tree]);
	}
	/**
	 *房源类型添加表单
	 */
	public function add() {

		return view('house/type/add');
	}
	/**
	 *房源类型表单提交
	 */
	public function save(Request $request){
		$data = $request->input();
		$data['pid'] = '0';
		unset($data['_token']);
		$rs = House_type::insert($data);
		if($rs){
			//更新操作日志
			$id = Session::get('user_id');
			$operate_name = DB::table('accounts')->where('id',$id)->value('name');
			$operate = "add a new house type , is ".$data['name'];
			//$operate = "新增了房源类型，编号为：".$serial_number;
			$operate_log = [
					'operate' => $operate,
					'operate_name' => $operate_name,
					'operate_time' => time()
			];
			DB::table('operate_log')->insert($operate_log);

			return redirect('house/type')->with('success','添加分类成功！');
		}else{
			return redirect('house/type/add')->with('error','添加分类失败！');
		}
	}
	/**
	 *删除
	 */
	public function delete($id){
		$type = DB::table('house_type')->where('id', $id)->value('name');
		$rs = DB::table('house_type')->where('id', $id)->delete();
		if($rs){
			//更新操作日志
			$id = Session::get('user_id');
			$operate_name = DB::table('accounts')->where('id',$id)->value('name');
			$operate = "delete a house type , is ".$type;
			//$operate = "删除了一个房源类型，编号为：".$serial_number;
			$operate_log = [
					'operate' => $operate,
					'operate_name' => $operate_name,
					'operate_time' => time()
			];
			DB::table('operate_log')->insert($operate_log);


			return $this->ajaxSuccess('删除分类成功！', url('house/type'));
		}
		return $this->ajaxError('删除分类失败！', url('house/type'));
	}
	/**
	 *修改分类
	 */
	public function update(Request $request){
		if(!empty($request->id)){
			$data = ['sort_number'=>$request->sort_number, 'name'=>$request->name];
			$rs = DB::table('house_type')->where('id',$request->id)->update($data);
			if($rs){
				//更新操作日志
				$id = Session::get('user_id');
				$operate_name = DB::table('accounts')->where('id',$id)->value('name');
				$operate = "modify a house type , is ".$data['name'];
				//$operate = "更新了一个房源类型，编号为：".$serial_number;
				$operate_log = [
						'operate' => $operate,
						'operate_name' => $operate_name,
						'operate_time' => time()
				];
				DB::table('operate_log')->insert($operate_log);
				return $this->ajaxSuccess('编辑成功!');
			}else{
				return $this->ajaxError('编辑失败!');
			}
		}
	}

}