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
                                <h5 class="card-header">Testimonials</h5> 
                                <a href="#" class="btn btn-primary ml-auto" data-toggle="modal" data-target="#exampleModal">Add Testimonial</a>
                                <div class="card-body">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Designation</th>
                                                <th scope="col">Company</th>
                                                <th scope="col">Description</th>
                                                <th scope="col">Rating</th>
                                                <th scope="col">Image</th>
                                                <th scope="col">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($testimonials as $testimonial)
                                            <tr>
                                                <th scope="row">{{$testimonial->testimonial_id}}</th>
                                                <td>{{$testimonial->client_name}}</td>
                                                <td>{{$testimonial->designation}}</td>
                                                <td>{{$testimonial->company}}</td>
                                                <td>{{$testimonial->desctiption}}</td>
                                                <td>{{$testimonial->rating}}</td>
                                                <td><img style="width:30px; height:30px;" src="{{$testimonial->image_path}}" alt="img" ></td>
                                                @if($testimonial->status == '1')
                                                <td><span class="badge-dot badge-success mr-1"></span>Active</td>
                                                @else
                                                <td><span class="badge-dot badge-brand mr-1"></span>Inactive</td>
                                                @endif
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="3">There are no Testimonials.</td>
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
                            <h5 class="modal-title" id="exampleModalLabel">Add Testimonial</h5>
                            <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                            </a>
                        </div>
                        <div class="modal-body">
                        <form action="{{route('createTestimonial')}}" method="POST" enctype="multipart/form-data">
                        {{@csrf_field()}}
                    <div class="form-group">
                        <label for="category_name" class="col-form-label">Client Name</label>
                        <input id="category_name" name="client_name" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="category_name" class="col-form-label">Designation</label>
                        <input id="category_name" name="designation" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="category_name" class="col-form-label">Company</label>
                        <input id="category_name" name="company" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="category_name" class="col-form-label">Description</label>
                        <input id="category_name" name="description" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="category_name" class="col-form-label">Rating (Between 1-5)</label>
                        <input id="category_name" name="rating" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="category_logo" class="col-form-label">Client Image</label>
                        <div class="custom-file">
                            <input type="file" name="image_path" class="custom-file-input" id="category_logo" name="category_file">
                            <label class="custom-file-label" for="category_logo">Choose File</label>
                        </div>
                            <small class="form-text text-muted">Accepted formats are JPG,PNG and JPEG</small>
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