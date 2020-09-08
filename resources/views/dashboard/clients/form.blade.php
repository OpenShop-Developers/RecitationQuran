@inject('client','App\Models\Client')

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
    <label for="gender">الجنس</label>
    {!! Form::select('gender', gender(), null,[
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
        <label for="password_confirmation">كلمة المرور</label>
        {!! Form::password('password_confirmation',[
            'class' =>'form-control',
        ]) !!}
    </div>
    <br>
 @endif

    <button class="btn btn-primary" type="submit">تأكيد</button>

</div>




