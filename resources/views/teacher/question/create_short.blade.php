@extends('layouts.app')

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>>

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create Question</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{route('question.store',['competition'=>$competition->id,'quiz'=>$quiz->id,'type'=>0])}}">
                        {{ csrf_field() }}


                        <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                            <label for="body" class="col-md-4 control-label">Question</label>

                            <div class="col-md-6">
                                <textarea class="form-control" name="body" value="{{ old('body') }}" required autofocus>
                                </textarea>
                                @if ($errors->has('body'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('correct_answer') ? ' has-error' : '' }}">
                            <label for="correct_answer" class="col-md-4 control-label">Correct Answer</label>

                            <div class="col-md-6">
                                <input id="correct_answer" type="text" class="form-control" name="correct_answer" value="{{ old('correct_answer') }}" required>

                                @if ($errors->has('correct_answer'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('correct_answer') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('correct_points') ? ' has-error' : '' }}">
                            <label for="correct_points" class="col-md-4 control-label">Points for correct answer</label>

                            <div class="col-md-6">
                                <input id="correct_points" type="number" class="form-control" name="correct_points" value="{{ old('correct_points') }}" step="0.1" min="0" placeholder="0" required>

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
                                <input id="wrong_points" type="number" class="form-control" name="wrong_points" value="{{ old('wrong_points') }}" step="0.1" min="0"  placeholder="0" required>

                                @if ($errors->has('wrong_points'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('wrong_points') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        

                        <div class="form-group{{ $errors->has('minutes') ? ' has-error' : '' }}">
                        <div class="form-group{{ $errors->has('seconds') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Time to answer</label>
                            <div class="col-md-6">
                                <div class="col-md-6">
                                    <input id="minutes" type="number" class="form-control" name="minutes" value="{{ old('minutes') }}"  step="1" min="0" max="60" placeholder="minutes" required>

                                    @if ($errors->has('minutes'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('minutes') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="col-md-6">
                                    <input id="seconds" type="number" class="form-control" name="seconds" value="{{ old('seconds') }}" step="1" min="0" max="60" placeholder="seconds" required>

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
                            <label class="col-md-4 control-label">Add hints for this question:</label>
                            <div class="col-md-6">
                                <div class="input_hints_wrap" type="button">
                                    <button class="add_hint_button">Add Hint</button>
                                </div>
                            </div>
                        </div>
                
                            

                        <div class="form-group">
                            <div class="col-md-2 col-md-offset-4">
                                <a class="btn btn-outline-primary" href="{{route('quiz.show',['competition'=>$competition->id,'quiz'=>$quiz->id])}}">Cancel</a>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary">
                                    Create Question
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

@section('script')
<script type="text/javascript">
 
    $(document).ready(function() {
        var max_fields      = 10; //maximum input boxes allowed
        var wrapper         = $(".input_fields_wrap"); //Fields wrapper
        var add_button      = $(".add_field_button"); //Add button ID
       
        var x = 1; //initlal text box count
        $(add_button).click(function(e){ //on add input button click
            e.preventDefault();
            if(x < max_fields){ //max input box allowed
                x++; //text box increment
                $(wrapper).append('<div class="input-group"><input type="text" name="options[]" class="form-control" placeholder="Add false answer option"/><span class="input-group-addon remove_field" id="basic-addon">Remove</span></div>'); //add input box
            }
        });
       
        $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
            e.preventDefault(); $(this).parent('div').remove(); x--;
        })

        var wrapper2       = $(".input_hints_wrap"); //Fields wrapper
        var add_hint      = $(".add_hint_button"); //Add hint button ID
        var max_hints     = 3; //maximum hints
        var y=0;               //count hints
        $(add_hint).click(function(g){ //on add input button click
            g.preventDefault();
            if(y < max_hints){ //max input box allowed
                y++; //text box increment
                $(wrapper2).append('<div class="panel panel-default"><div class="form-group"><label for="hints[]" class="col-md-4 control-label">Hint</label><div class="col-md-6"><textarea class="form-control" name="hints[]" placeholder="Add Hint..." required></textarea></div><label for="hint_costs[]" class="col-md-4 control-label">Hint cost</label><div class="col-md-6"><input type="number" min="0" step="0.1" max="100" name="hint_costs[]" class="form-control" placeholder="Hint cost"/></div></div><span class="input-group-addon remove_field2" id="basic-addon">Remove</span></div>'); //add input box
            }
        });

        $(wrapper2).on("click",".remove_field2", function(g){ //user click on remove text
            g.preventDefault(); $(this).parent('div').remove(); y--;
        })
    });
 
</script>

@endsection