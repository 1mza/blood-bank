

{{ html()->label('Notification Settings Text', 'notification_settings_text')->class('form-label') }}
{{ html()->textarea('notification_settings_text', $settings->notification_settings_text ?? null)->class('form-control')->id('notification_settings_text')->placeholder('نص اعدادات الاشعارات') }}


{{ html()->label('About app AR', 'about_app_ar')->class('form-label') }}
{{ html()->textarea('about_app_ar', $settings->about_app_ar ?? null)->class('form-control')->id('about_app_ar')->placeholder('عن التطبيق') }}

{{ html()->label('Intro Text AR 1', 'intro_text_ar_1')->class('form-label') }}
{{ html()->textarea('intro_text_ar_1', $settings->intro_text_ar_1 ?? null)->class('form-control')->id('intro_text_ar_1')->placeholder('مقدمه الموقع الاولي') }}

{{ html()->label('Intro Text AR 2', 'intro_text_ar_2')->class('form-label') }}
{{ html()->textarea('intro_text_ar_2', $settings->intro_text_ar_2 ?? null)->class('form-control')->id('intro_text_ar_2')->placeholder('مقدمه الموقع الثانية') }}


{{ html()->label('Intro Text AR 3', 'intro_text_ar_3')->class('form-label') }}
{{ html()->textarea('intro_text_ar_3', $settings->intro_text_ar_3 ?? null)->class('form-control')->id('intro_text_ar_3')->placeholder('مقدمه الموقع الثالثة') }}


{{ html()->label('About app EN', 'about_app_en')->class('form-label') }}
{{ html()->textarea('about_app_en', $settings->about_app_en ?? null)->class('form-control')->id('about_app_en')->placeholder('About app') }}

{{ html()->label('Intro Text EN 1', 'intro_text_en_1')->class('form-label') }}
{{ html()->textarea('intro_text_en_1', $settings->intro_text_en_1 ?? null)->class('form-control')->id('intro_text_en_1')->placeholder('intro 1 english') }}

{{ html()->label('Intro Text EN 2', 'intro_text_en_2')->class('form-label') }}
{{ html()->textarea('intro_text_en_2', $settings->intro_text_en_2 ?? null)->class('form-control')->id('intro_text_en_2')->placeholder('intro 2 english') }}


{{ html()->label('Intro Text EN 3', 'intro_text_en_3')->class('form-label') }}
{{ html()->textarea('intro_text_en_3', $settings->intro_text_en_3 ?? null)->class('form-control')->id('intro_text_en_3')->placeholder('intro 3 english') }}

{{ html()->label('Promoting text AR', 'promoting_text_ar')->class('form-label') }}
{{ html()->textarea('promoting_text_ar', $settings->promoting_text_ar ?? null)->class('form-control')->id('promoting_text_ar')->placeholder('نص ترويجي للبرنامج') }}

{{ html()->label('Promoting text EN', 'promoting_text_en')->class('form-label') }}
{{ html()->textarea('promoting_text_en', $settings->promoting_text_en ?? null)->class('form-control')->id('promoting_text_en')->placeholder('promoting text for apps') }}




{{ html()->submit('Submit')->class('btn btn-success') }}
