@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Student Dashboard</div>

                <div class="panel-body">

                    <p>
                        <form class="form" role="search" method="GET" action="{{ route('home.student',['id'=>$id]) }}">
                            <div class ="input-group">
                                <input type="text" class="form-control" name="search" id="search" placeholder="Search Competition by ID or name..." >
                                <span class='input-group-btn'>
                                    <button class="btn btn-default" type="submit">Search
                                </span>
                            </div>
                        </form>
                    </p>
                    @if(!$searchComps->isEmpty())
                    <div class="panel panel-success panel-responsive fixed-panel ">
                        <div class="panel-heading"> <b><I>Quiz Competitions Found:</I></b></div>
                        <div class="panel-body">

                            <table class="table table-success table-responsive">
                                <thead> 
                                    <tr>
                                        <th>ID</th>
                                        <th>Competition</th>
                                        <th>Teacher</th>
                                        <th>Institution</th>
                                    </tr>
                                </thead>
                                <tbody>
        

                                    @foreach($searchComps as $comp)

                                        <tr>
                                            <th>{{$comp->id}}</th>
                                            <th><a href="{{ route('student.comp.show',['id'=>$id,'competition'=>$comp->id]) }}"> {{ $comp->name }}</a></th>
                                            <th>{{ $comp->teacher->first_name . ' ' . $comp->teacher->last_name }}</th>
                                            <th>{{ $comp->teacher->institution }}</th>
                
                                        </tr>
                                    @endforeach
        
                                </tbody>
                                
                            </table>

                        </div>
                    </div>
                    @endif                
                 
                    <div class="panel panel-primary panel-responsive fixed-panel">
                        <div class="panel-heading">My Registered Quiz Competitions:</div>
                        <div class="panel-body">
                            <table class="table table-responsive">
                                <thead> 
                                    <tr>
                                        <th>ID</th>
                                        <th>Competition</th>
                                        <th>Teacher</th>
                                        <th>Institution</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!$competitions->isEmpty())
                                        @foreach($competitions as $competition)
                                            <tr>
                                                <th>{{$competition->id}}</th>
                                                <th><a href="{{ route('student.comp.show',['id'=>$id,'competition'=>$competition->id]) }}"> {{ $competition->name }}</a></th>
                                                
                                                <th>{{ $competition->teacher->first_name .' '. $competition->teacher->last_name }}</th>
                                                    <th>{{ $competition->teacher->institution }}</th>
                                                <th><a href="#" class="btn btn-danger btn-responsive btn-sm" role="button">Deregister</a></th>
                                            </tr>
                                        @endforeach

                                    @endif
                                </tbody>

                            </table>
                            @if($competitions->isEmpty())
                                <h3><I>No registered competitions</I></h3>
                            @endif
                        </div>
                    </div>
                  
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
