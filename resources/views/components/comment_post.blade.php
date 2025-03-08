@foreach($post as $key => $val)
@include('template.comment',['val'=>$val])
@endforeach