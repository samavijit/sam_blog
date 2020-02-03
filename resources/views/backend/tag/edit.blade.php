@extends('layouts.backend.main')

@section('title', 'MyBlog | Edit Tag')

@section('content')

<?php //dd($post->tag_id);?>

    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Tag
          <small>Edit tag</small>
        </h1>
        <ol class="breadcrumb">
          <li>
              <a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
          </li>
          <li><a href="{{ route('backend.tags.index') }}">Tag</a></li>
          <li class="active">Edit Tag</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
          <div class="row">
          	 <form action="{{ route('backend.tags.update',$tag->id) }}" id="post-form" method="post" enctype="multipart/form-data">
                    	
                    	@csrf
                    	@method('put')

            <div class="col-xs-12">
              <div class="box">
	                <div class="box-body ">
	                   
						<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
							<label for="title">Tag Title</label>

							<input type="text" name="name" value="{{ old('name',$tag->name)  }}" class="form-control" placeholder="tag Title">
							
							@if($errors->has('name'))
								<span class="help-block">{{ $errors->first('name') }}</span>
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
						<a href="{{ route('backend.tags.index') }}" class="btn btn-default">Cancel</a>
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
