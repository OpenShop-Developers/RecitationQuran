<div class="form-group">


    <div class="col-md-12">
        <label for="about_app">عن الموقع</label>
        {!! Form::text('about_website',null,[
            'class' =>'form-control'
        ]) !!}
    </div>

    <div class="clearfix"></div>
    <br>

    <div class="col-md-12">
        <label for="fb_link">حساب الفيسبوك</label>
        {!! Form::text('facebook_link',null,[
            'class' =>'form-control'
        ]) !!}
    </div>

    <div class="clearfix"></div>
    <br>

    <div class="col-md-12">
        <label for="tw_link">حساب تويتر</label>
        {!! Form::text('twitter_link',null,[
            'class' =>'form-control'
        ]) !!}
    </div>

    <div class="clearfix"></div>
    <br>

    <div class="col-md-12">
        <label for="inst_link">حساب انستجرام</label>
        {!! Form::text('instagram_link',null,[
            'class' =>'form-control'
        ]) !!}
    </div>

    <div class="clearfix"></div>
    <br>

    <div class="col-md-12">
        <label for="youtube_link">حساب جوجل</label>
        {!! Form::text('google_link',null,[
            'class' =>'form-control'
        ]) !!}
    </div>

    <div class="col-md-12">
        <label for="phone">رقم الهاتف</label>
        {!! Form::text('phone',null,[
            'class' =>'form-control'
        ]) !!}
    </div>

    <div class="col-md-12">
        <label for="email">البريد الالكتروني</label>
        {!! Form::text('email',null,[
            'class' =>'form-control'
        ]) !!}
    </div>

    <div class="col-md-12">
        <button class="btn btn-primary" type="submit">تأكيد</button>
    </div>
</div>


</div>

