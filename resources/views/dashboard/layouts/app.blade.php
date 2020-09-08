<!DOCTYPE html>
@inject('contacts','App\Models\Contact')
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        لوحة تحكم الموقع
        |
        @yield('title')

    </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('dashboard/plugins/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('dashboard/plugins/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('dashboard/plugins/Ionicons/css/ionicons.min.css')}}">

    <link rel="stylesheet" href="{{asset('dashboard/dist/css/skins/_all-skins.min.css')}}">

    <link rel="stylesheet" href="{{asset('dashboard/dist/css/AdminLTE-rtl.css')}}">


    <link rel="stylesheet" href="{{asset('dashboard/dist/css/skins/_all-skins-rtl.min.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://www.gstatic.com/firebasejs/7.18.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.18.0/firebase-messaging.js"></script>

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    @yield('header')
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="{{url('dashboard/home')}}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>T</b>Me</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>تطبيق تسميع القران</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages style can be found in dropdown.less -->
                    <li class="dropdown messages-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-envelope-o"></i>
                            <span class="label label-success">{{countUnreadMessages(auth()->user()->id)}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">لديك {{countUnreadMessages(auth()->user()->id)}} رساله غير مقروءه</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                @foreach(unreadMessages(auth()->user()->id) as $message)
                                <ul class="menu">
                                    <li><!-- start message -->
                                        <a href="{{route('contacts.edit', $message->id)}}">
                                            <h4>
                                                <small><i class="fa fa-clock-o"></i> {{$message->created_at->diffForHumans()}}</small>
                                                <br>
                                                 تم ارسال الرساله من العميل {{$message->client->name}}
                                            </h4>
                                            <br>
                                            <p class="pull-right">{{$message->message}}</p>
                                        </a>
                                    </li>


                                </ul>
                                @endforeach
                            </li>
                            <li class="footer"><a href="{{route('contacts.index')}}">عرض جميع الرسائل</a></li>
                        </ul>
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{auth()->user()->imagePath}}" class="user-image" alt="User Image">
                            <span class="hidden-xs">{{auth()->user()->name}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="{{auth()->user()->imagePath}}" class="img-circle" alt="User Image">
                                <p>
                                    {{auth()->user()->name}} - {{auth()->user()->gender}}
                                    <small>عضو منذ {{auth()->user()->created_at->format('y/m/d')}}</small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="{{route('users.edit', auth()->user()->id)}}" class="btn btn-warning btn-flat">الصفحة الشخصيه</a>
                                </div>
                                <div class="pull-right">
                                    <a class="btn btn-danger" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                    <li>

                    </li>
                </ul>
            </div>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->
                    <li class="dropdown messages-menu">

                        <ul class="dropdown-menu">
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <li><!-- start message -->
                                        <a href="#">
                                            <div class="pull-left">
                                                <img src="{{asset('dashboard/dist/img/user2-160x160.jpg')}}"
                                                     class="img-circle" alt="User Image">
                                            </div>
                                        </a>
                                    </li>
                                    <!-- end message -->
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- =============================================== -->

    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-right image">
                    <img src="{{auth()->user()->imagePath}}" class="img-circle"
                         alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{ auth()->user()->name }}</p>

                </div>
            </div>

            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">القائمه الرئيسيه</li>

                @if(auth()->user()->roles->first()->name == 'manager' || auth()->user()->roles->first()->name == 'supervisor')

                <li class="active treeview">
                    <a href="#">
                        <i class="fa fa-user"></i> <span>العملاء</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="active"><a href="{{route('clients.index')}}"><i class="fa fa-list"></i> كل
                                العملاء</a></li>
                        <li><a href="{{route('clients.create')}}"><i class="fa fa-plus"></i> اضافة عضو</a></li>
                        <li><a href="{{route('clients.index')}}"><i class="fa fa-trash-o"></i> حذف عضو</a></li>
                    </ul>
                </li>

                <li class=" treeview">
                    <a href="#">
                        <i class="fa fa-audio-description"></i> <span>التسجيلات</span>
                        <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>

                    <ul class="treeview-menu">
                        <li class="active"><a href="{{route('records.index')}}"><i class="fa fa-list-alt"></i> عرض
                                التسجيلات</a></li>
                        <li><a href="{{route('records.index')}}"><i class="fa fa-trash-o"></i> حذف التسجيلات</a></li>
                    </ul>
                </li>

                <li class=" treeview">
                    <a href="#">
                        <i class="fa fa-star-half-empty"></i> <span>التقييمات</span>
                        <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="active"><a href="{{route('reviews.index')}}"><i class="fa fa-list"></i> عرض
                                التقييمات</a></li>
                        <li><a href="{{route('reviews.index')}}"><i class="fa fa-trash-o"></i> حذف التقييمات</a></li>
                    </ul>
                </li>

                <li class=" treeview">
                    <a href="#">
                        <i class="fa fa-audio-description"></i> <span>الرسائل</span>
                        <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="active"><a href="{{route('contacts.index')}}"><i class="fa fa-list"></i> عرض
                                الرسائل</a></li>
                        <li><a href="{{route('contacts.index')}}"><i class="fa fa-reply"></i> الرد علي رساله</a></li>
                        <li><a href="{{route('contacts.index')}}"><i class="fa fa-trash-o"></i> حذف الرسائل</a></li>
                    </ul>
                </li>


                <li class=" treeview">
                    <a href="#">
                        <i class="fa fa-users"></i> <span>المشرفين</span>
                        <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="active"><a href="{{route('users.index')}}"><i class="fa fa-list"></i> عرض
                                المشرفين</a></li>
                        <li><a href="{{route('users.create')}}"><i class="fa fa-reply"></i>اضافة المشرفين</a></li>
                        <li><a href="{{route('users.index')}}"><i class="fa fa-reply"></i>تعديل المشرفين</a></li>
                        <li><a href="{{route('users.index')}}"><i class="fa fa-trash-o"></i> حذف مشرف</a></li>
                    </ul>
                </li>

                <li class=" treeview">
                    <a href="#">
                        <i class="fa fa-tasks"></i> <span>رتب المشرفين</span>
                        <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="active"><a href="{{route('roles.index')}}"><i class="fa fa-list"></i> عرض
                                رتب المشرفين</a></li>
                        <li><a href="{{route('roles.create')}}"><i class="fa fa-reply"></i>اضافة رتبه</a></li>
                        <li><a href="{{route('roles.index')}}"><i class="fa fa-reply"></i>تعديل رتبه</a></li>
                        <li><a href="{{route('roles.index')}}"><i class="fa fa-trash-o"></i> حذف رتبه</a></li>
                    </ul>
                </li>

                <li><a href="{{url(route('clients.index'))}}"><i class="fa fa-user-circle-o"></i><span>عرض جميع العملاء</span></a></li>
                <li><a href="{{url(route('records.index'))}}"><i class="fa fa-microphone-slash"></i><span>عرض جميع التسجيلات</span></a>
                </li>
                <li><a href="{{url(route('reviews.index'))}}"><i class="fa fa-star"></i><span>عرض جميع التقييمات</span></a></li>
                <li><a href="{{url(route('contacts.index'))}}"><i class="fa fa-phone"></i> <span>عرض جميع الرسائل</span></a>
                <li><a href="{{url(route('users.index'))}}"><i class="fa fa-users"></i><span>المشرفين</span></a></li>
                <li><a href="{{url(route('roles.index'))}}"><i class="fa fa-tasks"></i><span>رتب المشرفين</span></a></li>
                <li><a href="{{url(route('users.change_password'))}}"><i class="fa fa-key"></i><span>تغيير كلمة المرور</span></a></li>
            @elseif(auth()->user()->roles->first()->name == 'teacher' && auth()->user()->roles->first()->name == 'supervisor')

                    <li class="active treeview">
                        <a href="#">
                            <i class="fa fa-user"></i> <span>العملاء</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="active"><a href="{{route('clients.index')}}"><i class="fa fa-list"></i> كل
                                    العملاء</a></li>
                            <li><a href="{{route('clients.create')}}"><i class="fa fa-plus"></i> اضافة عضو</a></li>
                            <li><a href="{{route('clients.index')}}"><i class="fa fa-trash-o"></i> حذف عضو</a></li>
                        </ul>
                    </li>

                    <li class=" treeview">
                        <a href="#">
                            <i class="fa fa-star-half-empty"></i> <span>التقييمات</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="active"><a href="{{route('reviews.index')}}"><i class="fa fa-list"></i> عرض
                                    التقييمات</a></li>
                            <li><a href="{{route('reviews.index')}}"><i class="fa fa-trash-o"></i> حذف التقييمات</a></li>
                            <a href="{{url(route('clients.index'))}}"><i class="fa fa-user-circle-o"></i><span>عرض جميع العملاء</span></a></li>
                        </ul>
                    </li>

                    <li class=" treeview">
                        <a href="#">
                            <i class="fa fa-audio-description"></i> <span>الرسائل</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="active"><a href="{{route('contacts.index')}}"><i class="fa fa-list"></i> عرض
                                    الرسائل</a></li>
                            <li><a href="{{route('contacts.index')}}"><i class="fa fa-reply"></i> الرد علي رساله</a></li>
                            <li><a href="{{route('contacts.index')}}"><i class="fa fa-trash-o"></i> حذف الرسائل</a></li>
                        </ul>
                    </li>
                    <li><a href="{{url(route('users.change_password'))}}"><i class="fa fa-key"></i><span>تغيير كلمة المرور</span></a></li>
                    <li><a href="{{url(route('reviews.index'))}}"><i class="fa fa-star"></i><span>عرض جميع التقييمات</span></a></li>
                    <li><a href="{{url(route('contacts.index'))}}"><i class="fa fa-phone"></i> <span>عرض جميع الرسائل</span></a>
                    <li><a href="{{url(route('clients.index'))}}"><i class="fa fa-user-circle-o"></i><span>عرض جميع العملاء</span></a></li>
                @else
                    <li class=" treeview">
                        <a href="#">
                            <i class="fa fa-star-half-empty"></i> <span>التقييمات</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="active"><a href="{{route('reviews.index')}}"><i class="fa fa-list"></i> عرض
                                    التقييمات</a></li>
                            <li><a href="{{route('reviews.index')}}"><i class="fa fa-trash-o"></i> حذف التقييمات</a></li>
                        </ul>
                    </li>

                    <li class=" treeview">
                        <a href="#">
                            <i class="fa fa-audio-description"></i> <span>رسائلي</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="active"><a href="{{route('contacts.index')}}"><i class="fa fa-list"></i> عرض
                                    الرسائل</a></li>
                            <li><a href="{{route('contacts.index')}}"><i class="fa fa-reply"></i> الرد علي رسائلي</a></li>
                            <li><a href="{{route('contacts.index')}}"><i class="fa fa-trash-o"></i> حذف الرسائل</a></li>
                        </ul>
                    </li>
                    <li><a href="{{url(route('reviews.index'))}}"><i class="fa fa-star"></i><span>عرض جميع التقييمات</span></a></li>
                    <li><a href="{{url(route('contacts.index'))}}"><i class="fa fa-phone"></i> <span>عرض جميع الرسائل</span></a>
                    <li><a href="{{url(route('users.change_password'))}}"><i class="fa fa-key"></i><span>تغيير كلمة المرور</span></a></li>
                @endif









            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                @yield('title')
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('dashboard/home')}}"><i class="fa fa-home"></i> الرئيسيه</a></li>
                <li class="active">@yield('title')</li>
            </ol>
        </section>

    @yield('content')
    <!-- Main content -->

    </div>
    <!-- /.content-wrapper -->


</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{asset('dashboard/plugins/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('dashboard/plugins/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('dashboard/plugins/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dashboard/dist/js/adminlte.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{asset('dashboard/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dashboard/dist/js/demo.js')}}"></script>

<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="{{url('js/firebase.js')}}"></script>
<link rel="manifest" href="{{asset('public/mainfest.json')}}">

@include('dashboard.layouts.flash_messages')
@yield('footer')

<script>
    $(document).ready(function () {
        $('.sidebar-menu').tree()
    })
</script>

@stack('scripts')
@stack('select2')
</body>
</html>
