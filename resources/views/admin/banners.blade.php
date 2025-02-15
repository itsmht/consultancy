@include('layouts.header')
@include('layouts.topbar')
@include('layouts.sidebar')

<div class="dashboard-wrapper">
    <div class="container-fluid dashboard-content">
        <h2 class="mb-4">Banner Management</h2>

        <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addBannerModal">Add Banner</button>

        <table id="bannerTable" class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Video</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>

        @include('layouts.footer')
    </div>

    <!-- Add Banner Modal -->
    <div class="modal fade" id="addBannerModal" tabindex="-1" aria-labelledby="addBannerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="bannerForm">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Banner</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="image_path" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Video</label>
                            <input type="file" name="video_path" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@section('scripts')
<script>
$(document).ready(function() {
    let bannerTable = $('#bannerTable').DataTable({
        processing: true,
        serverSide: false, // ✅ Set to false unless using Laravel DataTables package
        ajax: {
            url: "{{ route('getBanners') }}",
            type: "GET",
            dataType: "json",
            error: function(xhr, status, error) {
                console.log("AJAX Error:", error);
            }
        },
        columns: [
            { data: 'title' },
            { data: 'description' },
            { 
                data: 'image_path', 
                render: function(data) { 
                    return data ? `<img src="/storage/${data}" width="50">` : 'No Image'; 
                }
            },
            { 
                data: 'video_path', 
                render: function(data) { 
                    return data ? `<a href="/storage/${data}" target="_blank">View</a>` : 'No Video'; 
                }
            },
            { 
                data: 'status', 
                render: function(data) { 
                    return data == 1 ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>';
                }
            },
            { 
                data: 'id', 
                render: function(id) {
                    return `
                        <button class="btn btn-warning btn-sm edit-btn" data-id="${id}">Edit</button>
                        <button class="btn btn-danger btn-sm delete-btn" data-id="${id}">Delete</button>
                    `;
                }
            }
        ]
    });

    // ✅ Add Banner AJAX Request
    $('#bannerForm').on('submit', function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        formData.append("_token", "{{ csrf_token() }}"); // CSRF Token

        $.ajax({
            type: "POST",
            url: "{{ url('/create-banner') }}",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#addBannerModal').modal('hide');
                $('#bannerForm')[0].reset();
                bannerTable.ajax.reload();
                Swal.fire("Success", response.success, "success");
            },
            error: function(xhr) {
                Swal.fire("Error", xhr.responseJSON.error || "Something went wrong!", "error");
            }
        });
    });

    // ✅ Delete Banner AJAX Request
    $(document).on('click', '.delete-btn', function() {
        let id = $(this).data('id');

        Swal.fire({
            title: "Are you sure?",
            text: "This will permanently delete the banner.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: `/delete-banner/${id}`,
                    data: { _method: "DELETE", _token: "{{ csrf_token() }}" }, // ✅ Fix DELETE method
                    success: function(response) {
                        bannerTable.ajax.reload();
                        Swal.fire("Deleted!", response.success, "success");
                    },
                    error: function(xhr) {
                        Swal.fire("Error", xhr.responseJSON.error || "Something went wrong!", "error");
                    }
                });
            }
        });
    });
});
</script>
@endsection

@include('layouts.js')
