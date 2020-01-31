@extends('layouts.backend.main')

@section('title', 'MyBlog | Tag index')

@section('content')

    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Tag
          <small>Display All tags</small>
        </h1>
        <ol class="breadcrumb">
          <li>
              <a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
          </li>
          <li><a href="{{ route('backend.tags.index') }}">Tag</a></li>
          <li class="active">All tags</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <div class="pull-left">
                        <a href="{{ route('backend.tags.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Add New</a>
                    </div>

                    <div class="pull-right">
                     
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body ">
                    @include('backend.partials.message')
                    @if (!$tagCount)
                        <div class="alert alert-danger">
                            <strong>No record found</strong>
                        </div>
                    @else
                          @include('backend.tag.table')
                      
                    @endif
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <div class="pull-left">
                        {{ $tags->appends(Request::query())->render() }}
                    </div>
                    <div class="pull-right">
                        <small>{{ $tagCount }} {{ str_plural('Item', $tagCount) }}</small>
                    </div>
                </div>
              </div>
              <!-- /.box -->
            </div>
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
