@extends('layouts.backend.main')

@section('title', 'MyBlog | Category index')

@section('content')

    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Category
          <small>Display All Categories</small>
        </h1>
        <ol class="breadcrumb">
          <li>
              <a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
          </li>
          <li><a href="{{ route('backend.category.index') }}">Category</a></li>
          <li class="active">All Categories</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <div class="pull-left">
                        <a href="{{ route('backend.category.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Add New</a>
                    </div>

                    <div class="pull-right">
                     
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body ">
                    @include('backend.partials.message')
                    @if (!$categoryCount)
                        <div class="alert alert-danger">
                            <strong>No record found</strong>
                        </div>
                    @else
                          @include('backend.category.table')
                      
                    @endif
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <div class="pull-left">
                        {{ $categories->appends(Request::query())->render() }}
                    </div>
                    <div class="pull-right">
                        <small>{{ $categoryCount }} {{ str_plural('Item', $categoryCount) }}</small>
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
