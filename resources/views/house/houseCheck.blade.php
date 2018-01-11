@extends('layouts.default')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('house/css/H-ui.min.css')}}" />
@stop

@section('content')

    <div class="box">
        <div class="box-body">


            <div class="Hui-article"  style="height:625px">
                <article class="cl pd-20">

                    <span class="r">共有数据：<strong>{{$total}}</strong> 条</span>
                    <form action="{{url('house/houseCheck')}}" method="get">
                    {{--<div class="cl pd-5 bg-1 bk-gray mt-20"></div>--}}
                    <div class="mt-20">
                        <table class="table table-border table-bordered table-bg table-hover table-sort">
                            <thead>
                            <tr class="text-c" id="theader">
                                <th>类型</th>
                                <th width="">ID</th>
                                <th width="">房源编号</th>
                                <th width="">房源结构</th>
                                <th width="">房源价格</th>
                                <th width="">房源大小</th>
                                {{--<th width="">房屋设备</th>--}}
                                <th width="">房源位置</th>
                                <th width="">租期时长</th>
                                {{--<th width="">房源状态</th>--}}
                                <th>审核状态</th>
                                <th width="">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($result as $k=>$v)
                                <tr class="text-c">
                                    <td>{{ $v->house_type }}</td>
                                    <td>{{ $v->msgid }}</td>
                                    <td><a href="{{url('house/houseLister/detail',['id'=>$v->msgid])}}"><u style="cursor:pointer" class="text-primary" title="查看">{{$v->serial_number}}</u></a></td>
                                    <td>{{ $v->house_structure }}</td>
                                    <td>{{ $v->house_price }}</td>
                                    <td>{{ $v->house_size }} 平方</td>
                                    {{--<td>{{ $v->house_facility }}</td>--}}
                                    <td>{{ $v->house_location }}</td>
                                    <td>{{ $v->house_rise }}</td>
                                    {{--<td>{{ $v->house_status }}</td>--}}
                                    <td>
                                        @if($v->chk_sta == 1)
                                            <label>审核通过 <input name="chk_sta" type="radio" value="2" onclick="javascript:if(window.confirm('确定要执行此操作吗？')){isCheck('2','{{$v->msgid}}')}" /></label>
                                            &nbsp;&nbsp;
                                            <label>审核不通过<input name="chk_sta" type="radio" value="3" onclick="javascript:if(window.confirm('确定要执行此操作吗？')){isCheck('3','{{$v->msgid}}')}" /></label>
                                        @elseif($v->chk_sta == 2)
                                            审核通过
                                        @elseif($v->chk_sta == 3)
                                            审核不通过
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('house/updateList/detail',['id'=>$v->msgid]) }}">修改房源</a>
                                    </td>
                            @endforeach
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    </form>
                </article>
            </div>
            @if (!empty($result))
                <div class="page_list">
                    {{$result->appends(Request::input())->links()}}
                    <div style="display:inline-block; margin-bottom:25px;">
                        <span class="r">共有数据：<strong>{{$total}}</strong> 条</span>
                    </div>
                </div>
            @endif
        </div>


    </div>
        </div>
    </div>


@stop

@section('js')

    <script>
        //常规用法 日期
        laydate.render({
            elem: '#rise'
        });
        laydate.render({
            elem: '#duration'
        });
    </script>

    <script>
        function isCheck(number,msgid){
            $.ajax({
                url:"{{url('house/houseCheck/isCheck')}}",
                data: 'chk_sta='+number+'&msgid='+msgid,
                type: 'get',
                success: function(re){
                    if(re == '1'){
                        location.reload();
                    }else{
                        alert('审核失败');
                    }
                }
            })
        }
    </script>
@stop


