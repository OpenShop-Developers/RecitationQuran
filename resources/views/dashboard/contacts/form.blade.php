@inject('contact','App\Models\Contact')

<div class="form-group">

    <label for="name">الرساله</label>
    {!! Form::text('message',null,[
        'class' =>'form-control',
        'disabled'
    ]) !!}

    <br>

    <hr>
    <h3>يمكنك الرد علي الرساله هنا </h3>
    <hr>
    <label for="name">الرد</label>
    {!! Form::textarea('message_reply',null,[
        'class' =>'form-control'
    ]) !!}

    <br>

    <br>

    <button class="btn btn-primary" type="submit">تأكيد</button>

</div>




