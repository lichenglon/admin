@extends('layouts.default')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('house/css/H-ui.min.css')}}" />
    <style type="text/css">

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
                <form action="{{url('house/houseLister/uSave')}}" method="post" id="SUBMIT" class="form form-horizontal" id="form-article-add" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" value="{{$houseMsg->msgid}}" name="msgId">
                    <input type="hidden" value="{{$houseMsg->landid}}" name="landId">
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>@lang('house_translate.Housing_types')：</label>
                        <div class="formControls col-xs-8 col-sm-9" style="width:45%;">
                        <span class="select-box">
				            <select name="house_type" class="select" id="houseTypeVal">
                                {!! $optionStr !!}}
                            </select>
                        </span>
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>@lang('house_translate.Housing_name')：</label>
                        <div class="formControls col-xs-8 col-sm-9" style="width:45%;">
                            <input type="text" class="input-text" value="{{$houseMsg->house_name}}" placeholder="房源名称" required maxlength="3000" id="house_location" name="house_name" >
                        </div>
                        <span id="house_locationMsg"></span>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2">@lang('house_translate.Detailed_location')：</label>
                        <div class="formControls col-xs-8 col-sm-9" style="width:45%;">
                            <input type="text" name="house_location" id="house_location" placeholder="广东省深圳市宝安区西乡街道56栋33号" value="{{$houseMsg->house_location}}" class="input-text">
                        </div>
                        <span id="house_locationMsg"></span>
                    </div>
                    <div class="row cl">
                        <?php
                            $house_structure = explode(',',$houseMsg->house_structure)
                        ?>
                        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>@lang('house_translate.Housing_structure')：</label>
                        <div class="formControls col-xs-8 col-sm-9" style="width:45%;">
                            <input type="number" name="room"  max="100" min="0" value="{{$house_structure[0]}}" class="input-text"> @lang('house_translate.room')
                            <input type="number" name="hall"  max="100" min="0" value="{{$house_structure[1]}}" class="input-text"> @lang('house_translate.hall')
                            <input type="number" name="kitchen"  max="100" min="0" value="{{$house_structure[2]}}" class="input-text"> @lang('house_translate.kitchen')
                            <input type="number" name="toilet"  max="100" min="0" value="{{$house_structure[3]}}" class="input-text"> @lang('house_translate.toilet')
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2">@lang('house_translate.surrounding_information')：</label>
                        <div class="formControls col-xs-8 col-sm-9"  style="width:45%;">
                            <?php
                                $rimMessage = $houseMsg->rim_message ? explode(',',$houseMsg->rim_message) : '';
                                //var_dump($rimMessage);
                                //取步行时间
                                if(is_array($rimMessage)){
                                    //$arr = [];
                                    foreach($rimMessage as $v){
                                        if(strstr($v, '超市') !== false){
                                            $supermarket = explode(' ',$v);
                                        }elseif(strstr($v, '中餐馆') !== false){
                                            $Chinese = explode(' ',$v);
                                        }elseif(strstr($v, '警局') !== false){
                                            $police = explode(' ',$v);
                                        }elseif(strstr($v, '公共交通') !== false){
                                            $public = explode(' ',$v);
                                        }

                                    }

                                } else {
                                    $supermarket = '';
                                    $Chinese = '';
                                    $police = '';
                                    $public = '';
                                }
                            ?>
                            <div class="check-box">
                                @if(isset($supermarket) && is_array($supermarket))
                                    <input name="peripheral_information[]" value='超市 {{$supermarket[1]}}' checked="checked" type="checkbox" class="date_checkbox" id="peripheral-1">
                                    <label for="peripheral-1">@lang('house_translate.supermarket')</label>
                                    <input type="number" name="" id="supermarket"  value="{{$supermarket[1]}}" min="1" max="300" class="input-text information">/@lang('house_translate.Minute')
                                @else
                                    <input name="peripheral_information[]" value='超市 ' type="checkbox" class="date_checkbox" id="peripheral-1">
                                    <label for="peripheral-1">@lang('house_translate.supermarket')</label>
                                    <input type="number" name="" id="supermarket"  disabled="disabled"  min="1" max="300" class="input-text information">/@lang('house_translate.Minute')
                                @endif
                            </div>
                            <div class="check-box">
                                @if(isset($Chinese) && is_array($Chinese))
                                    <input name="peripheral_information[]" value='中餐馆 {{$Chinese[1]}}' checked="checked"  type="checkbox" class="date_checkbox" id="peripheral-2">
                                    <label for="peripheral-2">@lang('house_translate.Chinese_restaurant')</label>&nbsp;
                                    <input type="number" name="" value="{{$Chinese[1]}}" min="1" max="300" class="input-text information">/@lang('house_translate.Minute')
                                @else
                                    <input name="peripheral_information[]" value='中餐馆 ' type="checkbox" class="date_checkbox" id="peripheral-2">
                                    <label for="peripheral-2">@lang('house_translate.Chinese_restaurant')</label>&nbsp;
                                    <input type="number" name=""  disabled="disabled" value="" min="1" max="300" class="input-text information">/@lang('house_translate.Minute')
                                @endif
                            </div>
                            <br>
                            <div class="check-box">
                                @if(isset($police) && is_array($police))
                                    <input name="peripheral_information[]" value='警局 {{$police[1]}}' checked="checked" type="checkbox" class="date_checkbox" id="peripheral-3">
                                    <label for="peripheral-3">@lang('house_translate.The_police_station')</label>
                                    <input type="number" name="" value="{{$police[1]}}" min="0" max="300" class="input-text information">/@lang('house_translate.Minute')
                                @else
                                    <input name="peripheral_information[]" value='警局 ' type="checkbox" class="date_checkbox" id="peripheral-3">
                                    <label for="peripheral-3">@lang('house_translate.The_police_station')</label>
                                    <input type="number" name=""  disabled="disabled"  value="" min="0" max="300" class="input-text information">/@lang('house_translate.Minute')
                                @endif
                            </div>
                            <div class="check-box">
                                @if(isset($public) && is_array($public))
                                    <input name="peripheral_information[]" value='公共交通 {{$public[1]}}' checked="checked" type="checkbox" class="date_checkbox" id="peripheral-4">
                                    <label for="peripheral-4">@lang('house_translate.Public_transport')</label>
                                    <input type="number" name="" value="{{$public[1]}}" min="1" max="300" class="input-text information">/@lang('house_translate.Minute')
                                @else
                                    <input name="peripheral_information[]" value='公共交通 '  type="checkbox" class="date_checkbox" id="peripheral-4">
                                    <label for="peripheral-4">@lang('house_translate.Public_transport')</label>
                                    <input type="number" name=""  disabled="disabled" value="" min="1" max="300" class="input-text information">/@lang('house_translate.Minute')
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2">@lang('house_translate.Housing_prices')：</label>
                        <div class="formControls col-xs-8 col-sm-9" style="width:45%;">
                            <input type="number" name="house_price" id="house_price" placeholder="" value="{{$houseMsg->house_price}}"  min="1" class="input-text" style="width:69%;">
                            <select name="price_currency" id="price_currency" class="input-text" style="width:20%;">
                                <option value="英镑,The pound">@lang('house_translate.The_pound')</option>
                                <option value="美元,The dollar">@lang('house_translate.The_dollar')</option>
                                <option value="人民币,The yuan">@lang('house_translate.The_yuan')</option>
                            </select>
                        </div>
                        <span id="house_priceMsg"></span>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2">@lang('house_translate.Housing_size')：</label>
                        <div class="formControls col-xs-8 col-sm-9" style="width:45%;">
                            <input type="number" name="house_size" id="house_size" placeholder="" value="{{$houseMsg->house_size}}"  min="0.0" step="0.1"class="input-text" style="width:90%;"> /@lang('house_translate.Square_meters')
                        </div>
                        <span id="house_sizeMsg"></span>
                    </div>

                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2">@lang('house_translate.deposit')：</label>
                        <div class="formControls col-xs-8 col-sm-9"  style="width:45%;">
                            <input type="number" name="cash_pledge" id="cash_pledge" placeholder="" value="{{$houseMsg->cash_pledge}}"  min="1" class="input-text" style="width:69%;">
                            <select name="deposit_currency" id="deposit_currency" class="input-text" style="width:20%;">
                                <option value="英镑,The pound">@lang('house_translate.The_pound')</option>
                                <option value="美元,The dollar">@lang('house_translate.The_dollar')</option>
                                <option value="人民币,The yuan">@lang('house_translate.The_yuan')</option>
                            </select>
                        </div>
                        <span id="cash_pledgeMsg"></span>
                    </div>
                    <?php
                        $payment_proportion = explode(',',$houseMsg->payment_proportion);
                    ?>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>@lang('house_translate.Prepayment_ratio')：</label>
                        <div class="formControls col-xs-8 col-sm-9" style="width:45%;">
                            @lang('house_translate.and') <input type="number" name="and" max="100" min="0" value="{{$payment_proportion[0]}}" class="input-text">
                            @lang('house_translate.pay') <input type="number" name="pay" max="100" min="0" value="{{$payment_proportion[1]}}" class="input-text">
                        </div>
                    </div>

                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>@lang('house_translate.The_method_of_payment')：</label>
                        <div class="formControls col-xs-8 col-sm-9" style="width:45%;">
                            <span class="select-box">
				                <select name="knot_way" class="select" id="knot_way">
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
                            <?php
                                if(empty($houseMsg->house_facility)){
                                    $equipment = array();
                                    $washing = in_array('洗衣机',$equipment);//洗衣机
                                    $air = in_array('空调',$equipment);//空调
                                    $heating = in_array('暖气',$equipment);//暖气
                                    $bed = in_array('床',$equipment);//床
                                    $kitchen = in_array('厨房',$equipment);//厨房
                                    $closet = in_array('衣柜',$equipment);//衣柜
                                    $refrigerator = in_array('冰箱',$equipment);//冰箱
                                }else{
                                    $equipment = explode(',',$houseMsg->house_facility);
                                    $washing = in_array('洗衣机',$equipment);//洗衣机
                                    $air = in_array('空调',$equipment);//空调
                                    $heating = in_array('暖气',$equipment);//暖气
                                    $bed = in_array('床',$equipment);//床
                                    $kitchen = in_array('厨房',$equipment);//厨房
                                    $closet = in_array('衣柜',$equipment);//衣柜
                                    $refrigerator = in_array('冰箱',$equipment);//冰箱
                                }
                            ?>
                            <div class="check-box">
                                <input name="house_facility[]" @if($washing) checked="checked" @endif value='洗衣机' type="checkbox" id="checkbox-1">
                                <label for="checkbox-1">@lang('house_translate.Washing_machine')</label>
                            </div>
                            <div class="check-box">
                                <input name="house_facility[]" @if($air) checked="checked" @endif value='空调' type="checkbox" id="checkbox-2">
                                <label for="checkbox-2">@lang('house_translate.Air_conditioning')</label>
                            </div>
                            <div class="check-box">
                                <input name="house_facility[]" @if($heating) checked="checked" @endif value='暖气' type="checkbox" id="checkbox-3">
                                <label for="checkbox-3">@lang('house_translate.The_heating')</label>
                            </div>
                            <div class="check-box">
                                <input name="house_facility[]" @if($bed) checked="checked" @endif value='床' type="checkbox" id="checkbox-4">
                                <label for="checkbox-4">@lang('house_translate.The_bed')</label>
                            </div>@if(Session::get('lang') == 'en')<br>@endif
                            <div class="check-box">
                                <input name="house_facility[]" @if($kitchen) checked="checked" @endif value='厨房' type="checkbox" id="checkbox-5">
                                <label for="checkbox-5">@lang('house_translate.The_kitchen')</label>
                            </div>
                            <div class="check-box">
                                <input name="house_facility[]" @if($closet) checked="checked" @endif value='衣柜' type="checkbox" id="checkbox-6">
                                <label for="checkbox-6">@lang('house_translate.The_wardrobe')</label>
                            </div>
                            <div class="check-box">
                                <input name="house_facility[]" @if($refrigerator) checked="checked" @endif value='冰箱' type="checkbox" id="checkbox-7">
                                <label for="checkbox-7">@lang('house_translate.The_refrigerator')</label>
                            </div>
                        </div>
                    </div>

                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2">@lang('house_translate.Introduction_of_housing')：</label>
                        <div class="formControls col-xs-8 col-sm-9" style="width:45%;">
                            <textarea name="house_brief" id="house_brief" cols="" rows="" class="textarea"  placeholder="说点什么...最少输入10个字符">{{$houseMsg->house_brief}}</textarea>
                        </div>
                        <span id="house_briefMsg"></span>
                    </div>

                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2">@lang('house_translate.The_lease_period')：</label>
                        <div class="formControls col-xs-8 col-sm-9 skin-minimal">
                            <div class="check-box">
                                <input type="text" name="house_rise" id="house_rise" placeholder="" value="{{$houseMsg->house_rise}}" class="input-text" style="display:inline-block">
                            </div>
                            <span>@lang('house_translate.The_longest_leases')</span>
                            <div class="check-box">
                                <input type="number" min="0" max="1000000" value="{{$houseMsg->house_duration}}" name="house_duration" class="input-text Wdate" style="width:70%;"> /@lang('house_translate.Weeks2')
                            </div>
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2">@lang('house_translate.Home_state')：</label>
                        <div class="formControls col-xs-8 col-sm-9 skin-minimal">

                            <div class="check-box">
                                <input name="house_status" @if($houseMsg->house_status == '预租') checked="true" @endif value="预租" type="radio" id="radio-1">
                                <label for="radio-1">@lang('house_translate.Rent_in_advance')</label>
                            </div>
                            <div class="check-box">
                                <input name="house_status" @if($houseMsg->house_status == '已锁定') checked="true" @endif value="已锁定" type="radio" id="radio-2">
                                <label for="radio-2">@lang('house_translate.Has_been_locked')</label>
                            </div>
                            <div class="check-box">
                                <input name="house_status" @if($houseMsg->house_status == '已出租') checked="true" @endif value="已出租" type="radio" id="radio-4">
                                <label for="radio-4">@lang('house_translate.Have_been_leased')</label>
                            </div>@if(Session::get('lang') == 'en')<br>@endif
                            <div class="check-box">
                                <input name="house_status" @if($houseMsg->house_status == '配置中') checked="true" @endif value="配置中" type="radio" id="radio-5">
                                <label for="radio-5">@lang('house_translate.In_the_configuration')</label>
                            </div>
                            <div class="check-box">
                                <input name="house_status" @if($houseMsg->house_status == '冻结') checked="true" @endif value="冻结" type="radio" id="radio-7">
                                <label for="radio-7">@lang('house_translate.freeze')</label>
                            </div>
                            <div class="check-box">
                                <input name="house_status" @if($houseMsg->house_status == '暂停出租') checked="true" @endif value="暂停出租" type="radio" id="radio-8">
                                <label for="radio-8">@lang('house_translate.Suspension_of_rent')</label>
                            </div>

                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2">@lang('house_translate.The_landlord_name')：</label>
                        <div class="formControls col-xs-8 col-sm-9" style="width:45%;">
                            <input type="text" name="landlord_name" value="{{$houseMsg->landlord_name}}" id="landlord_name" class="input-text Wdate" style="width:220px;">
                        </div>
                        <span id="landlord_nameMsg"></span>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2">@lang('house_translate.Landlord_id_number')：</label>
                        <div class="formControls col-xs-8 col-sm-9" style="width:45%;">
                            <input type="text" name="landlord_identity" value="{{$houseMsg->landlord_identity}}" id="landlord_identity" class="input-text Wdate" style="width:220px;">
                        </div>
                        <span id="landlord_identityMsg"></span>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2">@lang('house_translate.The_landlord_email')：</label>
                        <div class="formControls col-xs-8 col-sm-9" style="width:45%;">
                            <input type="text" name="landlord_email" value="{{$houseMsg->landlord_email}}" id="landlord_email" class="input-text Wdate" style="width:220px;">
                        </div>
                        <span id="landlord_emailMsg"></span>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2">@lang('house_translate.The_landlord_telephone')：</label>
                        <div class="formControls col-xs-8 col-sm-9" style="width:45%;">
                            <input type="text" name="landlord_phone" value="{{$houseMsg->landlord_phone}}" id="landlord_phone" class="input-text Wdate" style="width:220px;">
                        </div>
                        <span id="landlord_phoneMsg"></span>
                    </div>

                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2">@lang('house_translate.The_landlord_gender')：</label>
                        <div class="formControls col-xs-8 col-sm-9 skin-minimal">

                            <div class="check-box">
                                <input name="landlord_sex" @if($houseMsg->landlord_sex == '男') checked="true" @endif value="男" type="radio" id="radioTwo-1">
                                <label for="radioTwo-1">@lang('house_translate.boy')</label>
                            </div>
                            <div class="check-box">
                                <input name="landlord_sex" @if($houseMsg->landlord_sex == '女') checked="true" @endif value="女" type="radio" id="radioTwo-2">
                                <label for="radioTwo-2">@lang('house_translate.girl')</label>
                            </div>
                            <div class="check-box">
                                <input name="landlord_sex" @if($houseMsg->landlord_sex == '保密') checked="true" @endif value="保密" type="radio" id="radioTwo-3">
                                <label for="radioTwo-3">@lang('house_translate.secrecy')</label>
                            </div>
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2">@lang('house_translate.Address_of_landlord')：</label>
                        <div class="formControls col-xs-8 col-sm-9" style="width:45%;">
                            <input type="text" name="landlord_site" value="{{$houseMsg->landlord_site}}" id="datemin" class="input-text Wdate">
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2">@lang('house_translate.The_landlord_note')：</label>
                        <div class="formControls col-xs-8 col-sm-9" style="width:45%;">
                            <textarea name="landlord_remark" cols="" rows="" class="textarea"  placeholder="说点什么...最少输入10个字符">{{$houseMsg->landlord_remark}}</textarea>
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2">@lang('house_translate.Picture_operation')：</label>
                        <div class="formControls col-xs-8 col-sm-9" style="width:45%;">
                            <table>
                                @foreach($imgArr as $value)
                                <tr id="tr_{{$value->imgid}}" style="display:inline-block; width:25%; height:25%; margin-right:5%;">

                                    <td>
                                        <img  src="{{asset('./uploads')}}/{{$value->house_imagename}}" alt="">
                                        <a href="javascript:delimage({{$value->imgid}});" >@lang('house_translate.Delete_this_picture')</a>
                                    </td>

                                </tr>
                                @endforeach
                            </table>
                        </div>
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
                            <button class="btn btn-primary radius" type="submit" id="verification">@lang('house_translate.Save_and_submit_the_audit')</button>
                            <a href="javascript:window.history.go(-1);"><button class="btn btn-default radius" type="button">&nbsp;&nbsp;@lang('house_translate.cancel')&nbsp;&nbsp;</button></a>
                        </div>
                    </div>
                </form>
            </div>


        </div>
    </div>

@stop

@section('js')

    {{--日期用--}}
    <script type="text/javascript" src="{{asset('house/laydate/laydate.js')}}" ></script>
    <script>
        //常规用法
        laydate.render({
            elem: '#house_rise'
        });
        laydate.render({
            elem: '#house_duration'
        });
    </script>
    <script src="{{asset('house/js/jquery.min.js')}}"></script>
    <script src="{{asset('house/js/H-ui.js')}}"></script>
    <script type="text/javascript">
        function delimage(imageid) {
            $.ajax({
                url:"{{url('house/houseLister/del')}}",
                data:'id='+imageid,
                type:'get',
                success:function (re) {
                    if (re != '0') {
                        $("#tr_"+imageid).remove();
                    }
                }
            })
        }

    </script>
    <script>
        $(function (){
            $(".date_checkbox").change(function (){
                if(this.checked){
                    $(this).next().next().removeProp('disabled');
                    $(this).next().next().val('1');
                    var timeVal = $(this).next().next().val();
                    var val = $(this).val()+timeVal;
                    $(this).val(val);
                }else{
                    $(this).next().next().prop('disabled',true);
                    $(this).next().next().val('');
                    $(this).val('');
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
        document.getElementById('houseTypeVal').value='{{$houseMsg->house_type}}';
        document.getElementById('knot_way').value='{{$houseMsg->knot_way}}';
    </script>
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
        document.getElementById('price_currency').value = "{{$houseMsg->price_currency}}"+','+"{{$houseMsg->en_price_currency}}";
        document.getElementById('deposit_currency').value = "{{$houseMsg->deposit_currency}}"+','+"{{$houseMsg->en_deposit_currency}}";
    </script>
@stop

