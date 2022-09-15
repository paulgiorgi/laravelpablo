@php
$form_values = $model::$form_fields;
@endphp

<div class="form-group row mb-3">
    <label class="col-3">Nome</label>
    <div class="col-9">
        <input name="name" class="form-control form-control-solid" type="text" value="{{ old('name', !empty($item->name) ? $item->name : '') }}" required>
    </div>
</div>
