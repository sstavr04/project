@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Quiz</div>
                <div class="panel-body">
                    
                    
                    {!! Form::model($quiz,['route' => ['quiz.update','competition'=>$competition->id,'quiz'=>$quiz->id],'class'=>'form-horizontal']) !!}
                    
                        {{ Form::token() }}
           

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Quiz Name</label>

                            <div class="col-md-6">
                                {{ Form::text('name',null,["class"=> 'form-control'])}}
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>


                        <div class="form-group">

                            <div class="col-md-2 col-md-offset-4">
                                <a class="btn btn-outline-primary" href="{{ route('competition.show',$competition->id) }}">Cancel</a>
                            </div>
                            <div class="col-md-2">
                                {{ Form::submit('Save Changes', array('class' => 'btn btn-primary')) }}
                            </div>
                        </div>
            

                    {!! Form ::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

