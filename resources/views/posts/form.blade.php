@inject('categories','App\Models\Category')

<?php
$options = [];
foreach ($categories::all() as $category) {
    $options[$category->id] = $category->name;
}
?>

{{ html()->label('Post Title', 'title')->class('form-label') }}
{{ html()->text('title', $post->title ?? null)->class('form-control')->id('post-title')->placeholder('عنوان المنشور') }}

{{ html()->label('Detailed Title', 'detailed_title')->class('form-label') }}
{{ html()->text('detailed_title', $post->detailed_title ?? null)->class('form-control')->id('detailed_title')->placeholder('عنوان مفصل ما يقارب ال 100 حرف') }}

{{ html()->label('Post Image', 'image')->class('form-label') }}
@if(isset($post))
        {{ html()->img(asset('images/' . $post->image))->attribute('width', '200')->attribute('height', '150') }}
@endif
{{ html()->file('image')->class('form-control')->id('post-image') }}

{{ html()->label('Post Content', 'content')->class('form-label') }}
{{ html()->textarea('content', $post->content ?? null)->class('form-control')->id('post-content')->placeholder('محتوي المنشور') }}

{{ html()->label('Category', 'category_id')->class('form-label') }}
{{ html()->select('category_id', $options, $post->category_id ?? null)->class('form-control')->placeholder('اختر القسم') }}

{{ html()->submit('Submit')->class('btn btn-success') }}
