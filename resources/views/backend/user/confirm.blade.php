@extends('layouts.backend.main')

@section('title', 'MyBlog | Delete Confirmation')

@section('content')

    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          User
          <small>Delete Confirmation</small>
        </h1>
        <ol class="breadcrumb">
          <li>
              <a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
          </li>
          <li><a href="{{ route('backend.user.index') }}">User</a></li>
          <li class="active">Delete Confirmation</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
          <div class="row">
          	 <form action="{{ route('backend.user.destroy',$user->id) }}" id="post-form" method="post" enctype="multipart/form-data">
                    	
                    	@csrf

                    	@method('delete')

			            <div class="col-xs-12">
			              <div class="box">
			                <div class="box-body ">

							<p> You have specified this user for deletion:</p>

							<p>
							ID #{{ $user->id }}: {{ $user->name }}
							</p>
							<p>
							What should be done with content own by this user?
							</p>
							<p>
								
								<input type="radio" name="delete_option" value="delete" checked>Delete All content
							</p>
							<p>
								
								<input type="radio" name="delete_option" value="attribute">Atrribute content to:

								<select class="form-control" name="user_id" placeholder="select user">
									<option value="">Choose User</option>
									@foreach($users as $user)
									<option value="{{ $user->id }}" >{{ $user->name }}</option>
									@endforeach

								</select>
							</p>


							</div>
							<div class="box-footer">
								<button type="submit" class="btn btn-danger">Confirm Deletetion</button>
								<a href="{{ route('backend.user.index') }}" class="btn btn-default">Cancel</a>
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
