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
                                <h5 class="card-header">Portfolios</h5> 
                                <a href="#" class="btn btn-primary ml-auto" data-toggle="modal" data-target="#exampleModal">Add Portfolio</a>
                                <div class="card-body">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Title</th>
                                                <th scope="col">Description</th>
                                                <th scope="col">Portfolio Image</th>
                                                <th scope="col">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($portfolios as $portfolio)
                                            <tr>
                                                <th scope="row">{{$portfolio->portfolio_id}}</th>
                                                <td>{{$portfolio->title}}</td>
                                                <td>{{$portfolio->description}}</td>
                                                <td><img style="width:30px; height:30px;" src="{{$portfolio->image_path}}" alt="img" ></td>
                                                <td>{{$portfolio->status}}</td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="3">There are no Portfolios.</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                    {!! $portfolios->withQueryString()->links('pagination::bootstrap-5') !!}
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
                            <h5 class="modal-title" id="exampleModalLabel">Add Portfolio</h5>
                            <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                            </a>
                        </div>
                        <div class="modal-body">
                        <form action="{{route('createPortfolio')}}" method="POST" enctype="multipart/form-data">
                        {{@csrf_field()}}
                    <div class="form-group">
                        <label for="category_name" class="col-form-label">Title</label>
                        <input id="category_name" name="title" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="category_id">Portfolio Category</label>
                            <select class="form-control" name="portfolio_category_id" id="category_id">
                                <option value="">Please Select Category</option>
                                   @foreach ($categories as $category)
                                        <option value="{{$category->portfolio_category_id}}" {{$category->category == $category->portfolio_category_id  ? 'selected' : ''}}>{{$category->title}}</option>
                                   @endforeach
                            </select>
                            @error('portfolio_category_id')
                                <span class="text-danger">{{$message}}</span><br>
                            @enderror
                    </div>
                    <div class="form-group">
                        <label for="category_name" class="col-form-label">Description</label>
                        <input id="category_name" name="description" type="textbox" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="category_logo" class="col-form-label">Portfolio Image</label>
                        <div class="custom-file">
                            <input type="file" name="image_path" class="custom-file-input" id="category_logo" name="category_file">
                            <label class="custom-file-label" for="category_logo">Choose File</label>
                        </div>
                            <small class="form-text text-muted">Accepted formats are JPG,PNG and JPEG</small>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                        <button type="submit" class="btn btn-primary ">Save</button>
                    </div>
             </form>
              </div>
              </div>
    @include('layouts.js')