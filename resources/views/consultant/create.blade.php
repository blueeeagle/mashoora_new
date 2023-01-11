<x-base-layout>
    @section('styles')
    <link href="{{ URL::asset(theme()->getDemo().'/plugins/custom/jstree/jstree.bundle.css')}}" rel="stylesheet" type="text/css" />
        <style>
            .stepper.stepper-pills .stepper-item.skip .stepper-icon .stepper-number {
                color: #ffffff !important;
                font-size: 1.35rem;
            }
            .stepper.stepper-pills .stepper-item.skip .stepper-icon {
                transition: color 0.2s ease, background-color 0.2s ease;
                background-color: #9a5400;
            }
            .stepper [data-kt-stepper-action=skip] {
                display: none;
            }
            img.img-flag {
                width: 10px;
            }
        </style>
    @endsection
    <div class="content d-flex flex-column flex-column-fluid card card-flush">
        <div class="d-flex flex-column flex-root">
			<div class="d-flex flex-column flex-lg-row flex-column-fluid stepper stepper-pills stepper-column" id="kt_create_account_stepper">
				<div class="d-flex flex-column flex-lg-row-auto w-xl-500px bg-lighten shadow-sm">
					<div class="d-flex flex-column top-0 bottom-0 w-xl-500px">
						<div class="d-flex flex-row-fluid flex-column flex-center p-10 pt-lg-20">
							@include('consultant.layouts.nav')
						</div>
						<div class="d-flex flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-position-y-bottom min-h-150px min-h-lg-300px" style="background-image: url(assets/media/illustrations/sketchy-1/16.png"></div>
					</div>
				</div>
				<div class="d-flex flex-column flex-lg-row-fluid py-10">
					<!--begin::Content-->
					<div class="d-flex flex-center flex-column flex-column-fluid">
						<!--begin::Wrapper-->
						<div class="w-lg-1000px p-10 p-lg-15 mx-auto">
							<!--begin::Form-->
							<form class="my-auto pb-5" novalidate="novalidate" id="kt_create_account_form">
								{{-- Mobile --}}
                                @include('consultant.layouts.Mobile')
                                {{-- Film / Individual --}}
                                @include('consultant.layouts.FilmIndividual')
                                {{-- Personal --}}
                                @include('consultant.layouts.Personal')
                                {{-- Address --}}
                                @include('consultant.layouts.Address')
                                {{-- Profession --}}
                                @include('consultant.layouts.Profession')
                                {{-- Specialized --}}
                                @include('consultant.layouts.Specialized')
                                {{-- Insurance --}}
                                @include('consultant.layouts.Insurance')
                                {{-- Preferred Slot --}}
                                @include('consultant.layouts.PreferredSlot')
                                {{-- Proof --}}
                                @include('consultant.layouts.Proof')
                                {{-- Commission --}}
                                @include('consultant.layouts.Commission')
                                {{-- Bank Details --}}
                                @include('consultant.layouts.BankDetails')
                                {{-- Your Are Done! --}}
                                @include('consultant.layouts.Done')
								<div class="d-flex flex-stack pt-10">
									<div class="mr-2">
										<button type="button" class="btn btn-lg btn-light-primary me-3" data-kt-stepper-action="previous">
										<!--begin::Svg Icon | path: icons/duotune/arrows/arr063.svg-->
										<span class="svg-icon svg-icon-4 me-1">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<rect opacity="0.5" x="6" y="11" width="13" height="2" rx="1" fill="currentColor" />
												<path d="M8.56569 11.4343L12.75 7.25C13.1642 6.83579 13.1642 6.16421 12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75L5.70711 11.2929C5.31658 11.6834 5.31658 12.3166 5.70711 12.7071L11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25C13.1642 17.8358 13.1642 17.1642 12.75 16.75L8.56569 12.5657C8.25327 12.2533 8.25327 11.7467 8.56569 11.4343Z" fill="currentColor" />
											</svg>
										</span>
										<!--end::Svg Icon-->Previous</button>
									</div>
									<div>
										<button type="button" class="btn btn-lg btn-primary" onclick="window.location.href = indexConsultant" data-kt-stepper-action="submit">
											<span class="indicator-label">Go to List
											<!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
											<span class="svg-icon svg-icon-4 ms-2">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="currentColor" />
													<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="currentColor" />
												</svg>
											</span>
											<!--end::Svg Icon--></span>
											<span class="indicator-progress">Please wait...
											<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
										</button>
										<button type="button" class="btn btn-lg btn-primary" data-kt-stepper-action="next" >Continue
										<!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
										<span class="svg-icon svg-icon-4 ms-1">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="currentColor" />
												<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="currentColor" />
											</svg>
										</span>
										<!--end::Svg Icon--></button>
                                        <button type="button" class="btn btn-lg btn-primary" data-kt-stepper-action="skip" >Skip
                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                            <span class="svg-icon svg-icon-4 ms-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="currentColor" />
                                                    <path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="currentColor" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon--></button>
									</div>
								</div>
								<!--end::Actions-->
							</form>
							<!--end::Form-->
						</div>
						<!--end::Wrapper-->
					</div>
				</div>
				<!--end::Body-->
			</div>
			<!--end::Authentication - Multi-steps-->
		</div>
    </div>
    @section('scripts')
      <style>
        <style>
                .image_container {
            height: 120px;
            width: 200px;
            border-radius: 6px;
            overflow: hidden;
            margin: 10px;
        }
        .image_container img {
            height: 120px;
            width: 200px;

            object-fit: cover;
        }
        .image_container span {
            top: -6px;
            right: 8px;
            color: red;
            font-size: 28px;
            font-weight: normal;
            cursor: pointer;
        }
    </style>
    <script src="https://static.jstree.com/latest/assets/dist/jstree.min.js"></script>
    <script src='{{ URL::asset(theme()->getDemo().'/plugins/custom/tinymce/tinymce.bundle.js')}}'></script>
    <script src="{{ URL::asset(theme()->getDemo().'/js/consultant.js') }}"></script>
    <script>
        const admin_country = {!! json_encode($companeySetting->country) !!}
        const consultantsave = `{{ route('consultant.save') }}`
        const tree =  {!! json_encode($tree) !!}
        const getSubCategory = `{{route('consultant.consultant.getSubCategory')}}`
        const getState = `{{route('master.country.getState')}}`
        const getCity = `{{route('master.country.getCity')}}`
        const indexConsultant = `{{ route('consultant.consultant.index') }}`
    </script>
@endsection
</x-base-layout>
