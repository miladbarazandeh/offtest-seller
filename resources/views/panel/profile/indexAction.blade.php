@extends('layouts.app', ['activePage' => 'profile', 'titlePage' => __('User Profile')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card ">
                        <div class="card-header  card-header-danger">
                            <p class="card-category">پروفایل</p>
                        </div>
                        <div class="card-body ">
                            @if (session('status'))
                                <div class="row">
                                    <div class="col-sm-10">
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
                            <div class="row">
                                <div class="col-sm-4">
                                    <label class="col-sm-4 col-form-label">نام</label>
                                    <input class="text-center" type="text" name="end_at" value="{{$seller['name']}}" disabled/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-4">
                                    <label class="col-sm-4 col-form-label">شماره</label>
                                    <input class="text-center" type="text" name="end_at" value="{{$seller['phone']}}" disabled/>
                                </div>
                                <div class="col-sm-4">
                                    <label class="col-sm-4 col-form-label">وضعیت تایید شماره</label>
                                    <input class="text-center" type="text" name="end_at" value="{{$seller['phone_verified_at'] ? 'تایید شده' : 'در انتظار تایید'}}" disabled/>
                                </div>
                                @if(!$seller['phone_verified_at'])
                                    <a href=""><button class="btn btn-rose">تایید شماره</button></a>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <label class="col-sm-4 col-form-label">ایمیل</label>
                                    <input class="text-center" type="text" name="end_at" value="{{$seller['email']}}" disabled/>
                                </div>
                                <div class="col-sm-4">
                                    <label class="col-sm-4 col-form-label">وضعیت تایید ایمیل</label>
                                    <input class="text-center" type="text" name="end_at" value="{{$seller['email_verified_at'] ? 'تایید شده' : 'تایید نشده'}}" disabled/>
                                </div>
                                @if(!$seller['email_verified_at'] and $seller['email'])
                                    <a href=""><button class="btn btn-rose">تایید ایمیل</button></a>
                                @elseif(!$seller['email'])
                                    <a href=""><button class="btn btn-rose">ثبت ایمیل</button></a>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <label class="col-sm-4 col-form-label">وضعیت کاربری</label>
                                    <input class="text-center" type="text" name="end_at" value="{{__($seller['status'])}}" disabled/>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="text-center col-sm-3">
                                    <a href="{{route('panel.profile.edit')}}"><button class="btn btn-rose col-sm-12">ویرایش پروفایل</button></a>
                                    <small class="text-danger text-center col-sm-12">جهت تایید اکانت باید مشخصات خود را کامل کنید.</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection