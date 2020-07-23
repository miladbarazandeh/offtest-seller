@extends('layouts.app', ['activePage' => 'promotions', 'titlePage' => "پیشنهادها"])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-danger">
                            <p class="card-category">پیشنهادها</p>
                        </div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="alert alert-success">
                                            <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                <i class="material-icons">close</i>
                                            </button>
                                            <span>{{ session('status') }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <form class="col-5">
                                <div class="input-group no-border">
                                    <input type="text" name= "q" value="" class="form-control" placeholder="جستجو...">
                                    <button type="submit" class="btn btn-white btn-round btn-just-icon">
                                        <i class="material-icons">search</i>
                                        <div class="ripple-container"></div>
                                    </button>
                                </div>
                            </form>
                            <div class="col-12 text-right">
                                <a href="{{Route('panel.promotion.edit', 0)}}" class="btn btn-sm btn-primary">اضافه کردن پیشنهاد جدید</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                    <th>
                                        عنوان
                                    </th>
                                    <th>
                                        قیمت اصلی
                                    </th>
                                    <th>
                                        قیمت تست
                                    </th>
                                    <th>
                                        باقی‌مانده
                                    </th>
                                    <th>
                                        استفاده شده
                                    </th>
                                    <th>
                                    </th>
                                    </thead>
                                    <tbody>
                                    @foreach($promotions as $promotion)
                                        <tr>
                                            <td>
                                                {{$promotion['title']}}
                                            </td>
                                            <td>
                                                {{$promotion['full_price']}}
                                            </td>
                                            <td>
                                                {{$promotion['tester_price']}}
                                            </td>
                                            <td>
                                                {{$promotion['available_product_count']}}
                                            </td>
                                            <td>
                                                {{$promotion['used_product_count']}}
                                            </td>
                                            <td>
                                                <a href="{{Route('panel.promotion.edit', $promotion['id'])}}"><button class="btn btn-primary btn-round">ویرایش</button></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection