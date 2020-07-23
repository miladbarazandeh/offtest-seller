@extends('layouts.app', ['activePage' => 'promotions', 'titlePage' => __('ویرایش پیشنهاد')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="{{ route('panel.promotion.edit.save') }}" autocomplete="off"
                          id="add-form"
                          class="form-horizontal" enctype="multipart/form-data">
                        <input name="id" type="hidden" value="{{ $promotion['id'] }}"/>
                        <input id="timezone" name="timezone" type="hidden" value=""/>
                        @csrf

                        <div class="card ">
                            <div class="card-header  card-header-danger">
                                <p class="card-category">{{ $promotion['id'] == 0 ? 'پیشنهاد جدید' : 'ویرایش پیشنهاد' }}</p>
                            </div>
                            <div class="card-body ">
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
                                <div class="row justify-content-center">
                                    <label class="col-sm-2 col-form-label">{{ __('عنوان') }}</label>
                                    <div class="col-sm-4">
                                        <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                                   name="title" id="input-title" type="text"
                                                   value="{{ old('title', $promotion['title']) }}"
                                                   required="true" aria-required="true"/>
                                            @if ($errors->has('title'))
                                                <span id="name-error" class="error text-danger"
                                                      for="input-name">{{ $errors->first('title') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row justify-content-center">
                                    <label class="col-sm-2 col-form-label">{{ __('لینک') }}</label>
                                    <div class="col-sm-4">
                                        <div class="form-group{{ $errors->has('url') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('url') ? ' is-invalid' : '' }}"
                                                   name="url" id="input-url" type="text"
                                                   value="{{ old('url', $promotion['url']) }}"
                                                   required="true" aria-required="true"/>
                                            @if ($errors->has('url'))
                                                <span id="url-error" class="error text-danger"
                                                      for="input-url">{{ $errors->first('url') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row justify-content-center">
                                    <label class="col-sm-2 col-form-label"> قیمت اصلی محصول (تومان)</label>
                                    <div class="col-sm-4">
                                        <input type="number"
                                               name="full_price"
                                               id="input-full_price"
                                               min="0"
                                               value="{{ old('full_price', $promotion['full_price']) }}"
                                               max="1000000"/>
                                        <div class="form-group{{ $errors->has('full_price') ? ' has-danger' : '' }}">
                                            @if ($errors->has('full_price'))
                                                <span id="full_price-error" class="error text-danger"
                                                      for="input-full_price">{{ $errors->first('full_price') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row justify-content-center">
                                    <label class="col-sm-2 col-form-label"> قیمت محصول برای تستر (تومان)</label>
                                    <div class="col-sm-4">
                                        <input type="number"
                                               name="tester_price"
                                               id="input-tester_price"
                                               min="0"
                                               value="{{ old('tester_price', $promotion['tester_price']) }}"
                                               max="1000000"/>
                                        <div class="form-group{{ $errors->has('tester_price') ? ' has-danger' : '' }}">
                                            @if ($errors->has('tester_price'))
                                                <span id="tester_price-error" class="error text-danger"
                                                      for="input-tester_price">{{ $errors->first('tester_price') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row justify-content-center">
                                    <label class="col-sm-2 col-form-label">تعداد محصول</label>
                                    <div class="col-sm-4">
                                        <input type="number"
                                               name="available_product_count"
                                               id="input-available_product_count"
                                               value="{{ old('available_product_count', $promotion['available_product_count']) }}"
                                               min="1" max="1000"/>
                                        <div class="form-group{{ $errors->has('available_product_count') ? ' has-danger' : '' }}">
                                            @if ($errors->has('available_product_count'))
                                                <span id="available_product_count-error" class="error text-danger"
                                                      for="input-available_product_count">{{ $errors->first('available_product_count') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row justify-content-center">
                                    <label class="col-sm-2 col-form-label">حداقل امتیاز مشتری برای این پیشنهاد</label>
                                    <div class="col-sm-4">
                                        <input type="number"
                                               name="minimum_user_experience"
                                               id="input-minimum_user_experience"
                                               value="{{ old('minimum_user_experience', $promotion['minimum_user_experience']) }}"
                                               min="0" max="1000000"/>
                                        <div class="form-group{{ $errors->has('minimum_user_experience') ? ' has-danger' : '' }}">
                                            @if ($errors->has('minimum_user_experience'))
                                                <span id="minimum_user_experience-error" class="error text-danger"
                                                      for="input-minimum_user_experience">{{ $errors->first('minimum_user_experience') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <label class="col-sm-2 col-form-label">تاریخ شروع</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="start_at" value="{{$promotion['start_at'] }}"
                                               id="input-start_at"/>
                                        <input type="hidden" name="timpestamp-start_at" value="" id="timestamp-start_at"/>
                                        <div class="form-group{{ $errors->has('timpestamp-start_at') ? ' has-danger' : '' }}">
                                            @if ($errors->has('timpestamp-start_at'))
                                                <span id="start_at-error" class="error text-danger"
                                                      for="input-start_at">{{ $errors->first('timpestamp-start_at') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>


                                <div class="row justify-content-center">
                                    <label class="col-sm-2 col-form-label">تاریخ پایان</label>
                                    <div class="col-sm-4">

                                        <input type="text" name="end_at" value="{{$promotion['end_at'] }}"
                                               id="input-end_at"/>
                                        <input type="hidden" name="timpestamp-end_at" value="" id="timestamp-end_at"/>
                                        <div class="form-group{{ $errors->has('timpestamp-end_at') ? ' has-danger' : '' }}">
                                            @if ($errors->has('timpestamp-end_at'))
                                                <span id="end_at-error" class="error text-danger"
                                                      for="input-end_at">{{ $errors->first('timpestamp-end_at') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row justify-content-center">
                                    <label class="col-sm-2 col-form-label">تصویر</label>
                                    <div class="col-sm-4">
                                        <input type="file" name="image" id="input-image" accept="image/x-png,image/gif,image/jpeg"/>
                                        <div class="form-group{{ $errors->has('image') ? ' has-danger' : '' }}">
                                            @if ($errors->has('image'))
                                                <span id="image-error" class="error text-danger"
                                                      for="input-image">{{ $errors->first('image') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row justify-content-center">
                                    <label class="col-sm-2 col-form-label">{{ __('فعال') }}</label>
                                    <div class="col-sm-4">
                                        <div class="form-group{{ $errors->has('active') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('active') ? ' is-invalid' : '' }}"
                                                   name="active" id="input-active"
                                                   type="checkbox" {{ $promotion['active'] ? 'checked' : '' }}/>
                                            @if ($errors->has('active'))
                                                <span id="name-error" class="error text-danger"
                                                      for="input-name">{{ $errors->first('active') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer ml-auto mr-auto justify-content-center">
                                    <button type="submit" class="btn btn-rose js-submit">{{ __('ذخیره') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('js') }}/persian-date.min.js" type="text/javascript"></script>
    <script src="{{ asset('js') }}/persian-datepicker.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            var startAtStr = {!! json_encode($promotion['start_at']) !!};
            var startAt = new Date();
            var endAtStr = {!! json_encode($promotion['end_at']) !!};
            var endAt = new Date();
            var timezone = "GMT " + -endAt.getTimezoneOffset()/60;
            $('#timezone').val(timezone);

            if (startAtStr) {
                startAt = new Date(startAtStr);
            }
            if (endAtStr) {
                endAt = new Date(endAtStr);
            }

            $("#timestamp-start_at").val(Math.floor(startAt.getTime()/1000));
            $("#timestamp-end_at").val(Math.floor(endAt.getTime()/1000));

            $("#input-start_at").persianDatepicker({
                timePicker: {
                    enabled: true
                },
                onSelect: function(unix){
                    $("#timestamp-start_at").val(Math.floor(unix/1000));
                },
                initialValue: true,
                initialValueType: 'gregorian'
            });

            $("#input-end_at").persianDatepicker({
                timePicker: {
                    enabled: true
                },
                onSelect: function(unix){
                    $("#timestamp-end_at").val(Math.floor(unix/1000));
                },
                initialValue: true,
                initialValueType: 'gregorian'
            });
        });
    </script>
@endpush

@section('css')
    <link rel="stylesheet" href="{{ asset('css') }}/persian-datepicker.min.css"/>
@endsection