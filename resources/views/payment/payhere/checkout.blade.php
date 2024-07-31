@extends('layouts.app')
@section('content')
<div class="grid grid-cols-3 grid-rows-3 place-items-center h-screen">
    <div class="col-start-2 row-start-2 ">
        <form method="post" action="https://sandbox.payhere.lk/pay/checkout">
            @foreach ($paymentData as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach
            <input style="color: blue;
            pointer: cursor;
    font-weight: 700;
    border: 1px solid black;
    padding: 20px;
    border-radius: 8px;" type="submit" value="Pay Now">
        </form>
    </div>
</div>

@endsection