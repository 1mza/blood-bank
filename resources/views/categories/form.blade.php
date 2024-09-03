{{ html()->label('Category Name', 'name')->class('form-label') }}
{{ html()->text('name', $category->name ?? null)->class('form-control')->id('cat-name')->placeholder('إسم القسم') }}
{{ html()->submit('Submit')->class('btn btn-success') }}
