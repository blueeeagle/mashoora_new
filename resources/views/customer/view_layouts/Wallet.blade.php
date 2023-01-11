<div class="tab-pane fade" id="kt_tab_pane_7" role="tabpanel">
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-xxl">

            <div class="row gy-10 gx-xl-10">
                <div class="card card-docs flex-row-fluid mb-2">
                    <table id="kt_datatable7" class="table table-row-bordered gy-5">
                        <thead>
                            <tr class="fw-bold fs-6 text-muted">
                                <th>Date & Time</th>
                                <th>Type</th>
                                <th>Transaction ID</th>
                                <th>Statement</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>

                        </thead>
                        <tbody>
                            @foreach ($consultant->wallet_trans as $trans)
                            <tr>
                               <td>{{ date('d-m-Y', strtotime($trans->created_at)) ??''}}</td>
                               <td></td>
                               <td></td>
                               <td>{{ $trans->action ??''}}</td>
                               <td>{{ $trans->amount ??''}}</td>
                               <td>{{ ($trans->type == 'add') ?'Payment In':'Payment Out'}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
