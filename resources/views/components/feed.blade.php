@foreach($post as $key => $val)
@include('template.feed',['val'=>$val])
@endforeach