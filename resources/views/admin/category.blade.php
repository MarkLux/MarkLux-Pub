@extends('layout.app')

@section('content')
    <br>
    <div class="container">

        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    新建
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @if($pos == 1)
                    @include('errors.form_validation')
                    @if(!empty($update))
                        <div class="alert alert-success" role="alert">
                            操作成功
                        </div>
                    @endif
                    @endif

                <!-- New Task Form -->
                    <form action="{{ url('/admin/categories')}}" method="POST" class="form-horizontal">
                    {{ csrf_field() }}

                    <!-- Task Name -->
                        <div class="form-group">
                            <label for="category-name" class="col-sm-3 control-label">分类名</label>

                            <div class="col-sm-6">
                                <input type="text" name="name" id="task-name" class="form-control" value="{{ old('name') }}">
                            </div>
                        </div>

                        <!-- Add Task Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    +添加新分类
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Current Tasks -->
            @if (count($categories) > 0)
                <div class="panel panel-default">

                    <div class="panel-heading">
                        现有
                    </div>

                    <div class="panel-body">

                        @if($pos == 2)
                            @include('errors.form_validation')
                            @if(!empty($update))
                                <div class="alert alert-success" role="alert">
                                    操作成功
                                </div>
                            @endif
                        @endif

                        <table class="table table-striped task-table">
                            <thead>
                            <th>分类</th>
                            <th>&nbsp;</th>
                            </thead>
                            <tbody>
                            @foreach ($categories as $category)
                                @if($category->id != 1)
                                <tr>
                                    <td class="table-text"><div><a href="{{url('admin/posts/category/'.$category->id)}}">{{ $category->name }}</a></div></td>

                                    <td>
                                        <form action="{{ url('admin/categories/'.$category->id) }}" method="POST">
                                            {{ csrf_field() }}
                                            <div class="input-group">
                                                <input type="text" name="name" class="form-control">
                                                <span class="input-group-btn">
                                                    <button type="submit" class="btn btn-primary">更改名称</button>
                                                </span>
                                            </div>
                                        </form>
                                    </td>

                                    <td>
                                        <form action="{{ url('admin/categories/'.$category->id) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}

                                            <button type="submit" class="btn btn-danger" onclick="return confirmDel()">
                                                删除
                                            </button>
                                        </form>
                                    </td>

                                </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        function confirmDel()
        {
            if(confirm("您确定删除分类？\n删除该分类后原来从属于该分类的所有文章将会变为未分类"))
                return true;
            else
                return false;
        }
    </script>
@endsection