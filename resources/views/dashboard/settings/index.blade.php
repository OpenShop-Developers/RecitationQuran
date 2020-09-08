@extends('dashboard.layouts.app')
@section('title')
    التحكم في الاعدادات
@stop

@section('content')

    <section class="content">

        <!-- Default box -->
        <div class="box">


            <?php /*/div class="box-body">
                <form action="{{url(route('city-search'))}}" method="get" class="form-control-static">

                    <div class="row">
                        <div class="col-xs-6 col-md-4">
                            <button type="submit" class="btn btn-primary"
                                    style="width: 200px;position:absolute;right: 30px"> ابحث <i
                                    class="fa fa-search"></i>
                            </button>
                        </div>

                        <div class="col-xs-6 col-md-4">
                            {!! Form::text('name' ,null,[
                                'class' => 'form-control',
                                'placeholder' => 'ابحث',

                        ]) !!}
                        </div>
                        <div class="col-xs-6 col-md-4"> {!! Form::select('governorate_id',$governorates->pluck('name','id')->toArray(),null,[
                            'class' => 'form-control',
                            'placeholder' => 'اختر المحافظه',
                        ]) !!}
                        </div>
                    </div>
                </form>
            </div>
        */?>

            {{--            @include('flash::message')--}}

            @if(count($records))
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <td>#</td>
                            <td>عن الموقع</td>
                            <td><i class="fa fa-facebook-square fa-2x"></i></td>
                            <td><i class="fa fa-twitter-square fa-2x"></i></td>
                            <td><i class="fa fa-instagram fa-2x"></i></td>
                            <td><i class="fa fa-google-plus-square fa-2x"></i></td>
                            <td><i class="fa fa-apple fa-2x"></i></td>
                            <td><i class="fa fa-play fa-2x"></i></td>
                            <td>الهاتف</td>
                            <td>البريد الالكتروني</td>
                            <td class="text-center">تعديل</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($records as $record)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$record->about_website}}</td>
                                <td><a href="{{$record->facebook_link}}">Facebook</a></td>
                                <td><a href="{{$record->twitter_link}}">Twitter</a></td>
                                <td><a href="{{$record->instagram_link}}">Instagram</a></td>
                                <td><a href="{{$record->google_link}}">Google</a></td>
                                <td><a href="{{$record->app_store_link}}">App Store</a></td>
                                <td><a href="{{$record->google_play_link}}">Google Play</a></td>
                                <td>{{$record->phone}}</td>
                                <td>{{$record->email}}</td>
                                <td class="text-center">
                                    <a href="{{url(route('settings.edit' , $record->id))}}"
                                       class="btn btn-success btn-xs">
                                        <i class="fa fa-edit"></i></a>
                                </td>
                            </tr>

                        </tbody>
                        @endforeach

                    </table>


                </div>


            @else

                <div class="alert alert-danger" role="alert">
                    لا يوجد بيانات
                </div>
            @endif
        </div>
        <!-- /.box-body -->

        <!-- /.box -->

    </section>

    <?php
    /*@push('scripts')
         <script>
             $(".confirm").confirm({
                 text: "Are you sure you want to delete that comment?",
                 title: "Confirmation required",
                 confirm: function(button) {
                     delete(button);
                 },
                 cancel: function(button) {
                     // nothing to do
                 },
                 confirmButton: "Yes I am",
                 cancelButton: "No",
                 post: true,
                 confirmButtonClass: "btn-danger",
                 cancelButtonClass: "btn-default",
                 dialogClass: "modal-dialog modal-lg"
             });
         </script>
     @endpush*/
    ?>


@endsection




