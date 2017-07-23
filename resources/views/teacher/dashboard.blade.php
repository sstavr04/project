@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Teacher's Dashboard</div>

                <div class="panel-body">
                    
                    <div class="panel panel-primary">
                        <div class="panel-heading">My Quiz Competitions</div>
                        <div class="panel-body">

                            <a href="{{ route('competition.create') }}" class="btn btn-success btn-responsive margin-bottom" role="button">Create new competition</a>
                            <div class="table-responsive fixed-panel">
                                <table class="table table-striped ">

                                    <thead> 
                                        <tr>
                                            <th>ID</th>
                                            <th>Competition</th>
                                            <th>Reg. Code</th>
                                            <th>Created at</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(!$competitions->isEmpty())
                                        @foreach($competitions as $competition)
                                            <tr>
                                                <th>{{$competition->id}}</th>
                                                <th><a href="{{ route('competition.show',$competition->id) }}" >{{ $competition->name }}</a></th>
                                                <th>{{ $competition->code }}</th>
                                                <th>{{ $competition->created_at->toDateString()}}</th>
                                                <th>
                                                <div>   
                                                    <div class="col-md-1">
                                                        <a href="{{ route('competition.edit',$competition->id) }}" class="btn btn-primary btn-responsive btn-sm btn-primary" role="button">Edit</a>
                                                    </div>
                                                    <div class="col-md-1 col-md-offset-1"> 
                                                        {{ Form::open(['route' => ['competition.destroy', $competition->id], 'method' => 'delete']) }}
                                                            <button type="submit" class="btn btn-sm btn-responsive btn-danger" >Delete</button>
                                                        {{ Form::close() }}
                                                    </div>
                                                </div>
                                                </th>
                                            </tr>
                                        @endforeach
                                        @endif
                                    </tbody>

                                </table>
                                @if($competitions->isEmpty())
                                    <h3><I>No competitions created</I></h3>
                                @endif
                            </div>
                        </div>                    
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
