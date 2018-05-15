@extends('layouts.app')

@section('content')
<div class="content">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Hello Guys,</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    Thanks to use this application. Please endorse me for my skills in <a href="https://www.linkedin.com/in/brnrajoriya/">LinkedIn</a> and give appritiation on my <a href="https://github.com/brnrajoriya/">GitHub</a> Profile.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
