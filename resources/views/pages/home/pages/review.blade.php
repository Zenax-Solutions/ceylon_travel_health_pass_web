@extends('layouts.app')
@section('content')
<!-- Live Chat -->
@include('pages.home.components.chatwidget')

@livewire('review-form')

@endsection