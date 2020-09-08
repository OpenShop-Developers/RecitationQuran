@inject('permissions','App\Models\Permission')

<div class="form-group">

    <label for="name">الاسم</label>
    {!! Form::text('name',null,[
        'class' =>'form-control'
    ]) !!}


</div>
<div class="form-group">

    <label for="display_name">الاسم المعروض</label>
    {!! Form::text('display_name',null,[
        'class' =>'form-control'
    ]) !!}


</div>
<div class="form-group">

    <label for="description">الوصف</label>
    {!! Form::textarea('description',null,[
        'class' =>'form-control',
        'rows'  => 3
    ]) !!}

</div>
<div class="form-group">

    <label for="permission_list">الصلاحيات</label><br>
    <input id="select-all" type="checkbox"><label for='select-all'>اختيار الكل</label>
    <div class="row">
        @foreach($permissions->all() as $permission)
            <div class="col-sm-3">
                <div class="checkbox" style="float: right;direction: ltr">

                        <input type="checkbox" name="permissions_list[]" value="{{$permission->id}}"

                        @if($model->hasPermission($permission->name))
                            checked
                        @endif
                        >

                    <label>
                        {{$permission->display_name}}
                    </label>
                </div>
            </div>
        @endforeach
    </div>


</div>

<br>
<button class="btn btn-primary" type="submit">تأكيد</button>


@push('scripts')
    <script>
        $("#select-all").click(function() {
            $("input[type=checkbox]").prop("checked", $(this).prop("checked"));
        });
    </script>
@endpush



