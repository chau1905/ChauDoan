@extends('admin.layout.app')
@section('title', ' category')
@section('content')
    <div class="inner-block">
        <h2>Danh sách danh mục
        </h2>
        <div class="col-md-12" style="margin-top: 20px;margin-bottom: 30px;">
            <form action="{{route('category.index')}}" method="get" role="form" class="form-add-info">
                <div class="form-group">
                    <div class="col-md-10 pull-left">
                        <input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="Nhập tên danh mục">
                    </div>
                    <div class="col-md-2">
                        <input type="submit" value="tìm kiếm" class="btn btn-info">
                    </div>
                </div>
            </form>
        </div>
        <table class="table table-condensed">
            <thead>
            <tr>
                <th>Stt</th>
                <th>Danh mục</th>
                <th>Loại danh mục</th>
                <th width="80px"></th>
            </tr>
            </thead>
            <tbody>
            @php
                $i = 1;
            @endphp
            @forelse($categories as $category)
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$category->name}}</td>
                    <td>
                        @if($category->type == \App\Category::TYPE_SERVICE)
                            Hàng nhập
                        @elseif($category->type == \App\Category::TYPE_PRODUCT)
                            Sản phẩm
                        @endif
                    </td>
                    <td><a href="{{route('category.edit.form', $category->id)}}" class="btn btn-warning ">{{trans('messages.edit_lable')}}</a></td>
                </tr>
                @php
                    $i++;
                @endphp
            @empty
                <tr>
                    <td colspan="12"><h2 class="text-center no_data">{{ trans('messages.no_data') }}</h2></td>
                </tr>
            @endforelse
            </tbody>
        </table>
        <!-- pagination -->
        <div class="row text-center">
            {{ $categories->links() }}
        </div>
    </div>
@endsection