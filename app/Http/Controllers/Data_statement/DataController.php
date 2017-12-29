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
		//$bar = new Bar(500, 300, array(600, 300, 30, 500, 400, 250, 350, 360), array('AAAAA', 'BBBBB', 'CCCCC', 'DDDDD', 'EEEEEE', 'FFFFFF', 'GGGGGGG', 'HHHHHHHHH'));
		//$bar->setTitle('打造完美柱状图!');
		//$bar->stroke();
		return view('data_statement.column');
	}
}
