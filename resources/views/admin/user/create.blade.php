@extends('admin.layout.app')

@section('css')
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="col-md-10">
    <div class="card">
        <div class="card-header">{{ __('Add New User') }}</div>

        <div class="card-body">
            @include('admin.layout.message')
            <div class="row mb-2">
                <div class="col-md-12">
                    <form method="POST" action="{{ route('users.store') }}" id="user_create">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="name" name="name" class="form-control" id="name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email address:</label>
                            <input type="email" name="email" class="form-control" id="email">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Password:</label>
                            <input type="password" name="password" class="form-control" id="pwd">
                        </div>
                        <div class="form-group">
                            <label for="con_pwd">Confirm Password:</label>
                            <input type="password" name="password_confirmation" class="form-control" id="con_pwd">
                        </div>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
    <script type="text/javascript" src="{{ asset('js/jsvalidation.js')}}" defer></script>
    {!! JsValidator::formRequest('App\Http\Requests\CreateUserRequest', '#user_create') !!}
@endsection