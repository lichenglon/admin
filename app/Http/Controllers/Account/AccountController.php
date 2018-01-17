<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\BaseController;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
class AccountController extends BaseController
{
    public $account_status = ['禁用','启用'];

    private $account;

    public function __construct(){
        parent::__construct();
        $this->account = new Account;
    }

    public function index(Request $request){
        $where = [];
        if(isset($request->search)){

            //判断权限
            if(!empty($request->role_id)){
                $where['role_id'] = $request->role_id;
            }
            //判断登陆状态
            if($request->status != ''){
                $where['status'] = $request->status;
            }
            //判断搜索关键字
            if(!empty($request->keyword)){
                $where[] = [$request->keyword_type,'LIKE', '%'.$request->keyword.'%' ];;
            }
        }
        $account_lists = Account::where($where)->orderBy('id')->paginate(10);

        foreach($account_lists as &$value){
            $value->parse_role_id = DB::table('roles')->where('id',$value->role_id)->value('name');
            $value->parse_status = isset($this->account_status[$value->status]) ? $this->account_status[$value->status] : '未知';
        }
        $roleList = $this->getSelectList('roles');
        return view('account.account_index', ['account_lists' => $account_lists, 'roleList'=>$roleList]);
    }

    //添加用户
    public function create(){

        $roles = Account::where('status',1)->get(['id','name']);
        $departmentList = $this->getSelectList('departments');
        $roleList = $this->getSelectList('roles');
        $nationArr = DB::table('nation')->get();
        return view('account.account_create', ['roles'=>$roles, 'departmentList'=>$departmentList,'roleList'=>$roleList,'nationArr'=>$nationArr]);
    }

    public function store(Request $request){
        //国家
       /* $state = explode(',',$request->state);
        $province =explode(',',$request->province);
        //城市
        $city = explode(',',$request->city);*/
        $data = [
            'name' => $request->name,
            'username' => $request->username,
            'tel' => $request->tel,
            'area' => $request->area,
            'passwd' => md5($request->passwd),
            'status' => $request->status,
            'role_id' => $request->role_id,
            'create_time' => time(),
            'update_time' => time(),
            'state'       => '',
            'en_state'    => '',
            'province'    => '',
            'en_province' => '',
            'city'        => '',
            'en_city'     => '',
        ];
        $rs = Account::insert($data);
        if($rs){

            //更新操作日志
            $id = Session::get('user_id');

            $operate_name = DB::table('accounts')->where('id',$id)->value('name');
            $operate = "add a new account , is ".$request->name;
            //$operate = "新增了用户，账号为：".$request->name;
            $operate_log = [
                'operate' => $operate,
                'operate_name' => $operate_name,
                'operate_time' => time()
            ];

            DB::table('operate_log')->insert($operate_log);


            return $this->ajaxSuccess('新增账号成功！', url('/account/user'));
        }else{
            return $this->ajaxSuccess('新增账号失败！', url('/account/user/create'));
        }
    }

    public function edit($id){
        $lists = Account::find($id);
        $roleList = $this->getSelectList('roles');
        return view('account.account_edit',['lists'=>$lists, 'roleList'=>$roleList]);
    }

    public function update(Request $request){
        $data['passwd'] = md5($request->password);
        $data['name'] = $request->name;
        $data['username'] = $request->username;
        $data['status'] = $request->status;
        $data['role_id'] = $request->role_id;
        $data['tel'] = $request->tel;
        $data['area'] = $request->area;
        $data['passwd'] = md5($request->password);
        $data['update_time'] = time();
        Account::where('id', $request->id)
            ->update($data);


        //更新操作日志
        $id = Session::get('user_id');
        $operate_name = DB::table('accounts')->where('id',$id)->value('name');
        $operate = "modify a account's information , is ".$request->name;
        //$operate = "更新了用户，账号为:".$request->name;
        $operate_log = [
            'operate' => $operate,
            'operate_name' => $operate_name,
            'operate_time' => time()
        ];
        DB::table('operate_log')->insert($operate_log);

        return $this->ajaxSuccess('编辑账号成功！', url('/account/user'));

    }

    public function updateStatus(Request $request){

        if($request->id == session('user_id')){
            return $this->ajaxError('不允许操作当前登录用户！');
        }
        if($request->id == '1'){
            return $this->ajaxError('不允许修改管理员！');
        }
        $data['status'] = !$request->status;

        $rs = Account::where('id', $request->id)
            ->update($data);
        if($rs){

            //更新操作日志
            $id = Session::get('user_id');
            $operate_name = DB::table('accounts')->where('id',$id)->value('name');
            $account = DB::table('accounts')->where('id',$request->id)->value('name');
            $operate = "modify a account's status , is ".$request->name;
            //$operate = "更新了用户状态，账号为：".$account;
            $operate_log = [
                'operate' => $operate,
                'operate_name' => $operate_name,
                'operate_time' => time()
            ];

            DB::table('operate_log')->insert($operate_log);

            return $this->ajaxSuccess('操作成功！', url('/account/user'));
        }
        return $this->ajaxError('操作失败！', url('/account/user'));
    }

    public function destroy($id){

        $account = DB::table('accounts')->where('id',$id)->value('name');

        if($id == '1'){
            return $this->ajaxError('不能删除管理员！', url('/account/user'));
        }

        $rs = Account::destroy($id);
        if($rs){

            //更新操作日志
            $uid = Session::get('user_id');
            $operate_name = DB::table('accounts')->where('id',$uid)->value('name');
            $operate = "delete a account , is   ".$account;
            //$operate = "删除了账号，账号为：".$account;
            $operate_log = [
                'operate' => $operate,
                'operate_name' => $operate_name,
                'operate_time' => time()
            ];

            DB::table('operate_log')->insert($operate_log);

            return $this->ajaxSuccess('删除账号成功！', url('/account/user'));
        }
        return $this->ajaxError('删除账号失败！', url('/account/user'));
    }

}
