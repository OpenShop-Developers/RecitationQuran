@extends('dashboard.layouts.app')

@section('title')
    التحكم في رتب المستخدمين
@stop

@section('content')

    <section class="content">

        <!-- Default box -->

        <div class="box">
{{--            <div class="box-body">--}}
{{--                <form action="{{ route('client-filter') }}" method="get">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-md-12" style="margin-top:5px ">--}}
{{--                            <label>@lang(' تاريخ التسجيل من :')</label>--}}
{{--                            {!! Form::date('from',request('from'),[--}}
{{--                                'class' => 'form-control',--}}
{{--                            ]) !!}--}}
{{--                        </div>--}}
{{--                        <div class="col-md-12" style="margin-top:5px ">--}}
{{--                            <label>@lang(' تاريخ التسجيل الي :')</label>--}}
{{--                            {!! Form::date('to',request('to'),[--}}
{{--                                'class' => 'form-control',--}}
{{--                            ]) !!}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <br>--}}
{{--                    <div class="row">--}}
{{--                        @inject('bloodType','App\Models\BloodType')--}}
{{--                        <div class="col-sm-3" style="margin-top: 5px">--}}
{{--                            {!! Form::select('blood_type_id',$bloodType->pluck('name','id')->toArray(),request('blood_type_id'),[--}}
{{--                                    'class' => 'form-control js-example-basic-single',--}}
{{--                                    'placeholder' =>'   فصيلة الدم'--}}
{{--                                ]) !!}--}}
{{--                        </div>--}}
{{--                        @inject('city','App\Models\City')--}}
{{--                        <div class="col-sm-3" style="margin-top: 5px">--}}
{{--                            {!! Form::select('city_id',$city->pluck('name','id')->toArray(),request('city_id'),[--}}
{{--                                    'class' => 'form-control js-example-basic-single',--}}
{{--                                    'placeholder' =>'    المدينة'--}}
{{--                                ]) !!}--}}
{{--                        </div>--}}
{{--                        @inject('govern','App\Models\Governorate')--}}
{{--                        <div class="col-sm-3" style="margin-top: 5px">--}}
{{--                            {!! Form::select('governorate_id',$govern->pluck('name','id')->toArray(),request('governorate_id'),[--}}
{{--                                    'class' => 'form-control js-example-basic-single',--}}
{{--                                    'placeholder' =>'  المحافظة'--}}
{{--                                ]) !!}--}}
{{--                        </div>--}}
{{--                        <div class="col-md-3" style="margin-top:5px ">--}}
{{--                            <button type="submit" class="btn btn-primary btn-block"><i--}}
{{--                                    class="fa fa-search"></i> @lang('site.search')</button>--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--            <hr>--}}

            <div>
                <a href="{{route('roles.create')}}" class="btn btn-primary"><i class="fa fa-plus">
                    </i> اضافة رتبه جديده</a>
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
                        <td>الاسم المعروض</td>
                        <td>الوصف</td>
                        <td class="text-center">تعديل</td>
                        <td class="text-center">حذف</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($records as $record)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$record->name}}</td>
                            <td>{{$record->display_name}}</td>
                            <td>{{$record->description}}</td>
                            <td class="text-center">
                                <a href="{{route('roles.edit', $record->id)}}" class="btn btn-success btn-xs">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </td>
                            <td class="text-center">

                                {!! Form::open([
                                    'action' => ['Dashboard\RoleController@destroy' , $record->id],
                                    'method' => 'delete'
                                ]) !!}

                                <button type="submit" onclick="return confirm('هل أنت متأكد ؟')" class=" btn-danger btn-xs"><i class="fa fa-trash"></i>
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

    @endif
    <!-- /.box-body -->


        </div>

        <!-- /.box -->

        <!-- /.content -->

    </section>

@endsection




