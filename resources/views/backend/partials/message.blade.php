@if(session('message'))
	<div class="alert alert-info">
		{{ session('message') }}
	</div>
	@elseif(session('error-message'))
		<div class="alert alert-danger">
			{{ session('error-message') }}
		</div>
	@elseif(session('trash-message'))
		<div class="alert alert-info">
			<?php list($message,$postId) = session('trash-message'); ?>
			{{ $message }}
			<form action="{{ route('backend.blog.restore',$postId) }}" id="post-form" method="post" >

			@csrf
			@method('put')

			<button type="submit" class="btn btn-default btn-xs">Restore</button>
			</form>
		</div>
	@endif