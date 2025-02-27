@include('layouts.header')
@include('layouts.topbar')
@include('layouts.sidebar')

<div class="dashboard-wrapper">
    <div class="container-fluid  dashboard-content">
        <div class="row">
            <div class="col-xl-12 col-lg-6 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <h5 class="card-header">Banners</h5>
                    <a href="#" class="btn btn-primary ml-auto" data-toggle="modal" data-target="#exampleModal">Add Banner</a>
                    <div class="card-body">
                        <table id="bannerTable" class="table table-hover">
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
                                    <td><img style="width:30px; height:30px;" src="{{$banner->image_path}}" alt="img"></td>
                                    <td><img style="width:30px; height:30px;" src="{{$banner->video_path}}" alt="vdo"></td>
                                    <td>{{$banner->status}}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6">There are no Banners.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footer')
    </div>
</div>

<!-- Modal for Adding Banners -->
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
                <form id="bannerForm" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="category_name" class="col-form-label">Title</label>
                        <input id="category_name" name="title" type="text" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="category_description" class="col-form-label">Description</label>
                        <input id="category_description" name="description" type="text" class="form-control" required>
                    </div>

                    <!-- Radio buttons for selecting Image or Video -->
                    <div class="form-group">
                        <label class="col-form-label">Banner Type</label>
                        <div>
                            <input type="radio" id="imageOption" name="banner_type" value="image" checked>
                            <label class="btn btn-primary" for="imageOption">Image</label>

                            <input type="radio" id="videoOption" name="banner_type" value="video">
                            <label class="btn btn-primary" for="videoOption">Video</label>
                        </div>
                    </div>

                    <!-- Image Upload Field -->
                    <div class="form-group" id="imageUpload">
                        <label for="image_path" class="col-form-label">Banner Image</label>
                        <div class="custom-file">
                            <input type="file" name="image_path" class="custom-file-input" id="image_path" accept="image/*">
                            <label class="custom-file-label" for="image_path">Choose File</label>
                        </div>
                        <small class="form-text text-muted">Accepted formats: JPG, PNG, JPEG</small>
                        <small id="selectedImageFileName" class="form-text text-primary"></small>
                    </div>

                    <!-- Video Upload Field (Initially Hidden) -->
                    <div class="form-group" id="videoUpload" style="display: none;">
                        <label for="video_path" class="col-form-label">Banner Video</label>
                        <div class="custom-file">
                            <input type="file" name="video_path" class="custom-file-input" id="video_path" accept="video/*">
                            <label class="custom-file-label" for="video_path">Choose File</label>
                        </div>
                        <small class="form-text text-muted">Accepted formats: MP4, MKV, MOV, AVI</small>
                        <small id="selectedVideoFileName" class="form-text text-primary"></small>
                    </div>

                    <!-- Progress Bar -->
                    <div class="progress mt-2" style="display: none;">
                        <div class="progress-bar" role="progressbar" style="width: 0%;"></div>
                    </div>

                    <div class="modal-footer">
                        <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Include SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const imageOption = document.getElementById("imageOption");
    const videoOption = document.getElementById("videoOption");
    const imageUpload = document.getElementById("imageUpload");
    const videoUpload = document.getElementById("videoUpload");

    function toggleBannerFields() {
        imageUpload.style.display = imageOption.checked ? "block" : "none";
        videoUpload.style.display = videoOption.checked ? "block" : "none";
    }

    imageOption.addEventListener("change", toggleBannerFields);
    videoOption.addEventListener("change", toggleBannerFields);

    $("#bannerForm").submit(function(e) {
        e.preventDefault();

        let formData = new FormData(this);
        let progressBar = $(".progress");
        let progressBarFill = $(".progress-bar");

        $.ajax({
            url: "{{ route('createBanner') }}",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {
                progressBar.show();
                progressBarFill.css("width", "0%");
            },
            xhr: function() {
                let xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        let percentComplete = (evt.loaded / evt.total) * 100;
                        progressBarFill.css("width", percentComplete + "%");
                    }
                }, false);
                return xhr;
            },
            success: function(response) {
                Swal.fire({
                    icon: "success",
                    title: "Success!",
                    text: response.message,
                    timer: 2000,
                    showConfirmButton: false
                });

                $("#bannerTable tbody").append(`
                    <tr>
                        <td>${response.banner.banner_id}</td>
                        <td>${response.banner.title}</td>
                        <td>${response.banner.description}</td>
                        <td><img src="${response.banner.image_path}" style="width:30px; height:30px;"></td>
                        <td>${response.banner.video_path ? `<video width="30" height="30" controls><source src="${response.banner.video_path}"></video>` : ''}</td>
                        <td>${response.banner.status}</td>
                    </tr>
                `);

                $("#exampleModal").modal("hide");
                $("#bannerForm")[0].reset();
            },
            error: function(xhr) {
                Swal.fire("Error", "Upload failed!", "error");
            },
            complete: function() {
                progressBar.hide();
            }
        });
    });
});
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Get the file input elements
        const videoInput = document.getElementById("video_path");
        const imageInput = document.getElementById("image_path");

        // Get the display elements for the selected file names
        const videoFileNameDisplay = document.getElementById("selectedVideoFileName");
        const imageFileNameDisplay = document.getElementById("selectedImageFileName");

        // Add event listener for video input
        if (videoInput) {
            videoInput.addEventListener("change", function () {
                if (videoInput.files.length > 0) {
                    videoFileNameDisplay.textContent = "Selected video: " + videoInput.files[0].name;
                } else {
                    videoFileNameDisplay.textContent = ""; // Clear if no file is selected
                }
            });
        }

        // Add event listener for image input
        if (imageInput) {
            imageInput.addEventListener("change", function () {
                if (imageInput.files.length > 0) {
                    imageFileNameDisplay.textContent = "Selected image: " + imageInput.files[0].name;
                } else {
                    imageFileNameDisplay.textContent = ""; // Clear if no file is selected
                }
            });
        }
    });
</script>
@include('layouts.js')
