@inject('governorates','App\Models\Governorate')
@inject('cities','App\Models\City')
@inject('blood_types','App\Models\BloodType')

<?php
$options_gov = [];
foreach ($governorates::all() as $governorate) {
    $options_gov[$governorate->id] = $governorate->name;
}

$options_cit = [];
foreach ($cities::all() as $city) {
    $options_cit[$city->id] = $city->name;
}
$options_bt = [];
foreach ($blood_types::all() as $blood_type) {
    $options_bt[$blood_type->id] = $blood_type->name;
}
?>

{{ html()->label('Name', 'name')->class('form-label') }}
{{ html()->text('name', $client->name ?? null)->class('form-control')->id('name')->placeholder('الاسم') }}

{{ html()->label('Governorate-City', 'governorate-city')->class('form-label') }}
<livewire:dropdowns />

{{ html()->label('Email', 'email')->class('form-label') }}
{{ html()->text('email', $client->email ?? null)->class('form-control')->id('email')->placeholder('البريد الالكتروني') }}


{{ html()->label('Phone', 'phone')->class('form-label') }}
{{ html()->text('phone', $client->phone ?? null)->class('form-control')->id('phone')->placeholder('رقم الهاتف') }}

{{ html()->label('Password', 'password')->class('form-label') }}
{{ html()->password('password')->class('form-control')->id('password')->placeholder('كلمة السر') }}
{{ html()->label('Confirm Password', 'password_confirmation')->class('form-label') }}
{{ html()->password('password_confirmation')->class('form-control')->id('password_confirmation')->placeholder('تاكيد كلمة السر') }}

{{ html()->label('Birth Date', 'd_o_b')->class('form-label') }}
{{ html()->date('d_o_b', $client->d_o_b ?? null)->class('form-control')->id('d_o_b') }}


{{--{{ html()->label('Governorate', 'governorate_id')->class('form-label') }}--}}
{{--{{ html()->select('governorate_id', $options_gov, $client->governorate_id ?? null)->class('form-control')->placeholder('اختر المحافظة') }}--}}

{{--{{ html()->label('City', 'city_id')->class('form-label') }}--}}
{{--{{ html()->select('city_id', $options_cit, $client->city_id ?? null)->class('form-control')->placeholder('اختر المدينة') }}--}}
{{ html()->label('Blood Type', 'blood_type_id')->class('form-label') }}
{{ html()->select('blood_type_id', $options_bt, $client->blood_type_id ?? null)->class('form-control')->placeholder('اختر فصيلة الدم') }}

{{ html()->label('Last Donation Date', 'last_donation_date')->class('form-label') }}
{{ html()->date('last_donation_date', $client->d_o_b ?? null)->class('form-control')->id('last_donation_date') }}


{{ html()->submit('submit')->class('btn btn-success') }}
