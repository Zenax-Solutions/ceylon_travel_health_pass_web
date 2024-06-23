@extends('layouts.destination')
@section('content')
    <livewire:records :limit='null' :title="'All Records'" :destinationMode="'true'" />
@endsection
