@extends('layouts.app')
@section('styles')
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create Question</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{route('question.store',['competition'=>$competition->id,'quiz'=>$quiz->id,'type'=>1])}}">
                        {{ csrf_field() }}


                                                
                        <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Question</label>

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
                            <label for="correct_answer" class="col-md-4 control-label">Correct answer</label>

                            <div class="col-md-6">
                                <textarea class="form-control" name="correct_answer" value="{{ old('correct_answer') }}" placeholder="Write Correct Answer Option..." required>
                                </textarea>
                                @if ($errors->has('correct_answer'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('correct_answer') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                      

                        <div class="form-group">
                            <label class="col-md-4 control-label">Alternative false answers:</label>
                            <div class="col-md-6">
                                <div class="input-group control-group after-add-more">
                                    <input type="text" name="addmore[]" class="form-control" placeholder="Write Answer Option..." required>
                                    <div class="input-group-btn"> 
                                        <button class="btn btn-success add-more" type="button"><i class="glyphicon glyphicon-plus"></i> Add</button>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                        <!-- Copy Fields-These are the fields which we get through jquery and then add after the above input,-->
                                                     
                        <div class="copy-fields hide">
                            <div class="control-group input-group" style="margin-top:10px">
                                <input type="text" name="addmore[]" class="form-control" placeholder="Write Answer Option..." required>
                                <div class="input-group-btn"> 
                                  <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                                </div>
                            </div>
             
                        </div>

                        <div class="form-group{{ $errors->has('correct_points') ? ' has-error' : '' }}" style="margin-top:10px">
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
 
    //here first get the contents of the div with name class copy-fields and add it to after "after-add-more" div class.
      $(".add-more").click(function(){ 
          var html = $(".copy-fields").html();
          $(".after-add-more").after(html);
      });
    //here it will remove the current value of the remove button which has been pressed
      $("body").on("click",".remove",function(){ 
          $(this).parents(".control-group").remove();
      });
 
    });
 
</script>

@endsection


