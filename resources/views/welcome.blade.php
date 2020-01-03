@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">欢迎您！</div>

                <div class="panel-body">
                    @if(auth()->guest())
                        请先登录您的应用
                    @else
                        您已经登录了！
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
