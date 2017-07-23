@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Competition: <b><I>{{$competition->name}} </I></b>/ Quiz:<b><I> {{$quiz->name}}</b></I></div>

                <div class="panel-body">
         
                    <p align="right">
                    	<a href="{{ route('competition.show',['competition'=>$competition->id]) }}" class="btn btn-info btn-responsive" role="button">Back to Competition</a>
                    </p>

                    <div class="panel panel-primary">
                        <div class="panel-heading"><b>Questions of this quiz:</b></div>
                        <div class="panel-body">
                            <p>
                                <a href="{{ route('question.create',['competition'=>$competition->id,'quiz'=>$quiz->id,'type'=>1]) }}" class="btn btn-success btn-responsive margin-bottom" role="button">Add <b>Multiple Choice</b> Question</a>
                                <a href="{{ route('question.create',['competition'=>$competition->id,'quiz'=>$quiz->id,'type'=>0]) }}" class="btn btn-success btn-responsive" role="button">Add <b> Short Answer </b>Question</a>
                            </p>

                            @foreach($questions as $question)
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <p>
                                            <b>Question:</b> {{$question->body}}
                                        </p>
                                        @if($question->isMultiple)
                                            <ul class="list-unstyled">
                                              <li><b>Answer options: </b></li>
                                                <ul>
                                                  
                                                    @foreach($question->type as $option)
                                                        <li>
                                                            @if($option->isCorrect)
                                                                {{$option->answer}}   <b><I>Correct Answer</I></b> 
                                                            @else
                                                                {{$option->answer}}
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                
                                                </ul>
                                            </ul>
                                        @else
                                            <p>
                                                <b>Correct Answer: </b>{{$question->type->correct_answer}}
                                            </p>
                                        @endif
                                        
                                        
                                        <div class="col-md-6">   
                                            <div class="col-md-6">
                                            <a href="{{ route('question.edit',['competition'=>$competition->id,'quiz'=>$quiz->id,'question'=>$question->id]) }}" class="btn btn-primary btn-sm btn-responsive" role="button">Edit Question</a>
                                            </div>
                                            <div class="col-md-6">
                                            {{ Form::open(['route' => ['question.destroy', $competition->id,$quiz->id,$question->id], 'method' => 'delete']) }}
                                                <button type="submit" class="btn btn-responsive btn-sm btn-danger" >Delete Question</button>
                                            {{ Form::close() }}
                                            </div>
                                        </div>
                                      
                                        
                                     
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection