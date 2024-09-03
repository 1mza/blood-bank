{{ html()->label('User Name', 'name')->class('form-label') }}
{{ html()->text('name')->class('form-control')->id('name')->placeholder('إسم المستخدم') }}


{{ html()->label('Email', 'email')->class('form-label') }}
{{ html()->text('email')->class('form-control')->id('email')->placeholder('البريد الإلكتروني') }}


{{ html()->label('Password', 'password')->class('form-label') }}
{{ html()->password('password')->class('form-control')->id('name')->placeholder('كلمة السر') }}

{{ html()->label('Confirm Password', 'password')->class('form-label') }}
{{ html()->password('confirm-password')->class('form-control')->id('name')->placeholder('تأكيد كلمة السر') }}


{{ html()->label('Role', 'role')->class('form-label') }}

{{ html()->select('roles[]',$roles )->class('form-control select2')->id('role')->attribute('multiple') }}

{{ html()->submit('Submit')->class('btn btn-success') }}
