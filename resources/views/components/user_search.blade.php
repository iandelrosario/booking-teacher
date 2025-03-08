@foreach($result as $key => $val)
@include('template.user',['type'=>'userSearch', 'follower' => $val->follower,'paypal_email_address' => $val->paypal_email_address,'username' => $val->username, 'fullname' => $val->fullname, 'profile' => $val->profile, 'count_post' => $val->count_post, 'count_followers' => $val->count_followers, 'count_following' => $val->count_following])
@endforeach