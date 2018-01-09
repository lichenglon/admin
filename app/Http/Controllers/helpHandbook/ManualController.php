<?php

namespace App\Http\Controllers\helpHandbook;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;
class ManualController extends BaseController {
	/**
	 *帮助手册页面
	 */
	public function help() {
		return view('manual.manual_index');
	}
}