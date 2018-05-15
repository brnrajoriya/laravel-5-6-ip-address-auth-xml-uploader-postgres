@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Admin Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You can access this page because your IP Address is authenticated, you are loggedin and you have admin access as well!
                </div>
            </div>
            <div class="card-header">
                <a href="{{ route('admin.ips') }}">
                    <button type="button" class="btn btn-primary">
                        {{ __('IPs') }}
                    </button>
                </a>
                <a href="{{ route('admin.xmls') }}">
                    <button type="button" class="btn btn-primary">
                        {{ __('XMLs') }}
                    </button>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
