@if (session()->has('success'))
<div class="form-group has-success">
    <label class="control-label" for="">
        {{ session()->get('success') }}
    </label>
</div>
@elseif (session()->has('error'))
<div class="form-group has-error">
    <label class="control-label" for="">
        {{ session()->get('error') }}
    </label>
</div>
@endif
