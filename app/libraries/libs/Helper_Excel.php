<?php

abstract class Helper_Excel{
	/**
	 * 导出excel并下载
	 * @param array $data 数据
	 * @param array $header 头部
	 * @return mixed
	 */
	public static function export($data, $header){
		$excel = new PHPExcel();
		$excel->getProperties()->setCreator("Huashi Hengtong")->setLastModifiedBy("Huashi Hengtong")->setTitle("Huashi Hengtong ERP Export File")->setSubject("Huashi Hengtong ERP Export File")->setDescription("Huashi Hengtong ERP Export File")->setCategory("Huashi Hengtong Excel File");

		$sheet = $excel->setActiveSheetIndex(0);
		//设置头部
		foreach($header as $key => $head_name){
			$cell = self::getCell($key+1, 1);
			$sheet->setCellValue($cell, $head_name);
		}
		//设置数据
		foreach($data as $j => $row){
			foreach($row as $x => $val){
				$cell = self::getCell($x+1, $j+2);
				if(is_numeric($val) && strlen($val.'')>8){
					$val =" ".$val;
				}
				$sheet->setCellValue($cell, $val);
				$sheet->getStyle($cell)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
			}
		}
		$sheet->setTitle("Sheet1");

		$file_path = Q::ini("app_config/ROOT_DIR")."/tmp/export/".date("Y/m/d/");
		Helper_FileSys::mkdirs($file_path);
		$filename = time().".xlsx";
		$writer = PHPExcel_IOFactory::createWriter($excel, "Excel2007");
		$writer->save($file_path.$filename);
		return $file_path.$filename;
	}

	/**
	 * @param $data
	 */
	public static function exportTxt($data){
		// Collapse the $text array down into a normal string, with one element per line
		$output = implode(PHP_EOL, $data);
		$filename = date('YmdHis').'.txt';
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Cache-Control: private",false);
		header("Content-Transfer-Encoding: binary;\n");
		header("Content-Disposition: attachment; filename=\"{$filename}\";\n");
		header("Content-Type: application/force-download");
		header("Content-Type: application/octet-stream");
		header("Content-Type: application/download");
		header("Content-Description: File Transfer");
		header("Content-Length: ".strlen($output).";\n");
		echo $output;
		exit;
	}

	public static function exportCSV($data, $header, $title){
		header('Content-Type: application/csv');
		header('Content-Disposition: attachment; filename='.$title);
		$fp = fopen('php://output', 'a');

		// 输出Excel列名信息
		$head = null;
		foreach($header as $i => $v){
			$head[$i] = iconv('utf-8', 'gbk', $v);
		}
		fputcsv($fp, $head);

		// 计数器
		$cnt = 0;

		// 每隔$limit行，刷新一下输出buffer，不要太大，也不要太小
		$limit = 1000;

		// 逐行取出数据，不浪费内存
		$count = count($data);

		for($t = 0; $t<$count; $t++){
			$cnt++;
			if($limit == $cnt){ //刷新一下输出buffer，防止由于数据过多造成问题
				ob_flush();
				flush();
				$cnt = 0;
			}
			$row = $data[$t];
			foreach($row as $i => $v){
				if(is_numeric($v) && strlen($v.'')>8){
					$v =" ".$v;
				}
				$row[$i] = iconv('utf-8', 'gbk', $v);
			}
			fputcsv($fp, $row);
			unset($row);
		}
		return true;
	}

	/**
	 * @var resource 分块输出文件句柄
	 */
	private static $_csv_chunk_fp;

	/**
	 * 分块输出CSV文件。
	 * 该方法会记录上次调用文件句柄，因此仅允许单个进程执行单个输出。
	 * @param $data
	 * @param $header
	 * @param $title
	 * @return bool
	 */
	public static function exportCSVChunk($data, $header, $title){
		if(!self::$_csv_chunk_fp){
			header('Content-Type: application/csv');
			header('Content-Disposition: attachment; filename='.$title);
			self::$_csv_chunk_fp = fopen('php://output', 'a');
			$head = null;
			foreach($header as $i => $v){
				$head[$i] = iconv('utf-8', 'gbk', $v);
			}
			fputcsv(self::$_csv_chunk_fp, $head);
		}

		$cnt = 0;   // 计数器
		$limit = 1000;  // 每隔$limit行，刷新一下输出buffer，不要太大，也不要太小
		$count = count($data);  // 逐行取出数据，不浪费内存

		for($t = 0; $t<$count; $t++){
			$cnt++;
			if($limit == $cnt){ //刷新一下输出buffer，防止由于数据过多造成问题
				ob_flush();
				flush();
				$cnt = 0;
			}
			$row = $data[$t];
			foreach($row as $i => $v){
				$row[$i] = mb_convert_encoding($v, 'gbk', 'utf-8');
			}
			fputcsv(self::$_csv_chunk_fp, $row);
			unset($row);
		}
		return true;
	}

	/**
	 * @param $data
	 * @param array $fields
	 * @return mixed
	 */
	public static function exportByFields($data, array $fields){
		$ret = array();
		foreach($data as $item){
			$sub = array();
			foreach($fields as $field => $name){
				$sub[] = $item[$field];
			}
			$ret[] = $sub;
		}
		return self::export($ret, array_values($fields));
	}

	/**
	 * 取得$i列,$j行的对应单元格,如A1,B2,AA1,CC3
	 * cell(1,1) ==> A1 为了容易理解这里从1开始
	 * @param int $i 对应的列数 从第0格开始
	 * @param int $j 对应的行数 从第0行开始
	 * @return string
	 * @throws Exception $e
	 */
	static public function getCell($i = 1, $j = 1){
		if($i == 0 || $j == 0){
			throw new Exception("Excel Cell Begin from 1");
		}
		if($i>26){
			$num1 = floor(($i-1)/26)+64;
			$num2 = ceil(($i-1)%26)+65;
			$num = chr($num1).chr($num2);
		} else{
			$num = chr(64+$i);
		}
		return $num.$j;
	}

	/**
	 * 解析一个Excel文件成为数组
	 * @param $file
	 * @param int $sheet
	 * @return array
	 * @throws \Exception
	 * @throws \PHPExcel_Exception
	 * @throws \PHPExcel_Reader_Exception
	 */
	static public function parse($file, $sheet = 0){
		if(!$file || !is_file($file)){
			throw new Exception("文件不存在");
		}
		$PHPReader = new PHPExcel_Reader_Excel2007();
		if(!$PHPReader->canRead($file)){
			$PHPReader = new PHPExcel_Reader_Excel5();
			if(!$PHPReader->canRead($file)){
				throw new Exception("Excel文件读取失败：".$file);
			}
		}
		$PHPExcel = $PHPReader->load($file);
		if(is_int($sheet)){
			$currentSheet = $PHPExcel->getSheet($sheet);
		} else{
			$currentSheet = $PHPExcel->getSheetByName($sheet);
		}

		if(!$currentSheet){
			throw new Exception("无效的Sheet");
		}
		$keyArr = "A B C D E F G H I J K L M N O P Q R S T U V W X Y Z AA AB AC AD AE AF AG AH AI AJ AK AL AM AN AO AP AQ AR AS AT AU AV AW AX AY AZ BA BB BC BD BE BF BG BH BI BJ BK BL BM BN BO BP BQ BR BS BT BU BV BW BX BY BZ CA CB CC CD CE CF CG CH CI CJ CK CL CM CN CO CP CQ CR CS CT CU CV CW CX CY CZ";
		$keyArr = explode(' ', $keyArr);
		$lastColumn = $keyArr[count($keyArr)-1];
		$keyArrFlip = array_flip($keyArr);
		/**取得一共有多少列*/
		$maxColumn = $currentSheet->getHighestColumn();
		$maxColumn = $keyArrFlip[$maxColumn] ?$maxColumn: $lastColumn;
		/**取得一共有多少行*/
		$rowCount = $currentSheet->getHighestRow();
		if ($rowCount > 10000) {
			throw new Exception('最大上传行数为1万行，请注意上传文件的末尾是否有空白行');
		}
		$result = array();
		for($row = 1; $row<=$rowCount; $row++){
			$totalLen = 0; //记录行总长度
			for($column = $keyArrFlip['A']; $column<=$keyArrFlip[$maxColumn]; $column++){
				$value = $currentSheet->getCell($keyArr[$column].$row)->getValue();
				if(is_object($value)){
					$value = $value->__toString();
				}
				$result[$row][] = $value;
				$totalLen += strlen(trim($value));
			}
			if($totalLen == 0)
				unset($result[$row]); //去掉空行
		}
		return array_values($result);
	}

	/**
	 * 读取上传的excel文件
	 * @param $name
	 * @param $file
	 * @param int $sheet
	 * @return array
	 * @throws \Exception
	 */
	public static function parseUploadFile($name, $file,$sheet = 0, $ignoreTitle = 0){
		$pathinfo = pathinfo($name);
		if(isset($pathinfo["extension"]) && in_array($pathinfo["extension"], array("xls", "xlsx",'csv'))){
			$data = self::parse($file, $sheet);
			if($ignoreTitle){
				return $data;
			}
			if(is_array($data)){
				$result = array();
				$columnMap = array();
				foreach($data[0] as $key => $value){
					if(isset($columnMap[$value])){
						$data[0][$key] = $columnMap[$value];
					}
				}
				foreach($data as $key => $value){
					if($key == 0){
						continue;
					}
					foreach($value as $vKey => $vValue){
						if($data[0][$vKey] == "")
							continue;
						$result[$key][$data[0][$vKey]] = trim($vValue);
					}
				}
				return $result;
			} else{
				return $data;
			}
		} else{
			throw new Exception(Temtop\t("文件格式错误，请上传xls/xlsx/csv格式文件",null,'temtop'));
		}
	}
}