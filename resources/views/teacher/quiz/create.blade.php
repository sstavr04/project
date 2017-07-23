@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create Quiz</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{route('quiz.store',$competition->id)}}">
                        {{ csrf_field() }}
                
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Quiz Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                    
                        <div class="form-group">

                            <div class="col-md-2 col-md-offset-4">
                                <a class="btn btn-outline-primary" href="{{ route('home') }}">Cancel</a>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary">
                                    Create Quiz
                                </button>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



