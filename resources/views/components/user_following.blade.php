@foreach($result as $key => $val)
@include('template.user',['type'=>'userFollowing', 'followed_user_id' => $val->followed_user_id, 'follower' => $val->userFollowing->follower,'paypal_email_address' => $val->userFollowing->paypal_email_address,'username' => $val->userFollowing->username, 'fullname' => $val->userFollowing->fullname, 'profile' => $val->userFollowing->profile, 'count_post' => $val->userFollowing->count_post, 'count_followers' => $val->userFollowing->count_followers, 'count_following' => $val->userFollowing->count_following])
@endforeach