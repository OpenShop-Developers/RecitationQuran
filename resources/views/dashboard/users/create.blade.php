@extends('dashboard.layouts.app')

@section('title')
    اضافة مشرف جديد
@stop


@section('content')

    <section class="content">

        <!-- Default box -->
        <div class="box">

            <div class="box-body">
                {!! Form::open([
                      'action' => 'Dashboard\UserController@store',
                      'files'  => true
                  ]) !!}

                @include('dashboard.partials.validation_errors')
                @include('dashboard.users.form')

                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->

        </div>
        <!-- /.box -->

    </section>

@endsection


