@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Competition</div>
                <div class="panel-body">
                    
                    
                    {!! Form::model($competition, ['route' => ['competition.update',$competition->id],'class'=>'form-horizontal']) !!}
                    
                        {{ Form::token() }}
                        {{ method_field('PATCH') }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Competition Name</label>

                            <div class="col-md-6">
                                {{ Form::text('name',null,["class"=> 'form-control'])}}
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>


                        <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                            <label for="code" class="col-md-4 control-label">Registeration Code</label>

                            <div class="col-md-6">
                                {{ Form::text('code',null,["class"=> 'form-control'])}}
                                @if ($errors->has('code'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                        <div class="form-group">

                            <div class="col-md-2 col-md-offset-4">
                                <a class="btn btn-outline-primary" href="{{ route('home') }}">Cancel</a>
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

