@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @foreach($boards as $board)
                        <p class="text-left name">{{$board->name}}：</p>
                        <p class="lead">　　{{$board->content}}</p>
                        <p class="text-right">{{$board->time}}</p>
                        <hr>
                    @endforeach
                    {{--@yield('board')--}}
                </div>
            </div>
        </div>
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Send</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="input-group">

                                <input id="content" name="content" type="text" class="form-control" placeholder="Anything">
                                <span class="input-group-btn">
                                <button id="submit" class="btn btn-default" type="button">Go!</button>
      </span>
                            </div><!-- /input-group -->
                        </div><!-- /.col-lg-6 -->
                    </div><!-- /.row -->
                </div>
            </div>
            {{--<div class="pull-right">--}}
                {{--{{$boards->render()}}--}}
            {{--</div>--}}
        </div>
    </div>
</div>
@endsection


{{--@section('board')--}}
    {{--@foreach($boards as $board)--}}
    {{--<p class="text-left">{{$board->name}}</p>--}}
    {{--@endforeach--}}
{{--@endsection--}}