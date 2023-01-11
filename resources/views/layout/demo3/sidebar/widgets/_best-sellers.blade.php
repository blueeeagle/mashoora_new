@php
    $items = array(
        array(
            'image' => 'stock/600x400/img-1.jpg',
            'title' => 'Spotify App',
            'desc' => 'HTML, SASS, Bootstrap'
        ),
        array(
            'image' => 'stock/600x400/img-2.jpg',
            'title' => 'Fitnes Drive',
            'desc' => 'Angular, Typescript, Bootstrap'
        ),
        array(
            'image' => 'stock/600x400/img-3.jpg',
            'title' => 'Taskify App',
            'desc' => 'HTML, CSS. jQuery'
        ),
        array(
            'image' => 'stock/600x400/img-5.jpg',
            'title' => 'Calendr App',
            'desc' => 'React, MangoDb. Node'
        ),
        array(
            'image' => 'stock/600x400/img-6.jpg',
            'title' => 'Stocked SaaS',
            'desc' => 'PHP, Laravel, Oracle'
        )
    );
@endphp
<!--begin::Best Sellers Widget-->
<div class="card card-flush card-p-0 shadow-none bg-transparent mb-5">
    <!--begin::Header-->
    <div class="card-header align-items-center">
        <!--begin::Title-->
        <h3 class="card-title fw-bolder text-white fs-3">Best Sellers</h3>
        <!--end::Title-->

        <!--begin::Toolbar-->
        <div class="card-toolbar">
            <button type="button" class="btn btn-icon btn-icon-white btn-active-color-primary me-n4" data-kt-menu-trigger="click" data-kt-menu-overflow="true" data-kt-menu-placement="bottom-end">
                {!! theme()->getSvgIcon("icons/duotune/general/gen024.svg", "svg-icon-2") !!}
            </button>
            {{ theme()->getView('partials/menus/_menu-3') }}
        </div>
        <!--end::Title-->
    </div>
    <!--end::Header-->

    <!--begin::Body-->
    <div class="card-body">
        @foreach($items as $item)
            <!--begin::Item-->
            <div class="d-flex flex-nowrap align-items-center {{ next($items) ? 'mb-7' : '' }}">
                <!--begin::Image-->
                <div class="symbol symbol-40px symbol-2by3 me-4">
                    <img src="{{ asset(theme()->getMediaUrlPath() . $item['image']) }}" alt="" class="mw-100"/>
                </div>
                <!--end::Image-->

                <!--begin::Title-->
                <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pe-3">
                    <a href="#" class="text-white fw-bold text-hover-primary fs-6">
                        {{ $item['title'] }}
                    </a>
                    <span class="sidebar-text-muted fw-bold fs-7 my-1">
                        {{ $item['desc'] }}
                    </span>
                </div>
                <!--end::Title-->
            </div>
            <!--end::Item-->
        @endforeach
    </div>
    <!--end: Card Body-->
</div>
<!--end::Best Sellers Widget-->
