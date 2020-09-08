@extends('dashboard.layouts.app')

@section('title')
    اضافة عميل جديد
@stop


@section('content')

    <section class="content">

        <!-- Default box -->
        <div class="box">

            <div class="box-body">
                {!! Form::open([
                      'action' => 'Dashboard\ClientController@store'
                  ]) !!}

                @include('dashboard.partials.validation_errors')
                @include('dashboard.clients.form')

                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->

        </div>
        <!-- /.box -->

    </section>

@endsection


