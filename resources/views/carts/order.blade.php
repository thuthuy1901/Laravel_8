@extends('main')

@section('content')
    @include('admin.alert')
    <div class="container p-t-150 p-b-300" width="80%">
        <div class="flex-w flex-sb-m ">
            <div class="flex-w flex-c-m m-tb-10">
                <div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search ">
                    <i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
                    <i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                    Tìm kiếm
                </div>
            </div>
            <!-- Search product -->

            <form action="../../searchOrders" method="POST" class="dis-none panel-search w-full p-t-10 p-b-15"
                style="display: none;">

                <div class="bor8 dis-flex p-l-15">

                    <button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
                        <i class="zmdi zmdi-search"></i>
                    </button>

                    <input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search"
                        placeholder="Nhập email hoặc sđt">
                    @csrf

                </div>
            </form>

        </div>

        @yield('order')

    </div>
@endsection
