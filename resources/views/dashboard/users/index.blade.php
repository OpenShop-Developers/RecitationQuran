@extends('dashboard.layouts.app')

@section('title')
    التحكم في المشرفين
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
                        <form action="{{ route('users.filter') }}" method="get">
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
                                <div class="col-sm-3" style="margin-top: 5px">
                                    @inject('role','App\Models\Role')
                                    {!! Form::select('roles_list',$role->pluck('display_name', 'id')->toArray(),request('roles_list'),[
                                            'class' => 'form-control js-example-basic-single',
                                            'placeholder' =>'الرتبه'
                                        ]) !!}
                                </div>
                                <div class="col-md-4 col-md-offset-4" style="margin-top:5px ">
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
                <a href="{{route('users.create')}}" class="btn btn-primary"><i class="fa fa-plus">
                    </i> اضافة مشرف جديد</a>
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
                        <td>رقم الهاتف</td>
                        <td>البريد الالكتروني</td>
                        <td>الجنس</td>
                        <td>الصوره</td>
                        <td>الرتبه</td>
                        <td><i class="fa fa-facebook-square fa-2x"></i></td>
                        <td><i class="fa fa-twitter-square fa-2x"></i></td>
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
                            <td><img src="{{$record->imagePath}}" alt="image" height="100px"></td>
                            <td>
                                @foreach($record->roles as $role)
                                    <span class="label label-success">{{$role->display_name}}</span>
                                @endforeach
                            </td>
                            <td><a href="{{$record->facebook_link}}">Facebook</a></td>
                            <td><a href="{{$record->twitter_link}}">Twitter</a></td>

                            <td class="text-center">
                                <a href="{{url(route('users.edit' ,$record->id))}}"
                                   class="btn btn-success btn-xs">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </td>
                            <td class="text-center">

                                {!! Form::open([
                                    'action' => ['Dashboard\UserController@destroy' , $record->id],
                                    'method' => 'delete'
                                ]) !!}

                                <button type="submit" onclick="return confirm('هل أنت متأكد ؟')" class="btn-danger btn-xs"><i class="fa fa-trash"></i>
                                </button>

                                {!! Form::close() !!}

                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>


            </div>


        @else

            <div class="alert alert-danger" role="alert">
                لا يوجد بيانات
            </div>
            </div>
    @endif
    <!-- /.box-body -->


        </div>

        <!-- /.box -->

        <!-- /.content -->

    </section>

@endsection




