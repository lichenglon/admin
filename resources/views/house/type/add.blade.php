@extends('layouts/default')


@section('css')


    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/module.css') }}">


@stop

@section('content')


    <div class="box">


        <!-- /.box-header -->
        <div class="box-body">


            <h4 class="bg-info" style="padding:5px 10px; font-size:14px; overflow:hidden;">
                <span style="line-height:34px;">新增分类</span>
            </h4>

            @if (session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif
            <form action="{{ url('house/type/add/save') }}" method="post" class="form-horizontal form-submit" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">上一级分类：</label>
                    <div class="col-sm-4" style="padding-top:7px;">

                            <select class="form-control" name="pid">
                                <option value="0">无</option>
                                    {!! $optionStr !!}
                            </select>

                    </div>
                </div>


                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">分类名称：<span style="color:red">*</span></label>
                    <div class="col-sm-4">
                        <input type="text" name="name" required id="class_name" class="form-control" id="inputEmail3" placeholder="">
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-4">

                        <a href="javascript:window.history.go(-1)" type="button" class="btn btn-default">取消</a>
                        <button type="submit" class="btn btn-primary js-ajax-submit">确定</button>
                    </div>
                </div>

            </form>


        </div>




        <!-- /.box-body -->
    </div>

@stop


@section('js')


@stop