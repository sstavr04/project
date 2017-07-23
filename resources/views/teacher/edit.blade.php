@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit your profile</div>
                <div class="panel-body">
                    {!! Form::model($user->role, ['route' => ['teacher.update',$user->role->id],'method'=>'POST','class'=>'form-horizontal']) !!}
                        {{ Form::token() }}
 

                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <label for="first_name" class="col-md-4 control-label">First Name</label>

                            <div class="col-md-6">
                                {{ Form::text('first_name',null,["class"=> 'form-control'])}}
                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>


                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label for="last_name" class="col-md-4 control-label">Last Name</label>

                            <div class="col-md-6">
                                {{ Form::text('last_name',null,["class"=> 'form-control'])}}
                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('institution') ? ' has-error' : '' }}">
                            <label for="institution" class="col-md-4 control-label">Institution/School</label>

                            <div class="col-md-6">
                                {{ Form::text('institution',null,["class"=> 'form-control'])}}

                                @if ($errors->has('institution'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('institution') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <br>
                        <div class="col-md-2 col-md-offset-4">
                            <a class="btn btn-outline-primary" href="{{ route('home.teacher',['id'=>$user->role->id]) }}">Cancel</a>
                        </div>
                        <div class="col-md-2">    
                            {{ Form::submit('Save Changes', array('class' => 'btn btn-primary')) }}
                        </div>
                        
                    {!! Form ::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

