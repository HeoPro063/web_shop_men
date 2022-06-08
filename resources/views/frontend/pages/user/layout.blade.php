@extends('frontend.layout.frontend')

@section('more-css')
{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
<link rel="stylesheet" href="./user/css/style.css">
@endsection

@section('content')
<div class="info-content mt-5">
    <div class="container mt-5">
        <div class="row p-5">
            <div class="col-3">
                <ul class="nav nav-tabs info-menu list-inline" id="myTab" role="tablist">
                    <li class="show-name-img d-flex">
                    </li>
                    <li class=" nav-item info-list" role="presentation">
                        <button class="link-info-individual nav-link active text-start" id="account-information-tab"
                            data-bs-toggle="tab" data-bs-target="#account-information" type="button" role="tab"
                            aria-controls="account-information" aria-selected="true">
                            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24"
                                height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z">
                                </path>
                            </svg>
                            <span>
                                Thông tin tài khoản
                            </span>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link link-info-individual text-start" id="address-tab"
                            data-bs-toggle="tab" data-bs-target="#address" type="button" role="tab"
                            aria-controls="address" aria-selected="false">
                            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24"
                                height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z">
                                </path>
                            </svg> Sổ địa chỉ
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link link-info-individual text-start" id="still-follow-tab"
                            data-bs-toggle="tab" data-bs-target="#still-follow" type="button" role="tab"
                            aria-controls="still-follow" aria-selected="false">
                            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24"
                                height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.08-.14.12-.31.12-.48 0-.55-.45-1-1-1H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z">
                                </path>
                            </svg> Đơn mua
                        </button>
                    </li>
                </ul>
            </div>
            <div class="col-9">
                <div class="tab-content" id="myTabContent">
                    @include('frontend.pages.user.info', compact('user'))
                    @include('frontend.pages.user.address', compact('user'))
                    @include('frontend.pages.user.order')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('more-js')
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB"
crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
crossorigin="anonymous"></script>
<script src="./user/js/main.js"></script>
@endsection

