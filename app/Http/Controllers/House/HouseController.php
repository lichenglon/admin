<?php

namespace App\Http\Controllers\House;
use App\Http\Controllers\BaseController;
use App\Models\House_message;
use App\Models\House_image;
use App\Models\Landlord_message;
use App\Models\House_type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use DB;
use App\libraries\libs\pinyin;
class HouseController extends BaseController {
	/**
	 *房源添加
	 */
	public function houseAdd() {
		$houseType = new House_type();
		$optionStr = $houseType->showOptionGetName();
		$nationArr = DB::table('nation')->get();
		return view('house.houseAdd',['optionStr'=>$optionStr,'nationArr'=>$nationArr]);
	}
	/**
	 *房源添加表单提交
	 */
	public function save(Request $param) {
		$houseData = Input::all();
		//国家
		$state = explode(',',$houseData['state']);
		$province =explode(',',$houseData['province']);
		//城市
		$city = explode(',',$houseData['city']);
		//实例化
		$houseMessage = new House_message();
		//查找数据
		$serialNumber = $houseMessage
				->select('serial_number')
				->orderBy('msgid', 'desc')
				->first();

		if(is_null($serialNumber)){
			//设置初始编号
			$serial_number = $state[2].$city[2].'11111111';
		} else {
			//取得上一次编号
			$str = $serialNumber->serial_number;
			//截取
			$intNum = substr($str,-8);
			//递增+1
			$serial_number = (int)$intNum+1;
			//拼接编号
			$serial_number = $state[2].$city[2].$serial_number;
		}

		$data = [
			//编号
			'serial_number' => $serial_number,
			//周边信息
			'rim_message' => isset($houseData['peripheral_information']) ? implode(',',$houseData['peripheral_information']) : '',
			//房屋设备
		    'house_facility' => isset($houseData['house_facility']) ? implode(',',$houseData['house_facility']) : '',
		    //房东身份ID
		    'landlord_id' => $houseData['landlord_identity'],
		    //中介ID
		    'intermediary_id' => Session::get('user_id') ? Session::get('user_id') : '',
			//房源位置
			'house_location' => $houseData['house_location'],
			//房源结构
			'house_structure' => $houseData['house_structure'],
			//房源价格
			'house_price' => $houseData['house_price'],
			//房源大小
			'house_size' => $houseData['house_size'],
			//房源类型
			'house_type' => $houseData['house_type'],
			//房源关键字
			'house_keyword' => $houseData['house_keyword'],
			//房源简介
			'house_brief' => $houseData['house_brief'],
			//起租期
			'house_rise' => $houseData['house_rise'] ? $houseData['house_rise'] : date('Y-m-d'),
			//最长租期
			'house_duration' => $houseData['house_duration'] ? $houseData['house_duration'] : date('Y-m-d'),
			//房屋状态
			'house_status' => $houseData['house_status'],
			//国家
			'state' => $state[0],
			//省份
			'province' => $province[0],
			//城市
			'city' => $city[0],
			//押金
			'cash_pledge' => $houseData['cash_pledge'],
			//预付款比例
			'payment_proportion' => $houseData['payment_proportion'],
			//结算方式
			'knot_way' => $houseData['knot_way'],
			//房源名称
			'house_name' => $houseData['house_location'].'-'.$houseData['house_structure']
		];
		$houseId = $houseMessage->insertGetId($data);  //保存
		//接收文件
		$files = $param->file('upload');
		if ($houseId) {
			$landlordMessage = new Landlord_message();
			$landlordDate = [
				//房源中介ID
				'intermediary_id' => Session::get('user_id') ? Session::get('user_id') : '',
				//房东姓名
				'landlord_name' => $houseData['landlord_name'],
				//房东证件ID
				'landlord_identity' => $houseData['landlord_identity'],
				//房东邮箱
				'landlord_email' => $houseData['landlord_email'] ? $houseData['landlord_email'] : '',
				//房东联系号码
				'landlord_phone' => $houseData['landlord_phone'],
				//房东性别
				'landlord_sex' => $houseData['landlord_sex'],
				//房东联系地址
				'landlord_site' => $houseData['landlord_site'] ? $houseData['landlord_site'] : '',
				//房东备注
				'landlord_remark' => $houseData['landlord_remark'] ? $houseData['landlord_remark'] : '',
				//房源ID
				'house_id' => $houseId
			];
			//房东信息插入
			$landlordId = $landlordMessage->insertGetId($landlordDate);
			if ($landlordId && $files) {
				//遍历文件
				foreach ($files as $file) {
					//实力化文件模型类
					$houseImage = new House_image();
					//保存
					$imagename = $file->store('','local');
					if ($imagename) {
						//房源ID
						$houseImage->house_msg_id = $houseId;
						//图片名称
						$houseImage->house_imagename = $imagename;
						//保存
						$houseImage->save();
					}
				}


				//更新操作日志
				$id = Session::get('user_id');
				$operate_name = DB::table('accounts')->where('id',$id)->value('name');
				$operate = "add a new house information , the number is ".$serial_number;
				//$operate = "新增了房源，编号为：".$serial_number;
				$operate_log = [
						'operate' => $operate,
						'operate_name' => $operate_name,
						'operate_time' => time()
				];
				DB::table('operate_log')->insert($operate_log);

				return redirect('house/houseAdd')->with('success','新增房源成功！');


			} elseif ($landlordId) {

				//更新操作日志
				$id = Session::get('user_id');
				$operate_name = DB::table('accounts')->where('id',$id)->value('name');
				$operate = "add a new house information , the number is ".$serial_number;
				//$operate = "新增了房源，编号为：".$serial_number;
				$operate_log = [
						'operate' => $operate,
						'operate_name' => $operate_name,
						'operate_time' => time()
				];
				DB::table('operate_log')->insert($operate_log);

				return redirect('house/houseAdd')->with('success','新增房源成功！未上传房源图片');

			}

		} else {
			echo "<script>alert('添加失败');history.go(-1);</script>";
		}
	}
	/**
	 *房源更新列表
	 */
	public function updateList() {
		$type = Input::get('type') ? Input::get('type') : '%';
		$serial_number = Input::get('serial_number') ? Input::get('serial_number') : '%';
		$house_structure = Input::get('house_structure') ? Input::get('house_structure') : '%';
		$house_price = Input::get('house_price') ? Input::get('house_price') : '%';
		$house_location = Input::get('house_location') ? Input::get('house_location') : '%';
		$house_keyword = Input::get('house_keyword') ? Input::get('house_keyword') : '%';
		$find = Input::get('find') ? Input::get('find') : '';
		$export = Input::get('export') ? Input::get('export') : '';

		if($find) {
			$gather = DB::table('house_message')->where('house_type','like',$type)
					->where('serial_number','like','%'.$serial_number.'%')
					->where('house_structure','like','%'.$house_structure.'%')
					->where('house_price','like','%'.$house_price.'%')
					->where('house_location','like','%'.$house_location.'%')
					->where('house_keyword','like','%'.$house_keyword.'%')
					->orderBy('msgid','desc')
					->paginate(16);


			$typeObject = DB::table('house_type')->select('name')->get();
			$houseCount = DB::table('house_message')->count();
			return view('house.updateList',['houseObj'=>$gather,
			                                 'typeObject'=>$typeObject,
			                                 'houseCount'=>$houseCount,
			                                 'type'=>$type,
			                                 'serial_number'=>$serial_number,
			                                 'house_structure'=>$house_structure,
			                                 'house_price'=>$house_price,
			                                 'house_location'=>$house_location,
			                                 'house_keyword'=>$house_keyword]);
		}elseif($export) {
			$gather = DB::table('house_message')->where('house_type','like',$type)
					->select('serial_number','house_location','house_structure','house_price','house_size','house_type','house_facility','house_rise','house_duration','house_status','state','province','city','rim_message','cash_pledge','payment_proportion','knot_way')
					->where('serial_number','like',$serial_number)
					->where('house_structure','like',$house_structure)
					->where('house_price','like',$house_price)
					->where('house_location','like',$house_location)
					->where('house_keyword','like',$house_keyword)
					->orderBy('msgid','desc')
					->get()
					->toArray();

			$title = [
					'编号',
					'房源位置',
					'房源结构',
					'房源价格',
					'房源大小/平方',
					'房源类型',
					'房屋设备',
					'起租期',
					'租期时长',
					'状态',
					'国家',
					'省',
					'城市',
					'周边信息',
					'押金',
					'预付款比例',
					'结算方式'
			];

			exportData($title,$gather,'房源信息'.date('Y-m-d'));
		}else{

			$gather = DB::table('house_message')
					->where('house_type','like',$type)
					->where('serial_number','like','%'.$serial_number.'%')
					->where('house_structure','like','%'.$house_structure.'%')
					->where('house_price','like','%'.$house_price.'%')
					->where('house_location','like','%'.$house_location.'%')
					->where('house_keyword','like','%'.$house_keyword.'%')
					->orderBy('msgid','desc')
					->paginate(16);

			$typeObject = DB::table('house_type')->select('name')->get();
			$houseCount = DB::table('house_message')->count();

			return view('house.updateList',[
					'houseObj'=>$gather,
					'typeObject'=>$typeObject,
					'houseCount'=>$houseCount,
					'type'=>$type,
					'serial_number'=>$serial_number,
					'house_structure'=>$house_structure,
					'house_price'=>$house_price,
					'house_location'=>$house_location,
					'house_keyword'=>$house_keyword
			]);
		}
	}

	/**
	 *房源修改详细页
	 */
	public function detail($id) {

		$houseType = new House_type();
		$optionStr = $houseType->showOptionGetName();
		$houseMsg = DB::table('house_message')
				->join('landlord_message', 'house_message.msgid', '=', 'landlord_message.house_id')
				->select('house_message.*', 'landlord_message.*')
				->where('msgid',$id)
				->first();

		$houseImg = new House_image();
		$imgArr = $houseImg->where('house_msg_id','=',$id)->get();
		$nationArr = DB::table('nation')->get();

		return view('house.updateDetail',['houseMsg'=>$houseMsg,'imgArr'=>$imgArr,'optionStr'=>$optionStr,'nationArr'=>$nationArr]);
	}

	/**
	 *Ajax请求获取地区
	 */
	public function region() {
		if(isset($_GET['p_nation_ID'])){
			$p_nation_ID = $_GET['p_nation_ID'];
			$provinceArr = DB::table('province')
					->where('p_nation_ID',$p_nation_ID)
					->get()
					->toArray();
			return $provinceArr;
		}
		if(isset($_GET['c_province_ID'])){
			$c_province_ID = $_GET['c_province_ID'];
			$cityArr = DB::table('city')->where('c_province_ID',$c_province_ID)->get()->toArray();
			return $cityArr;
		}
	}


	/**
	 *Ajax请求删除图片
	 */
	public function del(){
		$id = $_GET['id'];
		$houseImg = new House_image();
		$houseImgs = $houseImg->where('imgid',$id)->first();
		$imagename = $houseImgs->house_imagename;
		@unlink('./uploads/'.$imagename);
		$re = $houseImg->where('imgid',$id)->delete();
		if ($re) {
			return '1';
		} else {
			return '0';
		}
	}
	/**
	 *房源信息修改提交
	 */
	public function uSave(Request $param) {
		$msgId = $param->msgId;
		$landId = $param->landId;
		$houseData = Input::all();

		$data = [
			//周边信息
				'rim_message' => isset($houseData['peripheral_information']) ? implode(',',$houseData['peripheral_information']) : '',
			//房屋设备
				'house_facility' => isset($houseData['house_facility']) ? implode(',',$houseData['house_facility']) : '',
			//房东身份ID
				'landlord_id' => $houseData['landlord_identity'],
			//房源位置
				'house_location' => $houseData['house_location'],
			//房源结构
				'house_structure' => $houseData['house_structure'],
			//房源价格
				'house_price' => $houseData['house_price'],
			//房源大小
				'house_size' => $houseData['house_size'],
			//房源类型
				'house_type' => $houseData['house_type'],
			//房源关键字
				'house_keyword' => $houseData['house_keyword'],
			//房源简介
				'house_brief' => $houseData['house_brief'],
			//起租期
				'house_rise' => $houseData['house_rise'] ? $houseData['house_rise'] : date('Y-m-d'),
			//最长租期
				'house_duration' => $houseData['house_duration'] ? $houseData['house_duration'] : date('Y-m-d'),
			//房屋状态
				'house_status' => $houseData['house_status'],
			//押金
				'cash_pledge' => $houseData['cash_pledge'],
			//预付款比例
				'payment_proportion' => $houseData['payment_proportion'],
			//结算方式
				'knot_way' => $houseData['knot_way'],
			//房源名称
				'house_name' => $houseData['house_location'].'-'.$houseData['house_structure'].'-'.$houseData['house_price'],
			//审核状态
				'chk_sta' => '1'
		];
		DB::table('house_message')->where('msgid', $msgId)->update($data);

		//更新操作日志
		$id = Session::get('user_id');
		$operate_name = DB::table('accounts')->where('id',$id)->value('name');
		$serial_number = DB::table('house_message')->where('msgid',$msgId)->value('serial_number');
		$operate = "modify a house's infomation , the number is ".$serial_number;
		//$operate = "更新了房源，编号为：".$serial_number;
		$operate_log = [
				'operate' => $operate,
				'operate_name' => $operate_name,
				'operate_time' => time()
		];
		DB::table('operate_log')->insert($operate_log);

		$landlordDate = [
			//房源中介ID
				'intermediary_id' => Session::get('user_id') ? Session::get('user_id') : '',
			//房东姓名
				'landlord_name' => $houseData['landlord_name'],
			//房东证件ID
				'landlord_identity' => $houseData['landlord_identity'],
			//房东邮箱
				'landlord_email' => $houseData['landlord_email'] ? $houseData['landlord_email'] : '',
			//房东联系号码
				'landlord_phone' => $houseData['landlord_phone'],
			//房东性别
				'landlord_sex' => $houseData['landlord_sex'],
			//房东联系地址
				'landlord_site' => $houseData['landlord_site'] ? $houseData['landlord_site'] : '',
			//房东备注
				'landlord_remark' => $houseData['landlord_remark'] ? $houseData['landlord_remark'] : '',
		];
		DB::table('landlord_message')
				->where('landid', $landId)
				->update($landlordDate);
		$files = $param->file('upload');
		if ($files) {
			foreach ($files as $file) {
				$houseImage = new House_image();
				$imageName = $file->store('','local');
				if ($imageName) {
					$houseImage->house_msg_id = $msgId;
					$houseImage->house_imagename = $imageName;
					$houseImage->save();
				}
			}
		}
		return redirect('house/updateList/detail/'.$msgId)->with('success','更新成功！');
	}
	/**
	 *房源详细信息
	 */
	public function houseDetail($id)
	{
		$houseMsg = DB::table('house_message')
				->join('landlord_message','house_message.msgid','=','landlord_message.house_id')
				->select('house_message.*', 'landlord_message.*')
				->where('msgid',$id)
				->first();
		$houseImg = new House_image();
		$imgArr = $houseImg
				->where('house_msg_id','=',$id)
				->get();
		return view('house.houseDetail',['houseMsg'=>$houseMsg,'imgArr'=>$imgArr]);
	}

	/**
	 *房源检索 + 列表
	 */
	public function houseLister()
	{
		$search_k = Input::get('search_k') ? Input::get('search_k') : '%';
		$search_v = Input::get('search_v') ? Input::get('search_v') : '%';
		$type = Input::get('type') ? Input::get('type') : '%';
/*		$serial_number = Input::get('serial_number') ? Input::get('serial_number') : '%';
		$house_structure = Input::get('house_structure') ? Input::get('house_structure') : '%';
		$house_price = Input::get('house_price') ? Input::get('house_price') : '%';
		$house_location = Input::get('house_location') ? Input::get('house_location') : '%';
		$house_keyword = Input::get('house_keyword') ? Input::get('house_keyword') : '%';*/
		$find = Input::get('find') ? Input::get('find') : '';
		$export = Input::get('export') ? Input::get('export') : '';
		if($find){

			if($search_k != '%' && $search_k != '%'){
				$gather = DB::table('house_message')
						->where('chk_sta','2')
						->where('house_type', 'like', $type)
						->where($search_k,'like','%'.$search_v.'%')
						->orderBy('msgid', 'desc')
						->paginate(10);
			}else{
				$gather = DB::table('house_message')
						->where('chk_sta','2')
						->where('house_type', 'like', $type)
						->orderBy('msgid', 'desc')
						->paginate(10);
			}


/*			$gather = DB::table('house_message')
					->where('chk_sta','2')
					->where('house_type', 'like', $type)
					->where('serial_number', 'like', '%'.$serial_number.'%')
					->where('house_structure', 'like', '%'.$house_structure.'%')
					->where('house_price', 'like', '%'.$house_price.'%')
					->where('house_location', 'like', '%'.$house_location.'%')
					->where('house_keyword', 'like', '%'.$house_keyword.'%')
					->orderBy('msgid', 'desc')
					->paginate(16);*/

			$typeObject = DB::table('house_type')
					->select('name')
					->get();
			$houseCount = DB::table('house_message')
					->where('chk_sta','2')
					->count();
			return view('house.houseLister', [
					'search_k' => $search_k,
					'search_v' => $search_v,
					'houseObj'        => $gather,
					'typeObject'      => $typeObject,
					'houseCount'      => $houseCount,
					'type'            => $type,
/*					'serial_number'   => $serial_number,
					'house_structure' => $house_structure,
					'house_price'     => $house_price,
					'house_location'  => $house_location,
					'house_keyword'   => $house_keyword*/
			]);
		}elseif($export){

			if($search_k != '%' && $search_k != '%')
			{
				$gather = DB::table('house_message')
						->where('chk_sta','2')
						->where('house_type', 'like', $type)
						->where($search_k,'like','%'.$search_v.'%')
						->select('serial_number', 'house_location', 'house_structure', 'house_price', 'house_size', 'house_type', 'house_facility', 'house_rise', 'house_duration', 'house_status', 'state', 'province', 'city', 'rim_message', 'cash_pledge', 'payment_proportion', 'knot_way')
						/*->where('serial_number', 'like', $serial_number)
						->where('house_structure', 'like', $house_structure)
						->where('house_price', 'like', $house_price)
						->where('house_location', 'like', $house_location)
						->where('house_keyword', 'like', $house_keyword)*/
						->orderBy('msgid', 'desc')
						->get()
						->toArray();
			}else{
				$gather = DB::table('house_message')
						->where('chk_sta','2')
						->where('house_type', 'like', $type)
						->select('serial_number', 'house_location', 'house_structure', 'house_price', 'house_size', 'house_type', 'house_facility', 'house_rise', 'house_duration', 'house_status', 'state', 'province', 'city', 'rim_message', 'cash_pledge', 'payment_proportion', 'knot_way')
						->orderBy('msgid', 'desc')
						->get()
						->toArray();
			}


			/*$gather = DB::table('house_message')
					->where('chk_sta','2')
					->where('house_type', 'like', $type)
					->select('serial_number', 'house_location', 'house_structure', 'house_price', 'house_size', 'house_type', 'house_facility', 'house_rise', 'house_duration', 'house_status', 'state', 'province', 'city', 'rim_message', 'cash_pledge', 'payment_proportion', 'knot_way')
					->where('serial_number', 'like', $serial_number)
					->where('house_structure', 'like', $house_structure)
					->where('house_price', 'like', $house_price)
					->where('house_location', 'like', $house_location)
					->where('house_keyword', 'like', $house_keyword)
					->orderBy('msgid', 'desc')
					->get()
					->toArray();*/

			$title = [
					'编号',
					'房源位置',
					'房源结构',
					'房源价格',
					'房源大小/平方',
					'房源类型',
					'房屋设备',
					'起租期',
					'租期时长',
					'状态',
					'国家',
					'省',
					'城市',
					'周边信息',
					'押金',
					'预付款比例',
					'结算方式'
			];
			exportData($title, $gather, '房源信息'.date('Y-m-d'));
		} else{

			$gather = DB::table('house_message')
					->where('chk_sta','2')
					->orderBy('msgid', 'desc')
					->paginate(10);

/*			$gather = DB::table('house_message')
					->where('chk_sta','2')
					->where('house_type', 'like', $type)
					->where('serial_number', 'like', '%'.$serial_number.'%')
					->where('house_structure', 'like', '%'.$house_structure.'%')
					->where('house_price', 'like', '%'.$house_price.'%')
					->where('house_location', 'like', '%'.$house_location.'%')
					->where('house_keyword', 'like', '%'.$house_keyword.'%')
					->orderBy('msgid', 'desc')
					->paginate(16);*/

			$typeObject = DB::table('house_type')
					->select('name')
					->get();
			$houseCount = DB::table('house_message')
					->where('chk_sta','2')
					->count();
			return view('house.houseLister', [
					'search_k' => $search_k,
					'search_v' => $search_v,
					'houseObj'        => $gather,
					'typeObject'      => $typeObject,
					'houseCount'      => $houseCount,
					'type'            => $type,
/*					'serial_number'   => $serial_number,
					'house_structure' => $house_structure,
					'house_price'     => $house_price,
					'house_location'  => $house_location,
					'house_keyword'   => $house_keyword*/
			]);
		}

	}

	/**
	 *导出 Excel
	 */
	public function houseExcel() {
		$data = DB::table('house_message')
				->select()
				->get('serial_number','house_location')
				->toArray();
		$title = [
						'房源ID号',
						'编号',
						'房源位置',
						'房源结构',
						'房源价格',
						'房源大小/平方',
						'房源类型',
						'房屋设备',
						'关键字',
						'房源简介',
						'起租期',
						'租期时长',
						'状态',
						'房东证件号',
						'房源中介ID',
						'国家',
						'省',
						'城市',
						'周边信息',
						'押金',
						'预付款比例',
						'结算方式'
				];
		exportData($title,$data,'房源信息'.date('Y-m-d'));
	}

	/**
	 *地图
	 */
	public function houseMap() {
		return view('house.houseMap');
	}


	/**
	 * 审核房源
	 */
	public function houseCheck()
	{
		//搜索国家框数据
		$nationArr = DB::table('nation')->get();

		$house_keyword = Input::get('house_keyword') ? Input::get('house_keyword') : '%';
		//判断是否接收到搜索值
		if(!empty($_REQUEST['state']) && !empty($_REQUEST['province']) && !empty($_REQUEST['city']))
		{

			$state = explode(',',$_REQUEST['state']);
			$province = explode(',',$_REQUEST['province']);
			$city = explode(',',$_REQUEST['city']);
			//计算房源总数量
			$total = DB::table('house_message')
					->where(function($query){
						$query->where(function ($query){
							$query->where('chk_sta','1')
									->orwhere('chk_sta','3');
						});
					})
					->where('state',$state[0])
					->where('province',$province[0])
					->where('city',$city[0])
					->count();


			//获得房源信息
			$result = DB::table('house_message')
					->where(function($query){
						$query->where(function ($query){
							$query->where('chk_sta','1')
									->orwhere('chk_sta','3');
						});
					})
					->where('state',$state[0])
					->where('province',$province[0])
					->where('city',$city[0])
					->paginate(10);
			//返回结果
			return view('house.houseCheck',['result'=>$result, 'total'=>$total, 'nationArr'=>$nationArr, 'state'=>$_REQUEST['state'], 'province'=>$_REQUEST['province'], 'city'=>$_REQUEST['city']]);
		}else{
			//计算未审核和审核不通过的房源总数量
			$total = DB::table('house_message')
					->where('chk_sta','1')
					->Orwhere('chk_sta','3')
					->count();

			//获得所有房源信息
			$result = DB::table('house_message')
					->where('chk_sta','1')
					->Orwhere('chk_sta','3')
					->paginate(10);

			//返回页面结果
			return view('house.houseCheck',['result'=>$result,'total'=>$total,'nationArr'=>$nationArr,'house_keyword'=>$house_keyword]);
		}

	}

	//审核状态更改
	public function isCheck(){
		if($_GET['chk_sta'] && $_GET['msgid'])
		{
			//接收审核状态
			$chk_sta = $_GET['chk_sta'];
			//接收ID
			$msgid = (int)$_GET['msgid'];
			//数据库更改状态
			$result = DB::table('house_message')->where('msgid',$msgid)->update(['chk_sta'=>$chk_sta]);
			//判断并返回
			if($result){return '1';}else{return '0';}}
	}

	//操作日志
	public function operateLog()
	{
		//判断如果接收到了搜索的时间参数，
		if(!empty($_REQUEST['stime']) && !empty($_REQUEST['etime']))
		{
			//接收开始时间和结束时间，并转化为时间戳
			$stime = strtotime($_REQUEST['stime'].' 00:00:00');
			$etime = strtotime($_REQUEST['etime'].' 23:59:59');
			//查询总条数
			$total = DB::table('operate_log')->whereBetween('operate_time',[$stime,$etime])->count();
			$result = DB::table('operate_log')->whereBetween('operate_time',[$stime,$etime])->orderBy('operate_time', 'desc')->paginate(10);
			return view('house.operateLog',['result'=>$result,'total'=>$total,'stime'=>$_REQUEST['stime'],'etime'=>$_REQUEST['etime'],]);
			exit();
		}else{
			//如果没有接收到时间参数直接显示全部数据
			$total = DB::table('operate_log')->count();
			$result = DB::table('operate_log')->orderBy('operate_time', 'desc')->paginate(10);
			return view('house.operateLog',['result'=>$result,'total'=>$total]);
		}
	}

 }