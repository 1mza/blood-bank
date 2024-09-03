
{{ html()->label('Name', 'name')->class('form-label') }}
{{ html()->text('name',$governorate->name ?? null)->class('form-control')->id('gov-name')->placeholder('إسم المحافظة') }}
{{html()->submit('Submit')->class(' btn btn-success')}}
