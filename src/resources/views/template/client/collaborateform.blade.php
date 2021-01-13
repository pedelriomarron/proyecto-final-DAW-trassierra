@component('mail::message')
<div class="row">
    {{$subject}}

    {{$message}}

    You can reach me via mail or telephone : {{$email}} or {{$phone_number}}


    Thanks

</div>
@endcomponent
