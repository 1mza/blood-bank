@inject('bloodTypes','App\Models\BloodType')
@inject('clients','App\Models\Client')
@inject('cities','App\Models\City')
<?php
$options = [];
foreach ($bloodTypes::all() as $bloodType) {
    $options[$bloodType->id] = $bloodType->name;
}
$clientslist = [];
foreach ($clients::all() as $client) {
    $clientslist[$client->id] = $client->email;
}
$citieslist = [];
foreach ($cities::all() as $city) {
    $citieslist[$city->id] = $city->name;
}
?>
{{ html()->label('Patient Name', 'patient_name')->class('form-label') }}
{{ html()->text('patient_name', $donation_request->patient_name ?? null)->class('form-control')->id('patient_name')->placeholder('إسم المريض') }}

{{ html()->label('Patient Phone', 'patient_phone')->class('form-label') }}
{{ html()->text('patient_phone', $donation_request->patient_phone ?? null)->class('form-control')->id('patient_phone')->placeholder('رقم الهاتف') }}

{{ html()->label('Patient Age', 'patient_age')->class('form-label') }}
{{ html()->text('patient_age', $donation_request->patient_age ?? null)->class('form-control')->id('patient_age')->placeholder('عمر المريض') }}

{{ html()->label('Blood Type', 'blood_type_id')->class('form-label') }}
{{ html()->select('blood_type_id', $options, $donation_request->blood_type_id ?? null)->class('form-control')->placeholder('اختر نوع فصيلة الدم') }}

{{ html()->label('Client', 'client_id')->class('form-label') }}
{{ html()->select('client_id', $clientslist, $donation_request->client_id ?? null)->class('form-control')->placeholder('اختر بريد المستخدم') }}

{{ html()->label('Client', 'city_id')->class('form-label') }}
{{ html()->select('city_id', $citieslist, $donation_request->city_id ?? null)->class('form-control')->placeholder('اختر المدينة') }}

{{ html()->label('Hospital', 'Hospital')->class('form-label') }}
{{ html()->text('hospital', $donation_request->hospital ?? null)->class('form-control')->id('hospital')->placeholder('إسم المستشفي') }}

{{ html()->label('Hospital Address', 'hospital_address')->class('form-label') }}
{{ html()->text('hospital_address', $donation_request->hospital_address ?? null)->class('form-control')->id('hospital_address')->placeholder('عنوان المستفي') }}

{{ html()->label('Bags Number', 'bags_num')->class('form-label') }}
{{ html()->text('bags_num', $donation_request->bags_num ?? null)->class('form-control')->id('bags_num')->placeholder('عدد اكياس الدم') }}

{{ html()->label('Details', 'details')->class('form-label') }}
{{ html()->text('details', $donation_request->details ?? null)->class('form-control')->id('details')->placeholder('التفاصيل') }}

{{ html()->label('Latitude', 'latitude')->class('form-label') }}
{{ html()->text('latitude', $donation_request->latitude ?? null)->class('form-control')->id('latitude')->placeholder('خط العرض') }}

{{ html()->label('Longitude', 'longitude')->class('form-label') }}
{{ html()->text('longitude', $donation_request->longitude ?? null)->class('form-control')->id('longitude')->placeholder('خط الطول') }}



{{ html()->submit('Submit')->class('btn btn-success') }}
