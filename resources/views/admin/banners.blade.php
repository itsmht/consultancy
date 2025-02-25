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
                                <h5 class="card-header">Banners</h5> 
                                <a href="#" class="btn btn-primary ml-auto" data-toggle="modal" data-target="#exampleModal">Add Banner</a>
                                <div class="card-body">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Title</th>
                                                <th scope="col">Description</th>
                                                <th scope="col">Banner Image</th>
                                                <th scope="col">Banner Video</th>
                                                <th scope="col">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($banners as $banner)
                                            <tr>
                                                <th scope="row">{{$banner->banner_id}}</th>
                                                <td>{{$banner->title}}</td>
                                                <td>{{$banner->description}}</td>
                                                <td><img style="width:30px; height:30px;" src="{{$banner->image_path}}" alt="img" ></td>
                                                <td><img style="width:30px; height:30px;" src="{{$banner->video_path}}" alt="vdo" ></td>
                                                <td>{{$banner->status}}</td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="3">There are no Banners.</td>
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
                            <h5 class="modal-title" id="exampleModalLabel">Add Banner</h5>
                            <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                            </a>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('createBanner')}}" method="POST" enctype="multipart/form-data">
                                {{@csrf_field()}}
                                <div class="form-group">
                                    <label for="category_name" class="col-form-label">Title</label>
                                    <input id="category_name" name="title" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="category_description" class="col-form-label">Description</label>
                                    <input id="category_description" name="description" type="text" class="form-control">
                                </div>
                                
                                <!-- Radio buttons for selecting Image or Video -->
                                <div class="form-group">
                                    <label class="col-form-label">Banner Type</label>
                                    <div >
                                        <input type="radio" id="imageOption" name="banner_type" value="image" checked> 
                                        <label class="btn btn-primary" for="imageOption">Image</label>
                            
                                        <input type="radio" id="videoOption" name="banner_type" value="video"> 
                                        <label class="btn btn-primary" for="videoOption">Video</label>
                                    </div>
                                </div>
                            
                                <!-- Image Upload Field -->
                                <div class="form-group" id="imageUpload">
                                    <label for="category_logo" class="col-form-label">Banner Image</label>
                                    <div class="custom-file">
                                        <input type="file" name="image_path" class="custom-file-input" id="category_logo">
                                        <label class="custom-file-label" for="category_logo">Choose File</label>
                                    </div>
                                    <small class="form-text text-muted">Accepted formats: JPG, PNG, JPEG</small>
                                </div>
                            
                                <!-- Video Upload Field (Initially Hidden) -->
                                <div class="form-group" id="videoUpload" style="display: none;">
                                    <label for="category_banner" class="col-form-label">Banner Video</label>
                                    <div class="custom-file">
                                        <input type="file" name="video_path" class="custom-file-input" id="category_banner">
                                        <label class="custom-file-label" for="category_banner">Choose File</label>
                                    </div>
                                    <small class="form-text text-muted">Accepted formats: MP4, MKV, MOV, AVI</small>
                                </div>
                            
                                <div class="modal-footer">
                                    <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                                    <button type="submit" class="btn btn-success">Save</button>
                                </div>
                            </form>
              </div>
              </div>
              <script>
                document.addEventListener("DOMContentLoaded", function() {
                    // Get radio buttons and upload fields
                    const imageOption = document.getElementById("imageOption");
                    const videoOption = document.getElementById("videoOption");
                    const imageUpload = document.getElementById("imageUpload");
                    const videoUpload = document.getElementById("videoUpload");
            
                    // Function to toggle visibility
                    function toggleBannerFields() {
                        if (imageOption.checked) {
                            imageUpload.style.display = "block";
                            videoUpload.style.display = "none";
                        } else {
                            imageUpload.style.display = "none";
                            videoUpload.style.display = "block";
                        }
                    }
            
                    // Attach event listeners to radio buttons
                    imageOption.addEventListener("change", toggleBannerFields);
                    videoOption.addEventListener("change", toggleBannerFields);
                });
            </script>
    @include('layouts.js')