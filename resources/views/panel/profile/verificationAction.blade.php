@extends('layouts.app', ['activePage' => 'profile', 'titlePage' => __('ویرایش پروفایل')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <form method="post" autocomplete="off"
                          id="add-form"
                          class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-header card-header-rose">
                                <p class="card-category">کد تایید</p>
                            </div>
                            <div class="card-body">
                                @if (session('status'))
                                    <div class="row">
                                        <div class="col-sm-4">
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
                                    <span id="time"></span>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-sm-4">
                                        <div class="form-group{{ $errors->has('code') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }} text-center"
                                                   name="code" id="input-code" type="number"
                                                   value="{{ old('code') }}"
                                                   required="true" aria-required="true"/>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center col-sm-10">
                                        @if ($errors->has('code'))
                                            <span id="code-error" class="error text-danger"
                                                  for="input-code">{{ $errors->first('code') }}</span>
                                        @endif
                                    </div>
                                </div>
                                    <div class="card-footer ml-auto mr-auto justify-content-center">
                                        <button type="submit" class="btn btn-rose js-submit">{{ __('تایید') }}</button>
                                        <button style="display: none;" type="submit" class="btn btn-rose js-retry">{{ __('ارسال مجدد') }}</button>
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
    <script>
        function startTimer(duration, display) {
            var timer = duration, minutes, seconds;
            var timerInterval = setInterval(function () {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.textContent = translateFa(minutes) + ":" + translateFa(seconds);

                if (--timer < 0) {
                    $('#input-code').attr('disabled', true);
                    $('.js-submit').hide();
                    $('.js-retry').show();
                    clearInterval(timerInterval);
                }
            }, 1000);
        }

        window.onload = function () {
            var ttl = {!! json_encode($time) !!};
            var display = document.querySelector('#time');
            startTimer(ttl, display);

            $('.js-retry').on('click', () => window.location.reload());

        };
    </script>
@endpush