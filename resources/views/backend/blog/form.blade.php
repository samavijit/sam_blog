<div class="col-xs-9">
              <div class="box">
                <div class="box-body ">
                   
					<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
						<label for="title">Blog Title</label>

						<input type="text" name="title" value="{{ old('title',$post->title)  }}" class="form-control" placeholder="Blog Title">
						
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

						<textarea class="form-control excerpt CodeMirror" id="excerpt" name="excerpt" placeholder="Blog Excerpt">{{ old('excerpt',$post->excerpt)  }}</textarea>
				
					</div>

					<div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
						<label for="body">Blog Description</label>

						<textarea class="form-control" name="body" id="body">{{ old('body',$post->body)  }}</textarea>

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
			                   <input type="text" class="form-control" name="published_at" value="{{ old('published_at',$post->published_at)  }}" id="published_at" placeholder="Y-m-d H:i:s">
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
									<option value="{{ $category->id }}" @if($category->id == $post->category_id) selected @endif >{{ $category->title }}</option>
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