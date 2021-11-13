  <!-- Edit Modal HTML -->
    <div id="{{$user->name.$user->id}}" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
        <form method="post" action="{{ route('admins.update_user', $user->id) }}">
            @method('PATCH') 
            @csrf
            <div class="modal-header">						
              <h4 class="modal-title">Update Candidat</h4>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">					
            <div class="form-group">

                <label for="first_name">Name:</label>
                <input type="text" class="form-control" name="name" value={{ $user->name }} />
                </div>

                

                <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" class="form-control" name="email" value={{ $user->email }} />
                </div>
               	
            </div>
            <div class="modal-footer">
              <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
              <input type="submit" class="btn btn-success" value="Update">
            </div>
          </form>
      </div>
    </div>
  </div>