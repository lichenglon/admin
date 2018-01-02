<?php
namespace App\Http\Controllers\Data_statement;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use DB;
use App\libraries\libs\column;
class DataController extends BaseController{
	public function column() {
		return view('data_statement.column');
	}
	public function line() {
		return view('data_statement.line');
	}
}
