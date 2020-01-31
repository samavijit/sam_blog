@extends('layouts.backend.main')

@section('title', 'MyBlog | Edit new user')

@section('content')

<?php //dd($post->user_id);?>

    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          User
          <small>Edit new User</small>
        </h1>
        <ol class="breadcrumb">
          <li>
              <a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
          </li>
          <li><a href="{{ route('backend.user.index') }}">User</a></li>
          <li class="active">Edit new</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
          <div class="row">
            <?php //dd($user->roles->first()->id);?>
          	 <form action="{{ route('backend.user.update',$user->id) }}" id="post-form" method="post" enctype="multipart/form-data">
                    	
                    	@csrf
                    	@method('put')

            <div class="col-xs-12">
              <div class="box">
	                <div class="box-body ">
	          
                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                  <label for="name">User name</label>

                  <input type="text" name="name" value="{{ old('name',$user->name)  }}" class="form-control" placeholder="user name">
                  
                  @if($errors->has('name'))
                    <span class="help-block">{{ $errors->first('name') }}</span>
                  @endif
                </div>

                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                  <label for="email">User email</label>

                  <input type="text" name="email" value="{{ old('email',$user->email)  }}" class="form-control" placeholder="user email">
                  
                  @if($errors->has('email'))
                    <span class="help-block">{{ $errors->first('email') }}</span>
                  @endif
                </div>

                <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                  <label for="password">password</label>

                  <input type="password" name="password"  class="form-control" placeholder="user password">
                  
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
                    @if($user->id == config('cms.default_user_id'))

                    <input type="hidden" name="role" value="{{ $user->roles->first()->id  }}" >
                     <p class="form-control-static">{{ $user->roles->first()->display_name }}</p>

                    @else
                      <select class="form-control" name="role" placeholder="Select Role">
                      <option value="">Choose Role</option>
                      @foreach($roles as $role)
                      <option value="{{ $role->id }}" @if($role->id == $user->roles->first()->id ) selected @endif >{{ $role->display_name }}</option>
                      @endforeach
                      </select>
                    @endif

                  @if($errors->has('role'))
                  <span class="help-block">{{ $errors->first('role') }}</span>
                  @endif
                </div>

                <div class="form-group {{ $errors->has('bio') ? 'has-error' : '' }}">
            <label for="bio">User Bio</label>

            <textarea class="form-control" name="bio" id="bio">{{ old('bio',$user->bio)  }}</textarea>

            @if($errors->has('bio'))
              <span class="help-block">{{ $errors->first('bio') }}</span>
            @endif
          </div>

						

						

					</div>
					<div class="box-footer">
						<button type="submit" class="btn btn-primary">Update</button>
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
