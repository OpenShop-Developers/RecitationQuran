@inject('roles','App\Models\Role')

<div class="form-group">

    <label for="name">الاسم</label>
    {!! Form::text('name',null,[
        'class' =>'form-control'
    ]) !!}
    <br>

    <label for="email">البريد الالكتروني</label>
    {!! Form::email('email',null,[
        'class' =>'form-control'
    ]) !!}
    <br>

    <label for="phone">رقم الهاتف</label>
    {!! Form::number('phone',null,[
        'class' =>'form-control'
    ]) !!}
    <br>

    @if(!isset($model))
    <div class="form-group">
        <label for="password">كلمة المرور</label>
        {!! Form::password('password',[
            'class' =>'form-control',
        ]) !!}
    </div>
    <br>

    <div class="form-group">
        <label for="password_confirmation">تأكيد كلمة المرور</label>
        {!! Form::password('password_confirmation',[
            'class' =>'form-control',
        ]) !!}
    </div>
    <br>
    @endif

    <label for="gender">الجنس</label>
    {!! Form::select('gender', gender(), null,[
        'class' =>'form-control'
    ]) !!}
    <br>

    <label for="image">الصوره</label>
    {!! Form::file('image', null,[
        'class' =>'form-control'
    ]) !!}
    <br>
    @if(isset($model))
        <img src="{{$model->imagePath}}" alt="main_slider" width="150">
    @endif
    <br><br>

    <div class="form-group">
        <label for="facebook_link">رابط الفيسبوك</label>
        {!! Form::text('facebook_link', null, [
            'class' =>'form-control',
        ]) !!}
    </div>
    <br>

    <div class="form-group">
        <label for="twitter_link">رابط تويتر</label>
        {!! Form::text('twitter_link', null, [
            'class' =>'form-control',
        ]) !!}
    </div>
    <br>

    <label for="roles">الرتبه</label>
    {!! Form::select('roles_list[]', $roles->pluck('display_name', 'id')->toArray(), null,[
        'id'        => 'role',
        'class'     => 'form-control select2',
        'multiple'  => 'multiple',

    ]) !!}
    <br>


    <button class="btn btn-primary" type="submit">تأكيد</button>

</div>

@push('select2')
    <script type="text/javascript" >
        $('#role').select2({
            placeholder: 'اختر رتبه',
            dir: 'rtl'
        });
    </script>
@endpush



