@extends('layouts.default')
<meta charset="utf-8">

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('house/css/H-ui.min.css')}}" />
    <style type="text/css">
        .dept_select{min-width: 200px;}
        .shade {
            position: absolute;
            display: none;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background: rgba(0, 0, 0, 0.55);
        }

        .shade div {
            width: 300px;
            height: 200px;
            line-height: 200px;
            position: absolute;
            top: 50%;
            left: 50%;
            margin-top: -100px;
            margin-left: -150px;
            background: white;
            border-radius: 5px;
            text-align: center;
        }

        .a-upload {
            padding: 4px 10px;
            height: 20px;
            line-height: 20px;
            position: relative;
            cursor: pointer;
            color: #888;
            background: #fafafa;
            border: 1px solid #ddd;
            border-radius: 4px;
            overflow: hidden;
            display: inline-block;
            *display: inline;
            *zoom: 1
        }

        .a-upload input {
            position: absolute;
            font-size: 100px;
            right: 0;
            top: 0;
            opacity: 0;
            filter: alpha(opacity=0);
            cursor: pointer
        }

        .a-upload:hover {
            color: #444;
            background: #eee;
            border-color: #ccc;
            text-decoration: none
        }
        .img_div{min-height: 100px; min-width: 100px;}
        .isImg{width: 120px; height: 120px; position: relative; float: left; margin-left: 10px;}
        .removeBtn{position: absolute; top: 0; right: 0; z-index: 11; border: 0px; border-radius: 50px; background: red; width: 22px; height: 22px; color: white;}
        .shadeImg{position: absolute;
            display: none;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 15;
            text-align: center;
            background: rgba(0, 0, 0, 0.55);}
        .showImg{width: 400px; height: 500px; margin-top: 140px;}

    </style>

@stop

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
            <a href="{{url('house/houseLister')}}">点击前往列表查看</a>
        </div>
    @endif

    <div class="box">
        <div class="box-body">


            <div class="page-container">
                <form action="{{url('house/houseAdd/save')}}" method="post" id="SUBMIT" class="form form-horizontal" id="form-article-add" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>@lang('house_translate.Housing_types')：</label>
                        <div class="formControls col-xs-8 col-sm-9" style="width:45%;">
                            <span class="select-box">
				                <select name="house_type" class="select">
                                    {!! $optionStr !!}
                                </select>
				            </span>
                        </div>
                    </div>

                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>@lang('house_translate.National_city')：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <select id="country" class="dept_select"  name="state">
                                @foreach($nationArr as $nation)
                                    <option value="{{$nation->chinese_n_name}},{{$nation->english_n_name}},{{$nation->abbreviation}},{{$nation->n_ID}}">{{$nation->chinese_n_name}}&nbsp;&nbsp;&nbsp;{{$nation->english_n_name}}</option>
                                @endforeach
                            </select>
                            <select id="province" class="dept_select"  name="province">

                            </select>
                            <select id="city" class="dept_select" name="city">

                            </select>
                        </div>
                    </div>

                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>@lang('house_translate.Housing_name')：</label>
                        <div class="formControls col-xs-8 col-sm-9" style="width:45%;">
                            <input type="text" class="input-text" value="" placeholder="房源名称" required maxlength="3000" id="house_location" name="house_name" >
                        </div>
                        <span id="house_locationMsg"></span>
                    </div>

                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>@lang('house_translate.Detailed_location')：</label>
                        <div class="formControls col-xs-8 col-sm-9" style="width:45%;">
                            <input type="text" class="input-text" value="" placeholder="南山区泰邦科技大厦2308" required maxlength="3000" id="house_location" name="house_location" >
                        </div>
                        <span id="house_locationMsg"></span>
                    </div>

                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>@lang('house_translate.Housing_structure')：</label>
                        <div class="formControls col-xs-8 col-sm-9" style="width:45%;">
                            <input type="number" name="room"  max="100" min="0" value="1" class="input-text"> @lang('house_translate.room')
                            <input type="number" name="hall"  max="100" min="0" value="1" class="input-text"> @lang('house_translate.hall')
                            <input type="number" name="kitchen"  max="100" min="0" value="0" class="input-text"> @lang('house_translate.kitchen')
                            <input type="number" name="toilet"  max="100" min="0" value="0" class="input-text"> @lang('house_translate.toilet')
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2">@lang('house_translate.surrounding_information')：</label>
                        <div class="formControls col-xs-8 col-sm-9"  style="width:45%;">
                            <div class="check-box">
                                <input name="peripheral_information[]" value='超市' type="checkbox" class="date_checkbox" id="peripheral-1">
                                <label for="peripheral-1">@lang('house_translate.supermarket')</label>
                                <input type="number" name="" id="supermarket" disabled="disabled" placeholder="" value="" min="0" max="300" class="input-text information">/@lang('house_translate.Minute')
                            </div>
                            <div class="check-box">
                                <input name="peripheral_information[]" value='中餐馆' type="checkbox" class="date_checkbox" id="peripheral-2">
                                <label for="peripheral-2">@lang('house_translate.Chinese_restaurant')</label>&nbsp;
                                <input type="number" name="" id="cr" disabled="disabled" placeholder="" value="" min="0" max="300" class="input-text information">/@lang('house_translate.Minute')
                            </div>
                            <br>
                            <div class="check-box">
                                <input name="peripheral_information[]" value='警局' type="checkbox" class="date_checkbox" id="peripheral-3">
                                <label for="peripheral-3">@lang('house_translate.The_police_station')</label>
                                <input type="number" name="" id="cr" disabled="disabled" placeholder="" value="" min="0" max="300" class="input-text information">/@lang('house_translate.Minute')
                            </div>
                            <div class="check-box">
                                <input name="peripheral_information[]" value='公共交通' type="checkbox" class="date_checkbox" id="peripheral-4">
                                <label for="peripheral-4">@lang('house_translate.Public_transport')</label>
                                <input type="number" name="" id="cr" disabled="disabled" placeholder="" value="" min="0" max="300" class="input-text information">/@lang('house_translate.Minute')
                            </div>
                        </div>
                    </div>


                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>@lang('house_translate.Housing_prices')：</label>
                        <div class="formControls col-xs-8 col-sm-9"  style="width:45%;">
                            <input type="number" name="house_price" id="house_price" placeholder="" value=""  min="1" class="input-text" style="width:69%;">
                            <select name="price_currency" id="price_currency" class="input-text" style="width:20%;">
                                <option value="英镑,The pound">@lang('house_translate.The_pound')</option>
                                <option value="美元,The dollar">@lang('house_translate.The_dollar')</option>
                                <option value="人民币,The yuan">@lang('house_translate.The_yuan')</option>
                            </select>
                        </div>
                        <span id="house_priceMsg"></span>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>@lang('house_translate.Housing_size')：</label>
                        <div class="formControls col-xs-8 col-sm-9"  style="width:45%;">
                            <input type="number" name="house_size" id="house_size" placeholder="" value="20"  min="1" class="input-text" style="width:90%;"> /@lang('house_translate.Square_meters')
                        </div>
                        <span id="house_sizeMsg"></span>
                    </div>

                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>@lang('house_translate.deposit')：</label>
                        <div class="formControls col-xs-8 col-sm-9"  style="width:45%;">
                            <input type="number" name="cash_pledge" id="cash_pledge" placeholder="" value=""  min="1" class="input-text" style="width:69%;">
                            <select name="deposit_currency" id="deposit_currency" class="input-text" style="width:20%;">
                                <option value="英镑,The pound">@lang('house_translate.The_pound')</option>
                                <option value="美元,The dollar">@lang('house_translate.The_dollar')</option>
                                <option value="人民币,The yuan">@lang('house_translate.The_yuan')</option>
                            </select>
                        </div>
                        <span id="cash_pledgeMsg"></span>
                    </div>

                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>@lang('house_translate.Prepayment_ratio')：</label>
                            <div class="formControls col-xs-8 col-sm-9" style="width:45%;">
                                @lang('house_translate.and') <input type="number" name="and" max="100" min="0" value="1" class="input-text">
                                @lang('house_translate.pay') <input type="number" name="pay" max="100" min="0" value="1" class="input-text">
                            </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>@lang('house_translate.The_method_of_payment')：</label>
                        <div class="formControls col-xs-8 col-sm-9" style="width:45%;">
                            <span class="select-box">
				                <select name="knot_way" class="select">
                                    <option value="月结">@lang('house_translate.Monthly')</option>
                                    <option value="季结">@lang('house_translate.Quarterly_settlement')</option>
                                    <option value="周结">@lang('house_translate.Weeks')</option>
                                </select>
				            </span>
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2">@lang('house_translate.House_equipment')：</label>
                        <div class="formControls col-xs-8 col-sm-9 skin-minimal">
                            <div class="check-box">
                                <input name="house_facility[]" value='洗衣机' type="checkbox" id="checkbox-1">
                                <label for="checkbox-1">@lang('house_translate.Washing_machine')</label>
                            </div>
                            <div class="check-box">
                                <input name="house_facility[]" value='空调' type="checkbox" id="checkbox-2">
                                <label for="checkbox-2">@lang('house_translate.Air_conditioning')</label>
                            </div>
                            <div class="check-box">
                                <input name="house_facility[]" value='暖气' type="checkbox" id="checkbox-3">
                                <label for="checkbox-3">@lang('house_translate.The_heating')</label>
                            </div>
                            <div class="check-box">
                                <input name="house_facility[]" value='床' type="checkbox" id="checkbox-4">
                                <label for="checkbox-4">@lang('house_translate.The_bed')</label>
                            </div>@if(Session::get('lang') == 'en')<br>@endif
                            <div class="check-box">
                                <input name="house_facility[]" value='厨房' type="checkbox" id="checkbox-5">
                                <label for="checkbox-5">@lang('house_translate.The_kitchen')</label>
                            </div>
                            <div class="check-box">
                                <input name="house_facility[]" value='衣柜' type="checkbox" id="checkbox-6">
                                <label for="checkbox-6">@lang('house_translate.The_wardrobe')</label>
                            </div>
                            <div class="check-box">
                                <input name="house_facility[]" value='冰箱' type="checkbox" id="checkbox-7">
                                <label for="checkbox-7">@lang('house_translate.The_refrigerator')</label>
                            </div>
                        </div>
                    </div>

                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>@lang('house_translate.Introduction_of_housing')：</label>
                        <div class="formControls col-xs-8 col-sm-9" style="width:45%;">
                            <textarea name="house_brief" id="house_brief" cols="" rows="" class="textarea"  placeholder=""></textarea>
                        </div>
                        <span id="house_briefMsg"></span>
                    </div>

                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2">@lang('house_translate.The_lease_period')：</label>
                        <div class="formControls col-xs-8 col-sm-9 skin-minimal">
                            <div class="check-box">
                                <input type="text" name="house_rise" id="house_rise" placeholder="" value="" class="input-text" style="display:inline-block">
                            </div>
                            <span>@lang('house_translate.The_longest_leases')</span>
                            <div class="check-box" style="width:27%;">
                                <input type="number" min="0" max="1000000" value="1" name="house_duration" class="input-text Wdate" style="width:40%;"> /@lang('house_translate.Weeks2')
                            </div>
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2">@lang('house_translate.Home_state')：</label>
                        <div class="formControls col-xs-8 col-sm-9 skin-minimal">

                            <div class="check-box">
                                <input name="house_status" value="预租" checked="true" type="radio" id="radio-1">
                                <label for="radio-1">@lang('house_translate.Rent_in_advance')</label>
                            </div>
                            <div class="check-box">
                                <input name="house_status" value="已锁定" type="radio" id="radio-2">
                                <label for="radio-2">@lang('house_translate.Has_been_locked')</label>
                            </div>
                            <div class="check-box">
                                <input name="house_status" value="已出租" type="radio" id="radio-4">
                                <label for="radio-4">@lang('house_translate.Have_been_leased')</label>
                            </div>@if(Session::get('lang') == 'en')<br>@endif
                            <div class="check-box">
                                <input name="house_status" value="配置中" type="radio" id="radio-5">
                                <label for="radio-5">@lang('house_translate.In_the_configuration')</label>
                            </div>
                            <div class="check-box">
                                <input name="house_status" value="冻结" type="radio" id="radio-7">
                                <label for="radio-7">@lang('house_translate.freeze')</label>
                            </div>
                            <div class="check-box">
                                <input name="house_status" value="暂停出租" type="radio" id="radio-8">
                                <label for="radio-8">@lang('house_translate.Suspension_of_rent')</label>
                            </div>

                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>@lang('house_translate.The_landlord_name')：</label>
                        <div class="formControls col-xs-8 col-sm-9" style="width:45%;">
                            <input type="text" name="landlord_name" id="landlord_name" class="input-text Wdate">
                        </div>
                        <span id="landlord_nameMsg"></span>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>@lang('house_translate.Landlord_id_number')：</label>
                        <div class="formControls col-xs-8 col-sm-9" style="width:45%;">
                            <input type="text" name="landlord_identity" id="landlord_identity" class="input-text Wdate">
                        </div>
                        <span id="landlord_identityMsg"></span>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2">@lang('house_translate.The_landlord_email')：</label>
                        <div class="formControls col-xs-8 col-sm-9" style="width:45%;">
                            <input type="text" name="landlord_email" id="landlord_email" class="input-text Wdate">
                        </div>
                        <span id="landlord_emailMsg"></span>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>@lang('house_translate.The_landlord_telephone')：</label>
                        <div class="formControls col-xs-8 col-sm-9" style="width:45%;">
                            <input type="text" name="landlord_phone" id="landlord_phone" class="input-text Wdate">
                        </div>
                        <span id="landlord_phoneMsg"></span>
                    </div>

                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2">@lang('house_translate.The_landlord_gender')：</label>
                        <div class="formControls col-xs-8 col-sm-9 skin-minimal">

                            <div class="check-box">
                                <input name="landlord_sex" value="男" checked="true" type="radio" id="radioTwo-1">
                                <label for="radioTwo-1">@lang('house_translate.boy')</label>
                            </div>
                            <div class="check-box">
                                <input name="landlord_sex" value="女" type="radio" id="radioTwo-2">
                                <label for="radioTwo-2">@lang('house_translate.girl')</label>
                            </div>
                            <div class="check-box">
                                <input name="landlord_sex" value="保密" type="radio" id="radioTwo-3">
                                <label for="radioTwo-3">@lang('house_translate.secrecy')</label>
                            </div>
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>@lang('house_translate.Address_of_landlord')：</label>
                        <div class="formControls col-xs-8 col-sm-9" style="width:45%;">
                            <input type="text" name="landlord_site" id="landlord_site" class="input-text Wdate">
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2">@lang('house_translate.The_landlord_note')：</label>
                        <div class="formControls col-xs-8 col-sm-9" style="width:45%;">
                            <textarea name="landlord_remark" id="landlord_remark" cols="" rows="" class="textarea"  placeholder=""></textarea>
                        </div>
                        <span id="landlord_remarkMsg"></span>
                    </div>


                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2">@lang('house_translate.Choose_picture')：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <a href="javascript:;" class="a-upload" style="width:21%;height:30px;">
                                <input type="file" name="upload[]" id="myFile" multiple="multiple"/><span>@lang('house_translate.Click_here_to_upload_the_file')</span>
                            </a>
                               <div class="img_div"></div>

                                <div class="shade" onclick="javascript:closeShade()">
                                    <div class="">
                                        <span class="text_span"></span>
                                    </div>
                                </div>

                                <div class="shadeImg" onclick="javascript:closeShadeImg()">
                                    <div class="">
                                        <img class="showImg" src=""/>
                                    </div>
                                </div>

                        </div>
                    </div>


                    <div class="row cl">
                        <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                            <button class="btn btn-primary radius" type="button" id="verification">@lang('house_translate.Save_and_submit_the_audit')</button>
                            <a href="javascript:window.history.go(-1);"><button class="btn btn-default radius" type="button">&nbsp;&nbsp;@lang('house_translate.cancel')&nbsp;&nbsp;</button></a>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

    @stop

    @section('js')


        <script>
            //周边信息选填项
            $(function (){
                $(".date_checkbox").change(function (){
                    if(this.checked){
                        $(this).next().next().removeProp('disabled');
                        $(this).next().next().val('1');
                        var timeVal = $(this).next().next().val();
                        var val = $(this).val()+' '+timeVal;
                        $(this).val(val);

                    }else{
                        $(this).next().next().prop('disabled',true);
                        $(this).next().next().val('');
                    }
                })
            });

            $(function (){
                $(".information").blur(function (){
                    var checkbox = $(this).prev().prev();
                    var timeVal = $(this).val();
                    var val = checkbox.val();
                    var arr=val.split(" ");
                    var str = arr[0];
                    checkbox.val(str+' '+timeVal);
                });
            });

        </script>
        <script>
            //常规用法 日期
            laydate.render({
                elem: '#house_rise'
            });
            laydate.render({
                elem: '#house_duration'
            });
        </script>

        {{--验证用--}}
        <script src="{{asset('house/js/jquery-1.11.3.js')}}"></script>
        <script type="text/javascript">
            var	$house_location=$("#house_location"),/*位置*/
                $house_locationMsg=$('#house_locationMsg'),/*匹配返回信息*/

                $house_structure=$("#house_structure"),/*结构*/
                $house_structureMsg=$('#house_structureMsg'),

                $house_price=$("#house_price"),/*价格*/
                $house_priceMsg=$('#house_priceMsg'),

                $house_size=$("#house_size"),/*大小*/
                $house_sizeMsg=$('#house_sizeMsg'),

                $cash_pledge=$("#cash_pledge"),
                $cash_pledgeMsg=$("#cash_pledgeMsg"),

                $house_keyword=$("#house_keyword"),/*关键词*/
                $house_keywordMsg=$('#house_keywordMsg'),

                $house_brief=$("#house_brief"),/*房简介*/
                $house_briefMsg=$('#house_briefMsg'),

                $landlord_name=$("#landlord_name"),/*房东名称*/
                $landlord_nameMsg=$('#landlord_nameMsg'),

                $landlord_identity=$("#landlord_identity"),/*房东证件号*/
                $landlord_identityMsg=$('#landlord_identityMsg'),

                $landlord_email=$("#landlord_email"),/*房东邮箱*/
                $landlord_emailMsg=$('#landlord_emailMsg'),

                $landlord_phone=$("#landlord_phone"),/*房东电话*/
                $landlord_phoneMsg=$('#landlord_phoneMsg'),

                $landlord_remark=$('#landlord_remark'),/*房东备注*/
                $landlord_remarkMsg=$('#landlord_remarkMsg');

            /**/
            onblurr($house_location,$house_locationMsg,/^[\u4e00-\u9fa5\w \d,，.'"-]{2,1000}$/,"Can't be empty",'格式错误');

            onblurr($house_structure,$house_structureMsg,/^[\u4e00-\u9fa5\w \d,，.'"]{2,1000}$/,"Can't be empty",'格式错误');

            onblurr($house_size,$house_sizeMsg,/[0-9]/,"Can't be empty",'格式错误');

            onblurr($house_price,$house_priceMsg,/[0-9]/,"Can't be empty",'格式错误');

            onblurr($cash_pledge,$cash_pledgeMsg,/[0-9]/,"Can't be empty",'格式错误');//押金

            onblurr($house_keyword,$house_keywordMsg,/[\u4e00-\u9fa5\w ]{2,1000}$/,"Can't be empty",'格式错误');

            onblurr($house_brief,$house_briefMsg,/[\u4e00-\u9fa5\w ]{2,1000}/,"Can't be empty",'格式错误');

            onblurr($landlord_name,$landlord_nameMsg,/[\u4e00-\u9fa5\w \d,，.'"]{2,1000}/,"Can't be empty",'格式错误');

            onblurr($landlord_identity,$landlord_identityMsg,/^[0-9]\w{5,1000}$/,"Can't be empty",'格式错误');

            onblurr($landlord_phone,$landlord_phoneMsg, /^1(3|4|5|7|8)\d{9}$/,"Can't be empty",'格式错误');


            /*获取焦点事件和按住事件*/
            /*function onfocus(inputId,spanId,spanMsg){
             inputId.focus(function(){
             spanId.html(spanMsg).removeClass().addClass("asd");
             });
             inputId.keyup(function(){
             spanId.html(spanMsg);
             });
             }*/
            /*鼠标失去焦点验证格式*/
            function onblurr(inputId,spanId,zhengZe,emptyMsg,errorMsg){
                inputId.blur(function(){
                    var val=inputId.val().search(zhengZe);
                    if (inputId.val()!=""){
                        if(val != -1){
                            spanId.html("").removeClass().addClass("ok");
                        }else{
                            spanId.html(errorMsg).removeClass().addClass("err");
                            $(spanId).css("color", "red");
                        }
                    }else{
                        spanId.html(emptyMsg).removeClass().addClass("err");
                        $(spanId).css("color", "red");
                    }

                })
            }

            $("#verification").click(function(){
                if ($(".ok").length==7 || $(".ok").length==8){
                    if(window.confirm('亲！请确认好地区喔 往后不得更改')){
                        document.getElementById('SUBMIT').submit();
                    }
                }else alert("Dear！Please correct the above error");
            });
        </script>


        <script src="{{asset('house/js/jquery.min.js')}}"></script>
        {{--<script src="{{asset('house/js/H-ui.js')}}"></script>--}}



        <script type="text/javascript">
            var areaObj = [];
            function initLocation(e){
                var a = 0;
                for (var m in e) {
                    areaObj[a] = e[m];
                    var b = 0;
                    for (var n in e[m]) {
                        areaObj[a][b++] = e[m][n];
                    }
                    a++;
                }
            }
        </script>

        <script type="text/javascript">
            window.onload=function(){
                var val = $("#country").val();
                var arr=val.split(",");
                var p_nation_ID = arr[3];
                $.ajax({
                    url:"{{url('house/houseLister/region')}}",
                    data:'p_nation_ID='+p_nation_ID,
                    type:'get',
                    success:function (re) {
                        var country = '';
                        for(var i = 0;i < re.length; i++) {
                            var objContry = re[i]['chinese_p_name'];
                            var p_ID = re[i]['p_ID'];
                            var english_p_name = re[i]['english_p_name'];
                            country += '<option value="'+objContry+','+english_p_name+','+p_ID+'">'+objContry+'&nbsp;&nbsp;&nbsp;'+english_p_name+'</option>';
                        }
                        $("#province").html(country);
                        var val = $("#province").val();
                        var arr=val.split(",");
                        var c_province_ID = arr[2];
                        $.ajax({
                            url:"{{url('house/houseLister/region')}}",
                            data:'c_province_ID='+c_province_ID,
                            type:'get',
                            success:function (re) {
                                var country = '';
                                for(var i = 0;i < re.length; i++) {
                                    var objContry = re[i]['chinese_c_name'];
                                    var english_c_name = re[i]['english_c_name'];
                                    var number = re[i]['number'];
                                    country += '<option value="'+objContry+','+english_c_name+','+number+'">'+objContry+'&nbsp;&nbsp;&nbsp;'+english_c_name+'</option>';
                                }
                                $("#city").html(country);

                            }
                        });
                    }
                })
            }
            $("select#country").change(function(){
                var val = $("#country").val();
                var arr=val.split(",");
                var p_nation_ID = arr[3];
                $.ajax({
                    url:"{{url('house/houseLister/region')}}",
                    data:'p_nation_ID='+p_nation_ID,
                    type:'get',
                    success:function (re) {
                        var country = '';
                        for(var i = 0;i < re.length; i++) {
                            var objContry = re[i]['chinese_p_name'];
                            var p_ID = re[i]['p_ID'];
                            var english_p_name = re[i]['english_p_name'];
                            country += '<option value="'+objContry+','+english_p_name+','+p_ID+'">'+objContry+'&nbsp;&nbsp;&nbsp;'+english_p_name+'</option>';
                        }
                        $("#province").html(country);
                        var val = $("#province").val();
                        var arr=val.split(",");
                        var c_province_ID = arr[2];
                        $.ajax({
                            url:"{{url('house/houseLister/region')}}",
                            data:'c_province_ID='+c_province_ID,
                            type:'get',
                            success:function (re) {
                                var country = '';
                                for(var i = 0;i < re.length; i++) {
                                    var objContry = re[i]['chinese_c_name'];
                                    var english_c_name = re[i]['english_c_name'];
                                    var number = re[i]['number'];
                                    country += '<option value="'+objContry+','+english_c_name+','+number+'">'+objContry+'&nbsp;&nbsp;&nbsp;'+english_c_name+'</option>';
                                }
                                $("#city").html(country);

                            }
                        })
                    }
                })
            });
            $("select#province").change(function(){
                var val = $("#province").val();
                var arr=val.split(",");
                var c_province_ID = arr[2];
                $.ajax({
                    url:"{{url('house/houseLister/region')}}",
                    data:'c_province_ID='+c_province_ID,
                    type:'get',
                    success:function (re) {
                        var country = '';
                        for(var i = 0;i < re.length; i++) {
                            var objContry = re[i]['chinese_c_name'];
                            var english_c_name = re[i]['english_c_name'];
                            var number = re[i]['number'];
                            country += '<option value="'+objContry+','+english_c_name+','+number+'">'+objContry+'&nbsp;&nbsp;&nbsp;'+english_c_name+'</option>';
                        }
                        $("#city").html(country);

                    }
                })
            });

        </script>
        {{--图片验证--}}

        <script type="text/javascript">
            $(function() {
                var objUrl;
                var img_html;
                $("#myFile").change(function() {
                    var img_div = $(".img_div");
                    var filepath = $("input[name='upload[]']").val();
                    for(var i = 0; i < this.files.length; i++) {
                        objUrl = getObjectURL(this.files[i]);
                        var extStart = filepath.lastIndexOf(".");
                        var ext = filepath.substring(extStart, filepath.length).toUpperCase();
                        /*
                         作者：z@qq.com
                         时间：2016-12-10
                         描述：鉴定每个图片上传尾椎限制
                         * */
                        if(ext != ".BMP" && ext != ".PNG" && ext != ".GIF" && ext != ".JPG" && ext != ".JPEG") {
                            $(".shade").fadeIn(500);
                            $(".text_span").text("图片限于bmp,png,gif,jpeg,jpg格式");
                            this.value = "";
                            $(".img_div").html("");
                            return false;
                        } else {
                            /*
                             若规则全部通过则在此提交url到后台数据库
                             * */
                            img_html = "<div class='isImg'><img src='" + objUrl + "' onclick='javascript:lookBigImg(this)' style='height: 100%; width: 100%;' /><button class='removeBtn' onclick='javascript:removeImg(this)'>x</button></div>";
                            img_div.append(img_html);
                        }
                    }
                    /*
                     作者：z@qq.com
                     时间：2016-12-10
                     描述：鉴定每个图片大小总和
                     * */
                    var file_size = 0;
                    var all_size = 0;
                    for(j = 0; j < this.files.length; j++) {
                        file_size = this.files[j].size;
                        all_size = all_size + this.files[j].size;
                        var size = all_size / 1024;
                        if(size > 5000) {
                            $(".shade").fadeIn(5000);
                            $(".text_span").text("上传的图片大小不能超过1000k！");
                            this.value = "";
                            $(".img_div").html("");
                            return false;
                        }
                    }
                    /*
                     描述：鉴定每个图片宽高 以后会做优化 多个图片的宽高 暂时隐藏掉 想看效果可以取消注释就行
                     * */
                    //					var img = new Image();
                    //					img.src = objUrl;
                    //					img.onload = function() {
                    //						if (img.width > 100 && img.height > 100) {
                    //							alert("图片宽高不能大于一百");
                    //							$("#myFile").val("");
                    //							$(".img_div").html("");
                    //							return false;
                    //						}
                    //					}
                    return true;
                });
                /*
                 作者：z@qq.com
                 时间：2016-12-10
                 描述：鉴定每个浏览器上传图片url 目前没有合并到Ie
                 * */
                function getObjectURL(file) {
                    var url = null;
                    if(window.createObjectURL != undefined) { // basic
                        url = window.createObjectURL(file);
                    } else if(window.URL != undefined) { // mozilla(firefox)
                        url = window.URL.createObjectURL(file);
                    } else if(window.webkitURL != undefined) { // webkit or chrome
                        url = window.webkitURL.createObjectURL(file);
                    }
                    //console.log(url);
                    return url;
                }
            });
            /*
             描述：上传图片附带删除 再次地方可以加上一个ajax进行提交到后台进行删除
             * */
            function removeImg(r){
                $(r).parent().remove();
            }
            /*
             描述：上传图片附带放大查看处理
             * */
            function lookBigImg(b){
                $(".shadeImg").fadeIn(500);
                $(".showImg").attr("src",$(b).attr("src"))
            }
            /*
             描述：关闭弹出层
             * */
            function closeShade(){
                $(".shade").fadeOut(500);
            }
            /*
             描述：关闭弹出层
             * */
            function closeShadeImg(){
                $(".shadeImg").fadeOut(500);
            }
        </script>
        <script>
            $('select#price_currency').change(function (){
                var price_currencyVal = $('select#price_currency').val();
                document.getElementById('deposit_currency').value = price_currencyVal;
            })
        </script>
    @stop

