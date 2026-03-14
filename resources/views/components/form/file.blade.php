<div class="form-group row">
    <label for="{{ $name }}" class="col-md-4 col-form-label text-md-right">{{ $label }}</label>
    <div class="col-{{$md_size}}">
        <input type="file" class="form-control" id="{{ $name }}" name="{{ $name }}" {{ $required ? 'required' : '' }}>
    </div>
</div>
