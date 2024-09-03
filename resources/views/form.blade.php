<form method="POST" action="{{url('form-store')}}"  enctype="multipart/form-data">
    @csrf
<input type="file" name="image">
<input type="submit">
</form>
