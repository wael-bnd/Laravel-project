<!DOCTYPE html>
<html>
@include('layouts.admin-resources.admin-head')
<body>
  <div class="container">
<form method="post" action="{{ route('formation.store') }}" enctype="multipart/form-data">
          @csrf

  <div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control" id="title"  placeholder="Enter title" name='title'>
              @error('title')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
  </div>
  <div class="form-group">
    <label for="description">Description</label>
    <input type="text" class="form-control" id="description"  placeholder="Enter description" name='description'>
              @error('description')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
  </div>
 
  <div class="form-group">
    <label for="link">Link</label>
    <input type="text" class="form-control" id="link"  placeholder="Enter link" name='link'>
              @error('link')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
  </div>

  <div class="form-group">
    <label for="image">Image</label>
    <input type="file" class="form-control-file" id="image" name='image'  accept = 'image/jpeg , image/jpg, image/gif, image/png'>
             @error('image')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</body>
</div>
</html>
