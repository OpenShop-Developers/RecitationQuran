@if(Session::has('flash_message'))
    <script>
        Swal.fire(
            'أحسنت !',
            '{{session()->get('flash_message')}}',
            'success'
        )
    </script>

@endif
