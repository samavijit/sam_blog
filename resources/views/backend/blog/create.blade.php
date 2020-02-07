@extends('layouts.backend.main')

@section('title', 'MyBlog | Add new post')

@section('content')

<?php //dd($post->category_id);?>

    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Blog
          <small>Add new post</small>
        </h1>
        <ol class="breadcrumb">
          <li>
              <a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
          </li>
          <li><a href="{{ route('backend.blog.index') }}">Blog</a></li>
          <li class="active">Add new</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
          <div class="row">
          	 <form action="{{ route('backend.blog.store') }}" id="post-form" method="post" enctype="multipart/form-data">
                    	
                    	@csrf

            <div class="col-xs-9">
              <div class="box">
                <div class="box-body ">
                   
					<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
						<label for="title">Blog Title</label>

						<input type="text" name="title" value="{{ old('title')  }}" class="form-control" placeholder="Blog Title">
						
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

					<div class="form-group">
						<label for="excerpt">Blog Excerpt</label>

						<textarea class="form-control excerpt CodeMirror" id="excerpt" name="excerpt" placeholder="Blog Excerpt">{{ old('excerpt')  }}</textarea>
				
					</div>

					<div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
						<label for="body">Blog Description</label>

						<textarea class="form-control" name="body" id="body">{{ old('body')  }}</textarea>

						@if($errors->has('body'))
							<span class="help-block">{{ $errors->first('body') }}</span>
						@endif
					</div>

				</div>
				</div>
			</div>
			<div class="col-xs-3">
					<div class="box">
						
						<div class="box-header with-border">
                        	<h3 class="box-title">Publish Date</h3>
                    	</div>

                    	<div class="box-body">
						<div class="form-group {{ $errors->has('published_at') ? 'has-error' : '' }}">
							<label for="published_at">Publish Date</label>

							 <div class='input-group date' id='datetimepicker1'>
			                   <input type="text" class="form-control" name="published_at" value="{{ old('published_at')  }}" id="published_at" placeholder="Y-m-d H:i:s">
			                    <span class="input-group-addon">
			                        <span class="glyphicon glyphicon-calendar"></span>
			                    </span>
			                </div>

							
							
							@if($errors->has('published_at'))
								<span class="help-block">{{ $errors->first('published_at') }}</span>
							@endif
						</div>

						</div>

						<div class="box-footer clearfix">
	                        <div class="pull-left">
	                            <a id="draft-btn" class="btn btn-default">Save Draft</a>
	                        </div>
	                        <div class="pull-right">
	                        	<button type="submit" class="btn btn-primary">Publish</button> 
	                           
	                        </div>
                    	</div>
					</div>
					
					 <div class="box">
		                    <div class="box-header with-border">
		                        <h3 class="box-title">Category</h3>
		                    </div>
		                    <div class="box-body">
		                    	<div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
								<select class="form-control" name="category_id" placeholder="select category">
									<option value="">Choose Category</option>
									@foreach($categories as $category)
									<option value="{{ $category->id }}" >{{ $category->title }}</option>
									@endforeach

								</select>
								
								@if($errors->has('category_id'))
									<span class="help-block">{{ $errors->first('category_id') }}</span>
								@endif
								</div>
		                    </div>
					</div>

					<div class="box">
						<div class="box-header with-border">
							<h3 class="box-title">Category</h3>
						</div>
						<div class="box-body">

							<div class="form-group">
								<label for="title">Tags</label>
								<input type="text" name="post_tags" value="{{ old('post_tags')  }}" class="form-control" placeholder="Blog Title">
							
							</div>
						</div>
					</div>

					<div class="box">
						 <div class="box-header with-border">
		                        <h3 class="box-title">Feature Image</h3>
		                    </div>
		                    <div class="box-body text-center">
								<div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">


								<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
								<img src="http://placehold.it/200x150&text=No+Image" alt="...">
								</div>
								<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
								<div>
								<span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" class="form-control" name="image" placeholder="post image"></span>
								<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
								</div>
								</div>




								@if($errors->has('image'))
								<span class="help-block">{{ $errors->first('image') }}</span>
								@endif
								</div>

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
        var simplemde1 = new SimpleMDE({ element: $("#body")[0] });
        var simplemde2 = new SimpleMDE({ element: $("#excerpt")[0] });
        $('#datetimepicker1').datetimepicker({

        	format:'YYYY-MM-DD HH:mm:ss',
        	showClear:true
        });

        $('#draft-btn').click(function(e){
        	e.preventDefault();
        	$('#published_at').val("");
        	$('#post-form').submit();
        });
       
    </script>
@endsection
