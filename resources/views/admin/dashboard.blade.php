@extends('admin.layout.app')

@section('content')
<div class="col-md-10">
    <div class="card">
        <div class="card-header">{{ __('Admin Dashboard') }}</div>

        <div class="card-body">
            @include('admin.layout.message')
            {{ __('You are logged in!') }}
        </div>
    </div>
</div>
@endsection
