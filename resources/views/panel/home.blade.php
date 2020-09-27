@extends('layouts.app', ['activePage' => 'home', 'titlePage' => __('Home')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-danger card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">account_box</i>
                            </div>
                            <p class="card-category">وضعیت حساب کاربری</p>
                            <h3 class="card-title">{{__($status)}}</h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                @if ($status == 'pending' or $status == 'new')
                                    <i class="material-icons">policy</i>
                                    مدارک خود را تکمیل کنید.
                                @elseif ($status == 'confirmed')
                                    <i class="material-icons">check_box</i>
                                    حساب کاربری شما فعال است.
                                @elseif ($status == 'restricted' or $status == 'limited')
                                    <i class="material-icons">policy</i>
                                    حساب کاربری شما محدود شده است.
                                @elseif ($status == 'blocked')
                                    <i class="material-icons">policy</i>
                                    حساب کاربری شما بلاک شده است.
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-info card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">local_offer</i>
                            </div>
                            <p class="card-category">پیشنهادات فعال</p>
                            <h3 class="card-title">۰
                                <small>پیشنهاد</small>
                            </h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons text-success">add</i>
                                <a href="#pablo">پیشنهاد جدید</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-success card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">store</i>
                            </div>
                            <p class="card-category">تعداد فروش</p>
                            <h3 class="card-title">۰
                                <small>عدد</small>
                            </h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons">date_range</i> در بیست و چهار ساعت گذشته
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-warning card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">pending_actions</i>
                            </div>
                            <p class="card-category">پیشنهادات در انتظار تایید</p>
                            <h3 class="card-title">۱
                                <small>پیشنهاد</small>
                            </h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons">update</i>پس از بررسی و تایید، بر روی سایت قرار خواهد گرفت.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection