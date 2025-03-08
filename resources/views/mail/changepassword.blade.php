<p>Hi! {{Str::title($data['name'])}}</p>
<p>Please click this <a href="{{$data['url']}}"><b>link</b></a>, to change your password</p>
<p>If the provided link is not working, please copy the following URL into your browser.<br>{{$data['url']}}</p>
<p>Please note that change password link will expire after 1 hour.</p>
<p>Thank you!</p>
<p>{{config('app.name')}}</p>