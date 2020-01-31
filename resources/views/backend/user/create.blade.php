@extends('layouts.backend.main')

@section('title', 'MyBlog | Add new user')

@section('content')

<?php //dd($roles);?>

    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          User
          <small>Add new user</small>
        </h1>
        <ol class="breadcrumb">
          <li>
              <a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
          </li>
          <li><a href="{{ route('backend.user.index') }}">User</a></li>
          <li class="active">Add new</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
          <div class="row">
          	 <form action="{{ route('backend.user.store') }}" id="post-form" method="post" enctype="multipart/form-data">
                    	
                    	@csrf

			            <div class="col-xs-12">
			              <div class="box">
			                <div class="box-body ">
			                   
								<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
									<label for="name">User name</label>

									<input type="text" name="name" value="{{ old('name')  }}" class="form-control" placeholder="user name">
									
									@if($errors->has('name'))
										<span class="help-block">{{ $errors->first('name') }}</span>
									@endif
								</div>

                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                  <label for="email">User email</label>

                  <input type="text" name="email" value="{{ old('email')  }}" class="form-control" placeholder="user email">
                  
                  @if($errors->has('email'))
                    <span class="help-block">{{ $errors->first('email') }}</span>
                  @endif
                </div>

                <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                  <label for="password">password</label>

                  <input type="password" name="password" value="{{ old('password')  }}" class="form-control" placeholder="user password">
                  
                  @if($errors->has('password'))
                    <span class="help-block">{{ $errors->first('password') }}</span>
                  @endif
                </div>

                <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                  <label for="password_confirmation">Password Confirmation</label>

                  <input type="password" name="password_confirmation" value="{{ old('password_confirmation')  }}" class="form-control" placeholder="user password confirmation">
                  
                  @if($errors->has('password_confirmation'))
                    <span class="help-block">{{ $errors->first('password_confirmation') }}</span>
                  @endif
                </div>

              
                <div class="form-group {{ $errors->has('role') ? 'has-error' : '' }}">
                    <label for="role">Role</label>
                  <select class="form-control" name="role" placeholder="select Role">
                  <option value="">Choose Role</option>
                  @foreach($roles as $role)
                  <option value="{{ $role->id }}" >{{ $role->display_name }}</option>
                  @endforeach

                  </select>

                  @if($errors->has('role'))
                  <span class="help-block">{{ $errors->first('role') }}</span>
                  @endif
                </div>
                       
                <div class="form-group {{ $errors->has('bio') ? 'has-error' : '' }}">
                <label for="bio">User Bio</label>

                <textarea class="form-control" name="bio" id="bio">{{ old('bio')  }}</textarea>

                @if($errors->has('bio'))
                  <span class="help-block">{{ $errors->first('bio') }}</span>
                @endif
              </div>


							</div>
							<div class="box-footer">
								<button type="submit" class="btn btn-primary">Save</button>
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
        var simplemde1 = new SimpleMDE({ element: $("#bio")[0] });
       
    </script>
@endsection
