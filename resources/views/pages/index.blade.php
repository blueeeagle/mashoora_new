<x-base-layout>
    @if (\Session::has('errors'))
        <div class="alert alert-danger alert-dismissible fade show">
            <strong>{!! \Session::get('errors') !!}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    <!--begin::Row-->
       <center> <h2 style="margin-top: 50px"></h2></center>

    <div class="kt_content_container" class="container-xxl">
        @include('pages.customer')
        @include('pages.consultant')
    </div>

@section('scripts')
<script src="{{ URL::asset(theme()->getDemo().'/js/daashboad.js') }}"></script>
<script>
    const customer_data = `{{route('dashboad.customer')}}`
    const consultant_data = `{{route('dashboad.consultant')}}`
</script>
@endsection

</x-base-layout>
