@extends('layouts.form')
@section('page-styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css" rel="stylesheet">
<style type="text/css">
input.form-control[readonly],textarea.form-control[readonly]{
  background-color: white;/* transparent;*/
  border: 0;
 /* font-size: 1em; */
}
</style>
@endsection
@section('content')
<div class="container" style="margin-top:20px">
    <div class="row justify-content">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                
                <div class="card-header bg-success">{{ $formheader }}</div>
                
                <div class="card-body">

                    <form id="myForm" action="/leadform/create" method="POST">
                    <input type="hidden" name="_method" value="post">
                    <input type="hidden" name="templateid" value="{{ $templateId }}">
                    <input type="hidden" name="formheader" value="{{ $formheader }}">
                    <input type="hidden" name="elements" id="elements" value="">
                    @csrf      

                    @if( isset($created_at) )
                    <label for="" class="col-form-label"><strong>Date Submitted:</strong></label>
                    <div class="form-group row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                        {{ (new \DateTime($created_at))->format('M j, Y') }}
                        </div>
                    </div>
                    @endif

                    @foreach($elements as $item)
                        @if ($item->type=='label')
                            <label for="" class="col-form-label item" eltype="label" value="{{ $item->text }}"><strong>{{ $item->text }}</strong></label>
                        @elseif($item->type=='text')
                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                              <input type="text" class="form-control item" eltype="text" name="element[]" value="" placeholder="{{ $item->text }}"
                                @if( isset($created_at) )
                                    readonly="readonly"
                                @endif
                               >
                            </div>
                        </div>
                        @elseif($item->type=='textarea')
                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <textarea class="form-control item" eltype="textarea" name="element[]" placeholder="{{ $item->text }}"
                                @if( isset($created_at) )
                                    readonly="readonly"
                                @endif
                                    ></textarea>
                            </div>
                        </div>
                        @elseif ($item->type=='emailtext')
                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                              <input type="email" class="form-control item" eltype="emailtext" name="element[]" value="" placeholder="{{ $item->text }}"
                                @if( isset($created_at) )
                                    readonly="readonly"
                                @endif
                               >
                            </div>
                        </div>
                        @endif                    
                    @endforeach

                    @if( $templateId )
                    <div class="form-group">
                        <a href="javascript:void(0);" id="submit" class="btn btn-success btn-lg">Submit</a>
                    </div>
                    @endif

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('page-scripts')
@if( $templateId )
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
<script>
$( document ).ready(function() {

    console.log( "ready!" );

    $('#submit').on('click',function(evt){
        //evt.preventDefault();

        //validate 
        var abort=false;
        //console.log('before submit');
        var elements=[];
        $('[eltype]').each(function(){
            var $el=$(this);
            //console.log($el.attr('eltype'));
            switch( $el.attr('eltype') ){
                case "label":
                    console.log($el.attr('value'));
                    elements.push({
                        type:'label',
                        text:$el.attr('value')
                    });
                    break;
                case 'text':
                    console.log($el.val());
                    elements.push({
                        type:'text',
                        text:$el.val()
                    });
                    break;
                case 'textarea':
                    console.log($el.val());
                    elements.push({
                        type:'textarea',
                        text:$el.val()
                    });
                    break;
                case 'emailtext':
                    console.log($el.val());
                    var re = /[A-Z0-9._%+-]+@[A-Z0-9.-]+.[A-Z]{2,4}/igm;
                    if( $el.val().trim()==='' ){
                        toastr.warning('Email address is required!');
                        abort=true;
                        break;
                    }else if ($el.val() == '' || !re.test($el.val())){
                        toastr.warning('Invalid email address format!');
                        abort=true;
                        break;
                    }
                    elements.push({
                        type:'emailtext',
                        text:$el.val().trim()
                    });
                    break;
            }//switch
        });//each

        if( abort ) {
            console.log('Process aborted!');
            return;
        }

        console.table(elements);
        var json=JSON.stringify(elements);
        console.table(['stringified',json]);
        //$('input[name="elements"]').val(json);
        $('#elements').val(json);
        console.log('getting elements..');
        console.log($('#elements').val());
        $('#myForm').submit();
        return true;
    });

});//ready
</script>
@endsection
@endif
