<table class="table table-bordered">
                            <thead>
                                <tr>
                                    <td width="80">Action</td>
                                    <td >Title</td>
                                    <td width="120">Author</td>
                                    <td width="150">Category</td>
                                    <td width="170">Date</td>
                                </tr>
                            </thead>
                            <tbody>
                              <?php $request = request(); ?>
                                @foreach($posts as $post)

                                    <tr>
                                        <td width="100px">

                                          <form action="{{ route('backend.blog.restore', $post->id) }}" id="post-form" method="post" style="display: inline;">
                                              @csrf
                                              @method('put')
                                              @if(check_user_permissions($request,"Blog@restore",$post->id))
                                                <button type="submit" class="btn btn-xs btn-default" title="Restore">
                                                <i class="fa fa-refresh"></i>
                                                </button>
                                              @else
                                                <button type="button" onclick="return false;" class="btn btn-xs btn-default disabled" title="Restore">
                                                <i class="fa fa-refresh"></i>
                                                </button>
                                              @endif
                                           </form>

                                            <form action="{{ route('backend.blog.force-destroy', $post->id) }}" id="post-form" method="post" style="display: inline;">
                                              @csrf
                                              @method('delete')  
                                              @if(check_user_permissions($request,"Blog@forceDestroy",$post->id))
                                               <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure?')" title="Delete Permanent">
                                                <i class="fa fa-times"></i>
                                               </button>
                                               @else
                                                <button type="button" onclick="return false;" class="btn btn-xs btn-default disabled" title="Delete Permanent">
                                                <i class="fa fa-times"></i>
                                                </button>
                                              @endif

                                            </form>
                                           
                                        </td>
                                        <td>{{ $post->title }}</td>
                                        <td>{{ $post->author->name }}</td>
                                        <td>{{ $post->category->title }}</td>
                                        <td>
                                            <abbr title="{{ $post->dateFormatted(true) }}">{{ $post->dateFormatted() }}</abbr> 
                                            
                                        </td>
                                    </tr>

                                @endforeach
                            </tbody>
                        </table>