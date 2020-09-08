@extends('dashboard.layouts.app')

@section('title')
    التحكم في التسجيلات
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
                        <form action="{{ route('records.filter') }}" method="get">
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
                                <div class="col-md-6" style="margin-top:5px ">
                                    <button type="submit" class="btn btn-primary btn-block"> @lang('ابحث الان') <i
                                            class="fa fa-search"></i></button>
                                </div>
                                <div class="col-sm-3" style="margin-top: 5px">
                                    @inject('client','App\models\Client')
                                    {!! Form::select('client_id', $client->pluck('name', 'id')->toArray(),request('client_id'),[
                                            'class' => 'form-control js-example-basic-single',
                                            'placeholder' =>'العميل'
                                        ]) !!}
                                </div>
                                <div class="col-sm-3" style="margin-top: 5px">
                                    @inject('user','App\User')
                                    {!! Form::select('user_id', $user->pluck('name', 'id')->toArray(),request('user_id'),[
                                            'class' => 'form-control js-example-basic-single',
                                            'placeholder' =>'المحفظ'
                                        ]) !!}
                                </div>
                        </form>
                    </div>
                </div>

            </div>
            <hr>

        @include('flash::message')
        @if(count($records))
            <div class="table-responsive">
                <table class="table table-bordered table-hover" style="page-break-inside: avoid">
                    <thead>
                    <tr>
                        <td>#</td>
                        <td>التسجيل</td>
                        <td>مرسل من العميل</td>
                        <td>مرسل الي المحفظ</td>
                        <td class="text-center">حذف</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($records as $record)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>
                                <audio controls>
                                    <source src="{{asset('uploads/audio/'. $record->record)}}" type="audio/wav">
                                </audio></td>
                            <td>{{$record->client->name}}</td>
                            <td>{{$record->user->name}}</td>
                            <td class="text-center">

                                {!! Form::open([
                                    'action' => ['Dashboard\RecordController@destroy' , $record->id],
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
                {{$records->render()}}

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




