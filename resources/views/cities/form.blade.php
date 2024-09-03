@inject('governorates', 'App\Models\Governorate')
<?php
$options = [];
foreach ($governorates::all() as $gov) {
    $options[$gov->id] = $gov->name;
}
?>
{{ html()->label('City Name', 'name')->class('form-label') }}
{{ html()->text('name', $city->name ?? null)->class('form-control')->id('gov-name')->placeholder('إسم المدينه') }}
{{ html()->label('Governorate', 'governorate_id')->class('form-label') }}
{{ html()->select('governorate_id', $options, $city->governorate_id ?? null)->class('form-control')->placeholder('اختر المحافظة') }}
{{ html()->submit('Submit')->class('btn btn-success') }}
