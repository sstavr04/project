@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Question</div>
                <div class="panel-body">
                    {!! Form::model($question, ['route' => ['question.update',$competition->id,$quiz->id,$question->id],'class'=>'form-horizontal']) !!}
                    
                        {{ Form::token() }}

                        <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                            <label for="body" class="col-md-4 control-label">Question</label>

                            <div class="col-md-6">
                                {{ Form::textarea('body',null,["class"=> 'form-control'])}}
                                @if ($errors->has('body'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('correct_points') ? ' has-error' : '' }}">
                            <label for="correct_points" class="col-md-4 control-label">Points for correct answer</label>

                            <div class="col-md-6">
                                
                                {{ Form::number('correct_points',null,[ "class"=> 'form-control',"step"=>0.1, "min"=>0])}}
                                @if ($errors->has('correct_points'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('correct_points') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('wrong_points') ? ' has-error' : '' }}">
                            <label for="wrong_points" class="col-md-4 control-label">Cost points for wrong answer</label>
                            <div class="col-md-6">                 
                                {{ Form::number('wrong_points',null,["class"=> 'form-control',"step"=>0.1, "min"=>0])}}
                                @if ($errors->has('wrong_points'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('wrong_points') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        

                        <div class="form-group{{ $errors->has('minutes') ? ' has-error' : '' }}">
                        <div class="form-group{{ $errors->has('seconds') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Time to answer(minutes, seconds)</label>
                            <div class="col-md-6">
                                <div class="col-md-6">

                                    {{ Form::number('minutes',null,["class"=> 'form-control',"step"=>1, "min"=>0,"max"=>60])}}
                                    @if ($errors->has('minutes'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('minutes') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="col-md-6">

                                    {{ Form::number('seconds',null,["class"=> 'form-control',"step"=>1, "min"=>0,"max"=>60])}}
                                    @if ($errors->has('seconds'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('seconds') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        </div>

                        <div class="form-group">

                            <div class="col-md-2 col-md-offset-4">
                                <a class="btn btn-outline-primary" href="{{route('quiz.show',['competition'=>$competition->id,'quiz'=>$quiz->id])}}">Cancel</a>
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



