
<div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container-xxl">
        <div class="row gy-10 gx-xl-10">
            <div class="card card-docs flex-row-fluid mb-2">
                <table id="kt_datatable4" class="table table-row-bordered gy-5">
                    <thead>
                        <tr class="fw-bold fs-6 text-muted">

                            <th>Date and Time</th>
                            <th>Booking ID</th>
                            <th>Appointment Type</th>
                            <th>Purchased By</th>
                            <th>Purchased with</th>
                            <th>XX USD</th>
                            <th>Discount Amount</th>
                            <th width="10%">Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customer->appointment as $item)
                        <tr>

                            <td>{{ date('d-m-Y', strtotime($item->appointment_date))}}</td>
                            <td></td>
                            <td>{{ $item->appointment_type ??'-'}}</td>
                            <td>{{ $item->customer->name ??'-'}} <br/> {{ $item->customer->email ??'-'}}</td>
                            <td>{{ $consultant->name ??'-'}} <br/> {{ $consultant->email ??'-'}}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>{{ $item->status}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
