<table class="table table-bordered">
                            <thead>
                                <tr>
                                    <td width="80">Action</td>
                                    <td>User Name</td>
                                    <td>Email</td>
                                    <td>Role</td>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php $currentUser = auth()->user();
                                   // dd($currentUser->roles->first()->display_name);
                                ?>
                                @foreach($users as $user)

                                    <tr>
                                        <td width="100px">

                                            <a href="{{ route('backend.user.edit', $user->id) }}" class="btn btn-xs btn-default">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                                
                                            @if($user->id == config('cms.default_user_id') || $user->id == $currentUser->id)
                                               <button class="btn btn-xs btn-danger disabled" onclick="return false;">
                                                <i class="fa fa-times"></i>
                                               </button>
                                            @else
                                                 <a href="{{ route('backend.user.confirm', $user->id) }}" class="btn btn-xs btn-default">
                                                <i class="fa fa-times"></i>
                                            </a>

                                            @endif

                                         
                                           
                                        </td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if($user->roles->count() > 0)
                                                {{ $user->roles->first()->display_name  }}
                                            @else
                                                {{ "---" }}
                                            @endif
                                        </td>
                                      
                                    </tr>

                                @endforeach
                            </tbody>
                        </table>