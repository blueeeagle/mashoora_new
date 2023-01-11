<div class="tab-pane fade" id="kt_tab_pane_5" role="tabpanel">
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-xxl">

            <div class="row gy-10 gx-xl-10">
                <div class="card card-docs flex-row-fluid mb-2">
                    <table id="kt_datatable5" class="table table-row-bordered gy-5">
                        <thead>
                            <tr class="fw-bold fs-6 text-muted">
                                <th>Date and Time</th>
                                <th>Transaction ID</th>
                                <th>Purchased By</th>
                                <th>Purchased with</th>
                                <th>Offer Title</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($consultant->offer_historys as $offers)
                            <tr>
                               <td>{{ date('d-m-Y', strtotime($offers->purchase_date))}}</td>
                               <td></td>
                               <td>{{ $offers->customer->name ??''}} <br/> {{ $offers->customer->email ??''}}</td>
                               <td>{{ $consultant->name ??''}} <br/> {{ $consultant->email ??''}}</td>
                               <td>{{ $offers->offer->offer_title ??''}}</td>
                               <td>{{ $offers->offer->amount ??''}}</td>
                               <td></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
