@extends('layouts.backend.main')

@section('title', 'MyBlog | Edit new category')

@section('content')

<?php //dd($post->category_id);?>

    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Category
          <small>Edit new category</small>
        </h1>
        <ol class="breadcrumb">
          <li>
              <a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
          </li>
          <li><a href="{{ route('backend.category.index') }}">Category</a></li>
          <li class="active">Edit new</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
          <div class="row">
          	 <form action="{{ route('backend.category.update',$category->id) }}" id="post-form" method="post" enctype="multipart/form-data">
                    	
                    	@csrf
                    	@method('put')

            <div class="col-xs-12">
              <div class="box">
	                <div class="box-body ">
	                   
						<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
							<label for="title">Category Title</label>

							<input type="text" name="title" value="{{ old('title',$category->title)  }}" class="form-control" placeholder="Category Title">
							
							@if($errors->has('title'))
								<span class="help-block">{{ $errors->first('title') }}</span>
							@endif
						</div>

						<!-- <div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
							<label for="slug"></label>

							<input type="text" name="slug" class="form-control">
							@if($errors->has('slug'))
								<span class="help-block">{{ $errors->first('slug') }}</span>
							@endif
						</div> -->

						

					</div>
					<div class="box-footer">
						<button type="submit" class="btn btn-primary">Update</button>
						<a href="{{ route('backend.category.index') }}" class="btn btn-default">Cancel</a>
					</div>
				</div>
				</div>
		
                </form>
                   
            </div>
            
        <!-- ./row -->
      </section>
      <!-- /.content -->
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        $('ul.pagination').addClass('no-margin pagination-sm');
    </script>
@endsection
