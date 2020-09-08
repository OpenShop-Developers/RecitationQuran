@extends('dashboard.layouts.app')
@section('title')
    تعديل العميل
    {{$model->name}}
@stop


@section('content')

    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip"
                            title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                @include('flash::message')

                {!! Form::model($model, [
                    'action' => ['Dashboard\ClientController@update' , $model->id],
                    'method' => 'put'
                ]) !!}

                @include('dashboard.partials.validation_errors')
                @include('dashboard.clients.form')

                {!! Form::close() !!}

            </div>
            <!-- /.box-body -->

        </div>
        <!-- /.box -->

    </section>

    <section>
        <div class="box">

            <div class="box-body">

                <h3 class="box-title">
                    تعديل كلمة المرور
                </h3>
                <hr>

                @include('flash::message')

                {!! Form::open([
                     'url' => route('client.change-password') ,
                     'method' => 'post'
                 ])!!}
                {{Form::hidden('user_id' , $model->id  )}}
                <div class="clearfix"></div>
                <br>

                <div class="form-group">

                    <div class="col-md-12">
                        <input id="password" type="password" placeholder="كلمة المرور"
                               class="form-control @error('password') is-invalid @enderror"
                               name="password" required autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="clearfix"></div>
                <br>

                <div class="form-group">
                    <div class="col-md-12">
                        <input id="password" type="password" placeholder="تاكيد كلمة المرور"
                               class="form-control @error('password') is-invalid @enderror"
                               name="password" required autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>


                <div class="clearfix"></div>
                <br>

                <div class="form-group">
                    <div class="col-md-12 form-control">
                        <button type="submit" class="btn btn-warning">
                            <i class="fa fa-user" style="color:#FFFFFF"></i>
                            {{ __('تغيير كلمة المرور ') }}
                        </button>
                            <a href="{{'adminpanel/user/' . $model->id . '/delete'}}"
                               class="btn btn-danger btn-circle"><i
                                    class="fa fa-trash"></i>حذف العضو
                            </a>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </section>

@endsection


