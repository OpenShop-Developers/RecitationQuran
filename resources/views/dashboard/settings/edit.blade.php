@extends('dashboard.layouts.app')
@section('title')
    تعديل الاعدادات
@stop


@section('content')

    <section class="content">

        <!-- Default box -->
        <div class="box">


            <div class="box-body">
                <hr>

{{--                @include('flash::message')--}}

                {!! Form::model($model , [
                    'action' => ['Dashboard\SettingController@update' , $model->id],
                    'method' => 'put'
                ]) !!}

                @include('dashboard.partials.validation_errors')
                @include('dashboard.settings.form')

                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->

        </div>
        <!-- /.box -->

    </section>
@endsection


