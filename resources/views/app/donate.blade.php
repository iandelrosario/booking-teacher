@extends('layouts.app')

@section('title', 'Donate')

@section('body')
<div class="row">
    <div class="col-md-12">
        <div class="card mt-3 hartpiece-rounded-corner">
            <div class="card-body">
                <div class="row py-5">
                    <div class="col-md-8 offset-md-2 text-center">
                        <a href="{{route('paypal.donate')}}" target="_blank" class="btn border hartpiece-color-border px-5 mb-3"><b> <img src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/PP_logo_h_100x26.png" alt="Buy now with PayPal" /></b></a>
                        <p>Thank you very much for donating to our site.</p>
                        <p>We will make sure to use this fund to maintain and improve this site.</p>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection