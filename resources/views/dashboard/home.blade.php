@extends('dashboard.layouts.app')
@inject('clients' ,'App\Models\Client')
@inject('records' ,'App\Models\Record')
@inject('reviews' ,'App\Models\Review')
@inject('contacts' ,'App\Models\Contact')
@inject('users' ,'App\User')

@section('title')
    الصفحة الرئيسيه
@endsection

@section('header')
    <link rel="stylesheet" href="{{asset('dashboard/plugins/morris.js/morris.css')}}">

@endsection

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
                <div class="card-body">
                    <div class="container-fluid" style="background: #e9e9e9">
                        <!-- Content Header (Page header) -->
                        <section class="content-header">
                            <h1>
                                لوحة تحكم الموقع
                                <small>الاصدار 2.0</small>
                            </h1>
                        </section>

                        <!-- Main content -->
                        <section class="content">
                            <!-- Info boxes -->
                            <div class="row">

                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text">العملاء</span>
                                            <span class="info-box-number">{{$clients->count()}}</span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>

                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-green"><i class="fa fa-microphone "></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text">التسجيلات</span>
                                            <span class="info-box-number">{{$records->count()}}</span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>

                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-olive-active"><i class="fa fa-star"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">التقييمات</span>
                                            <span class="info-box-number">{{$reviews->count()}}</span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-teal-active"><i class="fa fa-phone"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">الرسائل</span>
                                            <span class="info-box-number">{{$contacts->count()}}</span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                </div>

                            </div>
                            <!-- /.row -->

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="box">

                                        <!-- /.box-header -->
                                        <div class="box-body">
                                            <div class="row">
                                                <div class="box box-solid bg-teal-gradient">
                                                    <div class="box-header">
                                                        <i class="fa fa-th"></i>

                                                        <h3 class="box-title">رسم بياني يوضح التسجيلات</h3>

                                                        <div class="box-tools pull-right">
                                                            <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                                                            </button>
                                                            <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="box-body border-radius-none">
                                                        <div class="chart" id="line-chart" style="height: 250px;"></div>
                                                    </div>
                                                    <!-- /.box-body -->
                                                </div>
                                                <!-- /.col -->
                                                <!-- /.col -->
                                            </div>
                                            <!-- /.row -->
                                        </div>
                                        <!-- ./box-body -->
                                    </div>
                                    <!-- /.box -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <!-- Main row -->
                            <div class="row">
                                <!-- Left col -->
                                <div class="col-md-8">
                                    <!-- MAP & BOX PANE -->
                                    <!-- /.box -->
                                    <div class="row">

                                        <!-- /.col -->
                                        <div class="col-md-12">
                                            <!-- USERS LIST -->
                                            <div class="box box-danger">
                                                <div class="box-header with-border">
                                                    <h3 class="box-title">احدث المشرفين</h3>

                                                    <div class="box-tools pull-right">
                                                        <span class="label label-danger">بوجد {{$users->count()}} مشرفين جدد</span>
                                                        <button type="button" class="btn btn-box-tool"
                                                                data-widget="collapse"><i class="fa fa-minus"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-box-tool"
                                                                data-widget="remove"><i class="fa fa-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <!-- /.box-header -->
                                                <div class="box-body no-padding">
                                                    <ul class="users-list">
                                                        @foreach($users->orderBy('id', 'desc')->take(8)->get() as $user)
                                                            <li>
                                                                <img src="{{$user->imagePath}}" height="128px"
                                                                     width="128px" alt="User Image">
                                                                <a class="users-list-name"
                                                                   href="{{route('users.edit', $user->id)}}">{{$user->name}}
                                                                </a>
                                                                <span
                                                                    class="users-list-date">{{$user->created_at->diffForHumans()}}</span>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                    <!-- /.users-list -->
                                                </div>
                                                <!-- /.box-body -->
                                                <div class="box-footer text-center">
                                                    <a href="{{route('users.index')}}" class="uppercase">عرض كل
                                                        المشرفين</a>
                                                </div>
                                                <!-- /.box-footer -->
                                            </div>
                                            <!--/.box -->
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->

                                    <!-- TABLE: LATEST ORDERS -->
                                    <div class="box box-info">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">الرسائل في الموقع</h3>

                                            <div class="box-tools pull-right">
                                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                                        class="fa fa-minus"></i>
                                                </button>
                                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                                        class="fa fa-times"></i></button>
                                            </div>
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                            <div class="table-responsive">
                                                <table class="table no-margin">
                                                    <thead>
                                                    <tr>
                                                        <th>الرساله</th>
                                                        <th>الرساله مرسله من</th>
                                                        <th>الرساله مرسله الي</th>
                                                        <th>الرد علي الرساله</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($contacts->take(10)->get() as $contact)
                                                        <tr>

                                                            <td> @if($contact->type == 2)
                                                                    <audio controls>
                                                                        <source
                                                                            src="{{asset('uploads/audio/'. $contact->message)}}">
                                                                    </audio>
                                                                @else
                                                                    {{$contact->message}}
                                                                @endif</td>
                                                            <td><a href="{{route('clients.edit', $contact->client->id)}}">

                                                                {{$contact->client->name}}

                                                                </a>
                                                            </td>
                                                            <td><a href="{{route('users.edit', $contact->user->id)}}">
                                                                    {{$contact->user->name}}
                                                                </a>
                                                            </td>
                                                            <td class="text-center">
                                                                <a href="{{url(route('contacts.edit' ,$contact->id))}}"
                                                                   class="btn btn-success btn-xs">
                                                                    <i class="fa fa-reply"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /.table-responsive -->
                                        </div>
                                        <!-- /.box-body -->
                                        <div class="box-footer clearfix text-center">
                                            <a href="{{route('contacts.index')}}" class="btn btn-sm btn-info btn-flat">عرض
                                                كافة الرسائل</a>
                                        </div>
                                        <!-- /.box-footer -->
                                    </div>
                                    <!-- /.box -->

                                    <!-- /.box -->
                                </div>
                                <!-- /.col -->

                                <div class="col-md-4">

                                    <div class="box box-default">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">احصائيات التطبيق</h3>

                                            <div class="box-tools pull-right">
                                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                                        class="fa fa-minus"></i>
                                                </button>
                                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                                        class="fa fa-times"></i></button>
                                            </div>
                                        </div>
                                        <!-- /.box-header -->
                                        <div id="piechart" style="height: 300px;"></div>
                                        <!-- /.box-body -->

                                        <!-- /.footer -->
                                    </div>
                                    <!-- /.box -->

                                    <!-- PRODUCT LIST -->
                                    <div class="box box-primary">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">اخر العملاء المضافين حديثا</h3>

                                            <div class="box-tools pull-right">
                                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                                        class="fa fa-minus"></i>
                                                </button>
                                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                                        class="fa fa-times"></i></button>
                                            </div>
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                            <ul class="products-list product-list-in-box">
                                                @foreach($clients->take(20)->get() as $client)
                                                    <li class="item">
                                                        <div class="product-info" style="margin-right:0">
                                                            <a href="{{route('users.edit', $client->id)}}"
                                                               class="product-title">{{$client->name}}
                                                            </a>
                                                            <span class="product-description">
                                                            {{$client->email}}
                                                        </span>

                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <!-- /.box-body -->
                                        <div class="box-footer text-center">
                                            <a href="{{route('clients.index')}}" class="uppercase">عرض جميع العملاء</a>
                                        </div>
                                        <!-- /.box-footer -->
                                    </div>
                                    <!-- /.box -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </section>
                        <!-- /.content -->

                    </div>

                </div>

            </div>
            <!-- /.box -->
        </div>
    </section>
    <!-- /.content -->
@endsection

@push('scripts')

    <!-- Sparkline -->
    <script src="{{asset('dashboard/plugins/jquery/dist/jquery.sparkline.min.js')}}"></script>
    <!-- Morris.js charts -->
    <script src="{{asset('dashboard/plugins/raphael/raphael.min.js')}}"></script>
    <script src="{{asset('dashboard/plugins/morris.js/morris.min.js')}}"></script>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages': ['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                ['العملاء',     <?php echo \App\Models\Client::count() ?>],
                ['التسجيلات',      <?php echo \App\Models\Record::count() ?>],
                ['الرسائل',  <?php echo \App\Models\Contact::count() ?>],
                ['التقييمات', <?php echo \App\Models\Review::count() ?>],
                ['المشرفين',    <?php echo \App\User::count() ?>]
            ]);

            var options = {
                title: 'احصائيات عن الموقع'
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
    </script>

    <script>
        /* Morris.js Charts */
        // Sales chart

        var line = new Morris.Line({
            element          : 'line-chart',
            resize           : true,
            data             : [
                @foreach($records_data as $data)
                {
                    ym: "{{$data->year}}-{{$data->month}}", count: "{{$data->total_records}}"
                },
                @endforeach
            ],
            xkey             : 'ym',
            ykeys            : ['count'],
            labels           : ['المجموع'],
            lineWidth        : 2,
            hideHover        : 'auto',
            gridTextColor    : '#fff',
            gridStrokeWidth  : 0.4,
            pointSize        : 4,
            pointStrokeColors: ['#efefef'],
            gridLineColor    : '#efefef',
            gridTextFamily   : 'Open Sans',
            gridTextSize     : 10
        });
    </script>

@endpush




