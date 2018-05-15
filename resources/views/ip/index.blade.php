@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Authenticated IP's
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <ul class="list-group">
                        <li class="list-group-item">
                            <form class="form-inline" method="POST" action="{{ route('admin.ips.add')}}">
                                @csrf
                                <div class="form-group mx-sm-3 mb-2">
                                    <label for="address" class="sr-only">IP Address</label>
                                    <input name="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" value="{{ old('address') }}" id="address" placeholder="IP Address">
                                    @if ($errors->has('address'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <button class="mb-2 btn btn-success btn-sm" type="submit">
                                    <i class="material-icons">{{ __('Add') }}</i>
                                </button>
                            </form>
                        </li>
                        @foreach($ips as $ip)
                        <li class="list-group-item">
                            <form method="POST" action="{{ route('admin.ips.delete', [$ip->id])}}">
                                {{$ip->address}} 
                                {{ method_field('DELETE') }}
                                @csrf
                                <button class="float-right btn btn-outline-danger btn-sm" type="submit">
                                    <i class="material-icons">{{ __('Delete') }}</i>
                                </button>
                            </form>
                        </li>
                        @endforeach
                    </ul>
                    <div class="d-flex justify-content-center">
                        {{ $ips->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
