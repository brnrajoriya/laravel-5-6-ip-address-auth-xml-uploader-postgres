@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Exported XMLs
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <ul class="list-group">
                        <li class="list-group-item">
                            <form class="form-inline" method="POST" action="{{ route('admin.xmls.refresh')}}">
                                @csrf
                                <button class="mb-2 btn btn-success btn-sm" type="submit">
                                    <i class="material-icons">{{ __('Refresh') }}</i>
                                </button>
                            </form>
                        </li>
                        @foreach($xmls as $xml)
                        <li class="list-group-item">
                            <a href="{{$xml->link}}">{{$xml->title}}</a>
                            <p>{!!$xml->description!!}</p>
                        </li>
                        @endforeach
                    </ul>
                    <div class="d-flex justify-content-center">
                        {{ $xmls->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
