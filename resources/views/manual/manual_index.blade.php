@extends('layouts.default')

@section('css')
	<style>
		.h4_inline-block{
			display:inline-block;
			/*text-indent:10em;*/
			/*text-align:center;*/
		}
		.h3_align_center{
			/*text-align:center;*/
			/*text-indent:10em;*/
		 }
		.div_auto{
			margin:auto;
			/*border:1px red solid;*/
			width:51%;
			text-align:left;
		}
	</style>
@stop

@section('content')

<div class="box">
	<div class="box-body">
		<div>
<div style="text-align:center">
			<h3 class="h3_align_center">账户管理</h3>
			<div class="div_auto">
				<h4 class="h4_inline-block">账户搜索：</h4>
				<span>您可以通过选择和填写 <font color="green">用户账号||启用状态||关键词</font> 来搜索您要找的内容</span>
			</div>
			<div class="div_auto">
				<h4 class="h4_inline-block">新增用户：</h4>
				<span>您可以通过点击新增账号填写 <font color="green">姓名&账户&密码&联系方式&区域&状态&角色</font> 来创建用户登陆后台管理</span>
			</div>
			<div class="div_auto">
				<h4 class="h4_inline-block">账户列表：</h4>
				<span>您可以通过操作 <font color="green">停用||编辑||删除</font> 来改变用户的状态，账户信息，删除用户</span>
			</div>



			<h3 class="h3_align_center">角色列表</h3>
			<div class="div_auto">
				<h4 class="h4_inline-block">新增角色：</h4>
				<span>您可以通过新增角色 <font color="green">角色名称&上一级角色&角色状态&功能权限</font> 来创建一个角色</span>
			</div>
			<div class="div_auto">
				<h4 class="h4_inline-block">角色列表：</h4>
				<span>您可以通过操作 <font color="green">停用||编辑||删除</font> 来改变角色的状态，角色权限，删除角色</span>
			</div>



			<h3 class="h3_align_center" style="color:red">菜单列表</h3>
			<div class="div_auto">
				<h4 class="h4_inline-block">全部折叠：</h4>
				<span>您可以点击 <font color="green">全部折叠</font> 来收起菜单</span>
			</div>
			<div class="div_auto">
				<h4 class="h4_inline-block">全部打开：</h4>
				<span>您可以点击 <font color="green">全部打开</font> 来展开菜单</span>
			</div>
			<div class="div_auto">
				<h4 class="h4_inline-block" style="color:red">添加菜单：</h4>
				<span>通过 <font color="red">添加菜单</font> 来显示到侧边栏上  <font color="red">警告：非管理员或程序员请勿擅自操作此功能，一旦更改会导致程序的部分运行</font></span>
			</div>
			<div class="div_auto">
				<h4 class="h4_inline-block" style="color:red">菜单列表：</h4>
				<span>通过 <font color="red">排序||名称||URL||删除</font> 修改排序，名称，URL，删除菜单  <font color="red">警告：非管理员或程序员请勿擅自操作此功能，一旦更改会导致程序的部分运行</font></span>
			</div>



			<h3 class="h3_align_center">房源管理</h3>
			<h4 class="h3_align_center">房源类型</h4>
			<div class="div_auto">
				<h4 class="h4_inline-block">房源类型：</h4>
				<span>您可以点击 <font color="green">全部折叠</font> 来收起菜单</span>
			</div>
			<div class="div_auto">
				<h4 class="h4_inline-block">全部打开：</h4>
				<span>您可以点击 <font color="green">全部打开</font> 来展开菜单</span>
			</div>
			<div class="div_auto">
				<h4 class="h4_inline-block">添加类型：</h4>
				<span>您可以通过填写 <font color="green">分类名称</font> 添加成功后可进行房源信息添加时可做更多的类型选择 </span>
			</div>
			<div class="div_auto">
				<h4 class="h4_inline-block">分类列表：</h4>
				<span>通过 <font color="green">排序||名称||删除</font> 修改排序，名称，删除分类名称</span>
			</div>

			<h4 class="h3_align_center">房源添加</h4>
			<div class="div_auto">
				<h4 class="h4_inline-block">房源添加：</h4>
				<span>
					<font color="green">房源类型</font>选择项&nbsp;&nbsp;&nbsp;&nbsp;
					<font color="green">国家城市</font>选择项&nbsp;&nbsp;&nbsp;&nbsp;
					<font color="green">详细位置</font>必填项填写房源的具体位置&nbsp;&nbsp;&nbsp;&nbsp;
					<font color="green">房源结构</font>必填项填写房源的大小比如一房一厅&nbsp;&nbsp;&nbsp;&nbsp;
					<font color="green">周边信息</font>选填项当您勾选后可在input框设置步行到达时间&nbsp;&nbsp;&nbsp;&nbsp;
					<font color="green">房源价格</font>必须项只能填写数字/单位/元&nbsp;&nbsp;&nbsp;&nbsp;
					<font color="green">房源大小</font>必须项只能填写数字/单位/平方 英尺&nbsp;&nbsp;&nbsp;&nbsp;
					<font color="green">押金</font>必须项只能填写数字/单位/元&nbsp;&nbsp;&nbsp;&nbsp;
					<font color="green">预付款比例</font>选择项&nbsp;&nbsp;&nbsp;&nbsp;
					<font color="green">结算方式</font>选择项&nbsp;&nbsp;&nbsp;&nbsp;
					<font color="green">房源设备</font>勾选项&nbsp;&nbsp;&nbsp;&nbsp;
					<font color="green">关键字</font>必填项用做您的房源检索方式&nbsp;&nbsp;&nbsp;&nbsp;
					<font color="green">房源简介</font>必填项作为平台的房源简介展示&nbsp;&nbsp;&nbsp;&nbsp;
					<font color="green">起租期&最长租期</font>点击选择日期&nbsp;&nbsp;&nbsp;&nbsp;
					<font color="green">房源状态</font>单选&nbsp;&nbsp;&nbsp;&nbsp;
					<font color="green">房东姓名</font>必填项填写房源房东的姓名&nbsp;&nbsp;&nbsp;&nbsp;
					<font color="green">房东证件号</font>必填项房源房东的证件号&nbsp;&nbsp;&nbsp;&nbsp;
					<font color="green">房东邮箱</font>可不填房东的邮箱号&nbsp;&nbsp;&nbsp;&nbsp;
					<font color="green">房东电话</font>必填项房东的联系电话号码&nbsp;&nbsp;&nbsp;&nbsp;
					<font color="green">房东性别</font>单选&nbsp;&nbsp;&nbsp;&nbsp;
					<font color="green">房东联系地址</font>房东的住址联系地址&nbsp;&nbsp;&nbsp;&nbsp;
					<font color="green">房东备注</font>房东的备注例如外出不在家等说明&nbsp;&nbsp;&nbsp;&nbsp;
					<font color="green">图片上传</font>房源的图片
				</span>
			</div>
			<h4 class="h3_align_center">房源列表</h4>
			<div class="div_auto">
				<h4 class="h4_inline-block">房源检索：</h4>
				<span>通过检索 <font color="green">分类||房源编号||房源结构||房源关键字</font> 来搜索您要找的房源信息</span>
			</div>
			<div class="div_auto">
				<h4 class="h4_inline-block">导出Excel：</h4>
				<span>通过检索框 <font color="green">分类||房源编号||房源结构||房源关键字</font> 找到您要的房源信息来导出Excel</span>
			</div>
			<div class="div_auto">
				<h4 class="h4_inline-block">房源位置：</h4>
				<span>点击 <font color="green">房源位置</font> 查看房源所在位置</span>
			</div>
			<div class="div_auto">
				<h4 class="h4_inline-block">查看详细信息：</h4>
				<span>通过操作 <font color="green">查看详细信息</font> 来查看房源的详细信息</span>
			</div>
			<h4 class="h3_align_center">更新房源</h4>
			<div class="div_auto">
				<h4 class="h4_inline-block">更新检索：</h4>
				<span>通过检索 <font color="green">分类||房源编号||房源结构||房源关键字</font> 来搜索您要找的房源信息</span>
			</div>
			<div class="div_auto">
				<h4 class="h4_inline-block">更新房源导出Excel：</h4>
				<span>通过检索框 <font color="green">分类||房源编号||房源结构||房源关键字</font> 找到您要的房源信息来导出Excel来备份或更新</span>
			</div>
			<div class="div_auto">
				<h4 class="h4_inline-block">房源位置：</h4>
				<span>点击 <font color="green">房源位置</font> 查看房源所在位置</span>
			</div>
			<div class="div_auto">
				<h4 class="h4_inline-block">更新房源：</h4>
				<span>点击 <font color="green">更新房源</font> 更新您要更新的房源信息包括一下房源信息状态值等</span>
			</div>


			<h3 class="h3_align_center">数据报表</h3>
			<div class="div_auto">
				<h4 class="h4_inline-block">销售增长率：</h4>
				<span>您可以点击右上角 <font color="green">打印图表&下载PNG图像&下载JPEG图像&下载PDF文件&下载SVG矢量图片</font> 来下载您要得到的信息</span>
			</div>
</div>
		</div>
	</div>
</div>

@stop

@section('js')


@stop


