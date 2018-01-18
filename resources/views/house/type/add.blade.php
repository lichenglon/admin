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
                <span style="line-height:34px;">@lang('house_translate.New_classification')</span>
            </h4>

            @if (session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif
            <form action="{{ url('house/type/add/save') }}" method="post" class="form-horizontal form-submit" enctype="multipart/form-data">
                {{ csrf_field() }}


                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">@lang('house_translate.Classification_name')：<span style="color:red">*</span></label>
                    <div class="col-sm-4">
                        <input type="text" name="name" required="required" id="class_name" class="form-control" id="inputEmail3" placeholder="">
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <button type="submit" class="btn btn-primary js-ajax-submit">@lang('house_translate.Determine')</button>
                            <a href="javascript:window.history.go(-1)" type="button" class="btn btn-default">@lang('house_translate.cancel')</a>
                        </div>
                    </div>
                </div>




            </form>


        </div>




        <!-- /.box-body -->
    </div>

@stop


@section('js')


@stop
