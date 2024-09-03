

{{ html()->label('Facebook link', 'facebook_link')->class('form-label') }}
{{ html()->text('facebook_link', $contact_us->facebook_link ?? null)->class('form-control')->id('facebook_link')->placeholder('ادخل رابط فيسبوك') }}


{{ html()->label('X link', 'x_link')->class('form-label') }}
{{ html()->text('x_link', $contact_us->x_link ?? null)->class('form-control')->id('x_link')->placeholder('ادخل رابط X') }}

{{ html()->label('Youtube link', 'youtube_link')->class('form-label') }}
{{ html()->text('youtube_link', $contact_us->youtube_link ?? null)->class('form-control')->id('youtube_link')->placeholder('ادخل رابط يوتيوب') }}

{{ html()->label('instagram link', 'instagram_link')->class('form-label') }}
{{ html()->text('instagram_link', $contact_us->instagram_link ?? null)->class('form-control')->id('instagram_link')->placeholder('ادخل رابط انستجرام') }}

{{ html()->label('google link', 'google_link')->class('form-label') }}
{{ html()->text('google_link', $contact_us->google_link ?? null)->class('form-control')->id('google_link')->placeholder('ادخل رابط جوجل') }}

{{ html()->label('whatsapp link', 'whatsapp_link')->class('form-label') }}
{{ html()->text('whatsapp_link', $contact_us->whatsapp_link ?? null)->class('form-control')->id('whatsapp_link')->placeholder('ادخل رابط واتساب') }}


{{ html()->label('Phone', 'phone')->class('form-label') }}
{{ html()->text('phone', $contact_us->phone ?? null)->class('form-control')->id('phone')->placeholder('ادخل رقم الهاتف') }}


{{ html()->label('Email', 'email')->class('form-label') }}
{{ html()->email('email', $contact_us->email ?? null)->class('form-control')->id('email')->placeholder('ادخل البريد الاكتروني') }}

{{ html()->label('Android app link', 'android_app_link')->class('form-label') }}
{{ html()->text('android_app_link', $contact_us->android_app_link ?? null)->class('form-control')->id('android_app_link')->placeholder('لينك نظام android ابليكيشن') }}

{{ html()->label('Apple app link', 'apple_app_link')->class('form-label') }}
{{ html()->text('apple_app_link', $contact_us->apple_app_link ?? null)->class('form-control')->id('apple_app_link')->placeholder('لينك نظام apple ابليكيشن') }}


{{ html()->submit('Submit')->class('btn btn-success') }}
