@if (session('error'))
    <div class="alert alert-danger msg" id="error">
    <strong>{{ session('error') }}</strong>
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success msg" id="success">
    <strong>{{ session('success') }}</strong>
    </div>
@endif