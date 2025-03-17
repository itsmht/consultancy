@include('layouts.header')
@include('layouts.topbar')
@include('layouts.sidebar')
<div class="dashboard-wrapper">
            <div class="container-fluid  dashboard-content">
                    
                    <div class="row">
                        
                        <!-- hoverable table -->
                        <!-- ============================================================== -->
                        <div class="col-xl-12 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header">Teams</h5> 
                                <a href="#" class="btn btn-primary ml-auto" data-toggle="modal" data-target="#exampleModal">Add Team Message</a>
                                <div class="card-body">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Designation</th>
                                                <th scope="col">Video</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($teams as $team)
                                            <tr>
                                                <th scope="row">{{$team->team_id}}</th>
                                                <td>{{$team->name}}</td>
                                                <td>{{$team->designation}}</td>
                                                <td><img style="width:30px; height:30px;" src="{{$team->video_path}}" alt="img" ></td>
                                                @if($team->status == '1')
                                                <td><span class="badge-dot badge-success mr-1"></span>Active</td>
                                                @else
                                                <td><span class="badge-dot badge-brand mr-1"></span>Inactive</td>
                                                @endif
                                                <td>
                                                    <form action="{{route('delete')}}" method="POST">
                                                        {{@csrf_field()}}
                                                        <input type="hidden" name="id" value="{{$team->team_id}}">
                                                        <input type="hidden" name="model" value="Team">
                                                        <input type="hidden" name="primary_key" value="team_id">
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="3">There are no Team Messages.</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- ============================================================== -->
                        <!-- end hoverable table -->
                        <!-- ============================================================== -->
                    </div>
                    @include('layouts.footer')
                    </div>
        <!-- ============================================================== -->
        <!-- end wrapper  -->
        <!-- ============================================================== -->
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Team Message</h5>
                            <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                            </a>
                        </div>
                        <div class="modal-body">
                        <form action="{{route('createTeam')}}" method="POST" enctype="multipart/form-data">
                        {{@csrf_field()}}
                    <div class="form-group">
                        <label for="category_name" class="col-form-label">Title</label>
                        <input id="category_name" name="name" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="category_name" class="col-form-label">Designation</label>
                        <input id="category_name" name="designation" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="category_logo" class="col-form-label">Video</label>
                        <div class="custom-file">
                            <input type="file" name="video_path" class="custom-file-input" id="category_logo" name="category_file">
                            <label class="custom-file-label" for="category_logo">Choose File</label>
                        </div>
                            <small class="form-text text-muted">Accepted formats: MP4, MKV, MOV, AVI</small>
                            <small id="selectedFileName" class="form-text text-primary"></small>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                        <button type="submit" class="btn btn-primary ">Save</button>
                    </div>
             </form>
              </div>
              </div>
              <script>
                document.addEventListener("DOMContentLoaded", function () {
                    const fileInput = document.getElementById("category_logo");
                    const fileNameDisplay = document.getElementById("selectedFileName");
            
                    fileInput.addEventListener("change", function () {
                        if (fileInput.files.length > 0) {
                            fileNameDisplay.textContent = "Selected file: " + fileInput.files[0].name;
                        } else {
                            fileNameDisplay.textContent = ""; // Clear if no file is selected
                        }
                    });
                });
            </script>
    @include('layouts.js')