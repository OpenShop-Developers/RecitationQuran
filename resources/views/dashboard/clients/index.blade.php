@extends('dashboard.layouts.app')

@section('title')
    التحكم في العملاء
@stop

@section('content')

    <section class="content">

        <!-- Default box -->

        <div class="box">
            <div class="box-body">
                <a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    البحث <i class="fa fa-search"></i>
                </a>
                <div class="collapse" id="collapseExample">
                    <div class="well">
                        <form action="{{ route('clients.filter') }}" method="get">
                            <div class="row">
                                <div class="col-md-12" style="margin-top:5px ">
                                    <label>@lang(' تاريخ التسجيل من :')</label>
                                    {!! Form::date('from',request('from'),[
                                        'class' => 'form-control',
                                    ]) !!}
                                </div>
                                <div class="col-md-12" style="margin-top:5px ">
                                    <label>@lang(' تاريخ التسجيل الي :')</label>
                                    {!! Form::date('to',request('to'),[
                                        'class' => 'form-control',
                                    ]) !!}
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-3" style="margin-top: 5px">
                                    {!! Form::text('name',request('name'),[
                                            'class' => 'form-control js-example-basic-single',
                                            'placeholder' =>'الاسم'
                                        ]) !!}
                                </div>
                                <div class="col-sm-3" style="margin-top: 5px">
                                    {!! Form::email('email',request('email'),[
                                            'class' => 'form-control js-example-basic-single',
                                            'placeholder' =>'    البريد الالكتروني'
                                        ]) !!}
                                </div>
                                <div class="col-sm-3" style="margin-top: 5px">
                                    {!! Form::select('gender',gender(),request('gender'),[
                                            'class' => 'form-control js-example-basic-single',
                                            'placeholder' =>'الجنس'
                                        ]) !!}
                                </div>
                                <div class="col-md-3" style="margin-top:5px ">
                                    <button type="submit" class="btn btn-primary btn-block"> @lang('ابحث الان') <i
                                            class="fa fa-search"></i></button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <hr>
            <div>
                <a href="{{route('clients.create')}}" class="btn btn-primary"><i class="fa fa-plus">
                    </i> اضافة عميل جديد</a>
            </div>
            <br>
        @include('flash::message')
        @if(count($records))
            <div class="table-responsive">
                <table class="table table-bordered table-hover" style="page-break-inside: avoid">
                    <thead>
                    <tr>
                        <td>#</td>
                        <td>الاسم</td>
                        <td>الموبايل</td>
                        <td>البريد الالكتروني</td>
                        <td>الجنس</td>
                        <td class="text-center">تعديل كلمة المرور</td>
                        <td class="text-center">تعديل</td>
                        <td class="text-center">حذف</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($records as $record)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$record->name}}</td>
                            <td>{{$record->phone}}</td>
                            <td>{{$record->email}}</td>
                            <td>{{$record->clientGender}}</td>

                            <td class="text-center">
                                <a href="{{route('clients.edit', $record->id)}}" class="btn btn-primary btn-xs">
                                    <i class="fa fa-key"></i>
                                </a>
                            </td>

                            <td class="text-center">
                                <a href="{{url(route('clients.edit' ,$record->id))}}"
                                   class="btn btn-success btn-xs">
                                    <i class="fa fa-edit"></i></a>
                            </td>
                            <td class="text-center">

                                {!! Form::open([
                                    'action' => ['Dashboard\ClientController@destroy' , $record->id],
                                    'method' => 'delete'
                                ]) !!}

                                <button type="submit" class=" btn-danger btn-xs"><i class="fa fa-trash"></i>
                                </button>

                                {!! Form::close() !!}

                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
                {{$records->render()}}
            </div>


        @else

            <div class="alert alert-danger" role="alert">
                عقوا ، لا يوجد بيانات
            </div>
            </div>
    @endif
    <!-- /.box-body -->


        </div>

        <!-- /.box -->

        <!-- /.content -->

    </section>

@endsection




