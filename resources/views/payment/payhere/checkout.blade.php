@extends('layouts.app')
@section('content')
    <form method="post" action="https://sandbox.payhere.lk/pay/checkout">
        @foreach ($paymentData as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endforeach
        <input type="submit" value="Pay Now">
    </form>
@endsection
