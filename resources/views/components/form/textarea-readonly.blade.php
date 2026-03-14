<div class="col-{{$md_size}}">
	<label class="form-label">{!! $label !!} @if($required) <star>*</star> @endif</label>
	<textarea type="text" name="{{$name}}" cols="4" rows="17" id="{{$name}}" readonly="readonly"
        @if($required) required="required" @endif class="form-control">{{$default}}</textarea>
</div>
