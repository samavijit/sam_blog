<table class="table table-bordered">
                            <thead>
                                <tr>
                                    <td width="80">Action</td>
                                    <td>Tag Name</td>
                                    <td width="120">Post Count</td>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tags as $tag)

                                    <tr>
                                        <td width="100px">

                                          <form action="{{ route('backend.tags.destroy', $tag->id) }}" method="post">
                                              @csrf
                                              @method('delete')
                                            <a href="{{ route('backend.tags.edit', $tag->id) }}" class="btn btn-xs btn-default">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                          
                                                <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure?')">
                                                <i class="fa fa-times"></i>
                                               </button>


                                            </form>
                                           
                                        </td>
                                        <td>{{ $tag->name }}</td>
                                        <td>{{ $tag->posts->count() }}</td>
                                      
                                    </tr>

                                @endforeach
                            </tbody>
                        </table>