@extends('dashboard.layouts.app')
@inject('model' , 'App\Models\Role')
@section('title')
    اضافة رتبه جديده
@stop


@section('content')

    <section class="content">

        <!-- Default box -->
        <div class="box">

            <div class="box-body">
                {!! Form::model($model,[
                      'action' => 'Dashboard\RoleController@store'
                  ]) !!}

                @include('dashboard.partials.validation_errors')
                @include('dashboard.roles.form')

                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->

        </div>
        <!-- /.box -->

    </section>

@endsection


