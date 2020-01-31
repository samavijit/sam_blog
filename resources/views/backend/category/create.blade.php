@extends('layouts.backend.main')

@section('title', 'MyBlog | Add new category')

@section('content')

<?php //dd($post->category_id);?>

    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Category
          <small>Add new category</small>
        </h1>
        <ol class="breadcrumb">
          <li>
              <a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
          </li>
          <li><a href="{{ route('backend.category.index') }}">Category</a></li>
          <li class="active">Add new</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
          <div class="row">
          	 <form action="{{ route('backend.category.store') }}" id="post-form" method="post" enctype="multipart/form-data">
                    	
                    	@csrf

			            <div class="col-xs-12">
			              <div class="box">
			                <div class="box-body ">
			                   
								<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
									<label for="title">Category Title</label>

									<input type="text" name="title" value="{{ old('title')  }}" class="form-control" placeholder="category Title">
									
									@if($errors->has('title'))
										<span class="help-block">{{ $errors->first('title') }}</span>
									@endif
								</div>


							</div>
							<div class="box-footer">
								<button type="submit" class="btn btn-primary">Save</button>
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
