@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Quiz Competition: {{$competition->name}}</div>


                <p align="right">
                    <a href="{{ route('home') }}" class="btn btn-info btn-responsive" role="button">Back to Dashboard</a>
                </p>


                @if(!$registered)
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('student.comp.register',['id'=>$id,'competition'=>$competition->id]) }}">
                                {{ csrf_field() }}
                                
                            <div class="form-group">
                                <label for="code" class="col-md-4 control-label">Insert Registeration Code</label>

                                <div class="col-md-6">
                                    <input id="code" type="text" class="form-control" name="code" value="{{ old('code') }}">
                                </div>
                            </div>
                                
                                
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-success">
                                        Register for this competition
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                @else



                    <div class="panel-body">
                        <div class="table-responsive fixed-panel">

                            <table class="table table-sm">
                                <thead> 
                                    <tr>
                                        <th>#</th>
                                        <th>Quiz</th>
                                        <th>Teacher</th>
                                        <th>Status</th>
                                        <th></th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!$quizzes->isEmpty())
                                        @php ($i = 0)
                                        @foreach($quizzes as $quiz)
                                            <tr>
                                                @php ($i =$i + 1)
                                                <th>{{$i}}</th>
                                                <th><a href="{{ route('student.quiz.live',['competition'=>$competition->id,'quiz'=>$quiz->id]) }}" >{{ $quiz->name }}</a></th>
                                                <th>{{$competition->teacher->first_name . ' ' . $competition->teacher->last_name}}</th>
                                                @if(!$quiz->isLive)
                                                    <th>Offline</th> 
                                                @else
                                                    <th><I><b>Now Live!</I></b></th>
                                                @endif
                                                <th></th>
                                            </tr>
                                        @endforeach
                                    @endif

                                </tbody>

                            </table>
                            @if($quizzes->isEmpty())
                                <h3><I>No quizzes</I></h3>
                            @endif
                        </div>

                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection