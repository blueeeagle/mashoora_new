<x-base-layout>

    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Notification Setting</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="#" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Notification</li>

                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->

                <!--end::Actions-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->


        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">
                <!--begin::Card-->
                <div class="card">
                    <!--begin::Card header-->
                    <div class="card-header border-0">
                        <!--begin::Card title-->

                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <!--begin::Table-->
                        <div id="kt_customers_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <div class="table-responsive" style="margin-top:-25px;">
                            <form method="post" action="{{ route('notification.notification.store') }}" id="formCreate">
                                @csrf
                                <table class="table table-row-bordered table-row-dashed gy-5" id="kt_customers_table">
                                <col>
                                <colgroup span="2"></colgroup>
                                <colgroup span="2"></colgroup>
                                <tbody style="border: double;text-align: center;">
                                <tr>
                                    <td rowspan="2">SNO</td>
                                    <td rowspan="2">Scenario</td>
                                    <td rowspan="2">Action Taken By</td>
                                    <th colspan="3" scope="colgroup">Customer</th>
                                    <th colspan="3" scope="colgroup">Consultant</th>
                                    <th colspan="2" scope="colgroup">Companey</th>
                                </tr>
                                <tr>
                                    <th scope="col">PN</th>
                                    <th scope="col">Mail</th>
                                    <th scope="col">SMS</th>
                                    <th scope="col">PN</th>
                                    <th scope="col">Mail</th>
                                    <th scope="col">SMS</th>
                                    <th scope="col">In App</th>
                                    <th scope="col">Mail</th>
                                </tr>
                                <tr>
                                    <th scope="">1</th>
                                    <th scope="row">Customer Signed Up Successfully</th>
                                    <td>Customer / Admin</td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="1" <?php  if(in_array(1,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(1)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="2" <?php  if(in_array(2,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(2)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4 " name="type[]" value="3" <?php  if(in_array(3,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(3)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4 " name="type[]" value="4" <?php  if(in_array(4,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(4)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4 " name="type[]" value="5" <?php  if(in_array(5,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(5)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4 " name="type[]" value="6" <?php  if(in_array(6,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(6)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4 " name="type[]" value="7" <?php  if(in_array(7,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(7)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4 " name="type[]" value="8" <?php  if(in_array(8,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(8)"></i></td>
                                </tr>
                                <tr>
                                    <th scope="">2</th>
                                    <th scope="row">Customer Added amount to Wallet</th>
                                    <td>Customer</td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="9" <?php  if(in_array(9,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(9)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4 " name="type[]" value="10" <?php  if(in_array(10,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(10)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4 " name="type[]" value="11" <?php  if(in_array(11,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(11)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4 " name="type[]" value="12" <?php  if(in_array(12,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(12)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4 " name="type[]" value="13" <?php  if(in_array(13,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(13)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4 " name="type[]" value="14" <?php  if(in_array(14,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(14)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4 " name="type[]" value="15" <?php  if(in_array(15,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(15)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4 " name="type[]" value="16" <?php  if(in_array(16,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(16)"></i></td>
                                </tr>
                                <tr>
                                <th scope="">3</th>
                                    <th scope="row">Customer Book Appointment</th>
                                    <td>Customer</td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="17" <?php  if(in_array(17,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(17)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4 " name="type[]" value="18" <?php  if(in_array(18,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(18)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4 " name="type[]" value="19" <?php  if(in_array(19,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(19)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4 " name="type[]" value="20" <?php  if(in_array(20,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(20)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4 " name="type[]" value="21" <?php  if(in_array(21,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(21)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4 " name="type[]" value="22" <?php  if(in_array(22,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(22)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4 " name="type[]" value="23" <?php  if(in_array(23,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(23)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4 " name="type[]" value="24" <?php  if(in_array(24,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(24)"></i></td>
                                </tr>
                                <tr>
                                <th scope="">4</th>
                                    <th scope="row">Booking Reminder (Before 12 Hours)</th>
                                    <td>Automatically</td>
                                    <td><input type="checkbox" class="form-check-input mb-4 " name="type[]" value="25" <?php  if(in_array(25,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(25)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4 " name="type[]" value="26" <?php  if(in_array(26,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(26)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4 " name="type[]" value="27" <?php  if(in_array(27,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(27)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4 " name="type[]" value="28" <?php  if(in_array(28,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(28)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4 " name="type[]" value="29" <?php  if(in_array(29,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(29)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4 " name="type[]" value="30" <?php  if(in_array(30,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(30)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4 " name="type[]" value="31" <?php  if(in_array(31,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(31)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4 " name="type[]" value="32" <?php  if(in_array(32,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(32)"></i></td>
                                </tr>
                                <tr>
                                <th scope="">5</th>
                                    <th scope="row">Booking Reminder (Before 1 Hours)</th>
                                    <td>Automatically</td>
                                    <td><input type="checkbox" class="form-check-input mb-4 " name="type[]" value="33" <?php  if(in_array(33,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(33)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4 " name="type[]" value="34" <?php  if(in_array(34,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(34)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4 " name="type[]" value="35" <?php  if(in_array(35,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(35)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4 " name="type[]" value="36" <?php  if(in_array(36,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(36)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4 " name="type[]" value="37" <?php  if(in_array(37,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(37)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4 " name="type[]" value="38" <?php  if(in_array(38,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(38)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4 " name="type[]" value="39" <?php  if(in_array(39,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(39)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4 " name="type[]" value="40" <?php  if(in_array(40,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(40)"></i></td>
                                </tr>
                                <tr>
                                <th scope="">6</th>
                                    <th scope="row">Consultant Started Appointment</th>
                                    <td>Consultant</td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="41" <?php  if(in_array(41,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(41)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="42" <?php  if(in_array(42,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(42)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="43" <?php  if(in_array(43,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(43)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="44" <?php  if(in_array(44,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(44)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="45" <?php  if(in_array(45,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(45)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="46" <?php  if(in_array(46,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(46)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="47" <?php  if(in_array(47,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(47)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="48" <?php  if(in_array(48,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(48)"></i></td>
                                </tr>
                                <tr>
                                <th scope="">7</th>
                                    <th scope="row">Customer Joined Appointment</th>
                                    <td>Customer</td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="49" <?php  if(in_array(49,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(49)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="50" <?php  if(in_array(50,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(50)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="51" <?php  if(in_array(51,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(51)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="52" <?php  if(in_array(52,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(52)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="53" <?php  if(in_array(53,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(53)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="54" <?php  if(in_array(54,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(54)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="55" <?php  if(in_array(55,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(55)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="56" <?php  if(in_array(56,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(56)"></i></td>
                                </tr>
                                <tr>
                                <th scope="">8</th>
                                    <th scope="row">Slot Time Expiry Reminder (Before 5 Min)</th>
                                    <td>Automatically</td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="57" <?php  if(in_array(57,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(57)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="58" <?php  if(in_array(58,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(58)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="59" <?php  if(in_array(59,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(59)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="60" <?php  if(in_array(60,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(60)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="61" <?php  if(in_array(61,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(61)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="62" <?php  if(in_array(62,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(62)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="63" <?php  if(in_array(63,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(63)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="64" <?php  if(in_array(64,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(64)"></i></td>
                                </tr>
                                <tr>
                                <th scope="">9</th>
                                    <th scope="row">Consultant Completed Appoinment</th>
                                    <td>Consultant</td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="65" <?php  if(in_array(65,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(65)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="66" <?php  if(in_array(66,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(66)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="67" <?php  if(in_array(67,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(67)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="68" <?php  if(in_array(68,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(68)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4 " name="type[]" value="69" <?php  if(in_array(69,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(69)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="70" <?php  if(in_array(70,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(70)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="71" <?php  if(in_array(71,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(71)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="72" <?php  if(in_array(72,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(72)"></i></td>
                                </tr>
                                <tr>
                                <th scope="">10</th>
                                    <th scope="row">Customer Submitted Review & Rating</th>
                                    <td>Customer</td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="73" <?php  if(in_array(73,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(73)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="74" <?php  if(in_array(74,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(74)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="75" <?php  if(in_array(75,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(75)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="76" <?php  if(in_array(76,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(76)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4 " name="type[]" value="77" <?php  if(in_array(77,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(77)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="78" <?php  if(in_array(78,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(78)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="79" <?php  if(in_array(79,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(79)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="80" <?php  if(in_array(80,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(80)"></i></td>
                                </tr>
                                <tr>
                                <th scope="">11</th>
                                    <th scope="row">Consultant Reported review & Rating</th>
                                    <td>Consultant</td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="81" <?php  if(in_array(81,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(81)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="82" <?php  if(in_array(82,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(82)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="83" <?php  if(in_array(83,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(83)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="84" <?php  if(in_array(84,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(84)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="85" <?php  if(in_array(85,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(85)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="86" <?php  if(in_array(86,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(86)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="87" <?php  if(in_array(87,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(87)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="88" <?php  if(in_array(88,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(88)"></i></td>
                                </tr>
                                <tr>
                                <th scope="">12</th>
                                    <th scope="row">Payin Reminder (Every Day) for completed appoinments</th>
                                    <td>Automatically</td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="89" <?php  if(in_array(89,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(89)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="90" <?php  if(in_array(90,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(90)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="91" <?php  if(in_array(91,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(91)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="92" <?php  if(in_array(92,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(92)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="93" <?php  if(in_array(93,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(93)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="94" <?php  if(in_array(94,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(94)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="95" <?php  if(in_array(95,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(95)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4 " name="type[]" value="96" <?php  if(in_array(96,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(96)"></i></td>
                                </tr>
                                <tr>
                                <th scope="">13</th>
                                    <th scope="row">Admin approves pay in (For Completed Appoinments)</th>
                                    <td>Admin</td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="97" <?php  if(in_array(97,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(97)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="98" <?php  if(in_array(98,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(98)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="99" <?php  if(in_array(99,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(99)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="100" <?php  if(in_array(100,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(100)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4 " name="type[]" value="101" <?php  if(in_array(101,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(101)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="102" <?php  if(in_array(102,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(102)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="103" <?php  if(in_array(103,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(103)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="104" <?php  if(in_array(104,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(104)"></i></td>
                                </tr>
                                <tr>
                                <th scope="">14</th>
                                    <th scope="row">Admin denies pay in (For Completed Appoinments)</th>
                                    <td>Admin</td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="105" <?php  if(in_array(105,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(105)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4 " name="type[]" value="106" <?php  if(in_array(106,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(106)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="107" <?php  if(in_array(107,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(107)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="108" <?php  if(in_array(108,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(108)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4 " name="type[]" value="109" <?php  if(in_array(109,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(109)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="110" <?php  if(in_array(110,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(110)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="111" <?php  if(in_array(111,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(111)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="112" <?php  if(in_array(112,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(112)"></i></td>
                                </tr>
                                <tr>
                                <th scope="">15</th>
                                    <th scope="row">Customer Cancel Appoinment (Before Grace Period)</th>
                                    <td>Customer / Admin</td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="113" <?php  if(in_array(113,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(113)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="114" <?php  if(in_array(114,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(114)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="115" <?php  if(in_array(115,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(115)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="116" <?php  if(in_array(116,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(116)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4 " name="type[]" value="117" <?php  if(in_array(117,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(117)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="118" <?php  if(in_array(118,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(118)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="119" <?php  if(in_array(119,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(119)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="120" <?php  if(in_array(120,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(120)"></i></td>
                                </tr>
                                <tr>
                                <th scope="">16</th>
                                    <th scope="row">Customer Cancel Appoinment (After Grace Period)</th>
                                    <td>Customer / Admin</td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="121" <?php  if(in_array(121,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(121)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="122" <?php  if(in_array(122,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(122)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="123" <?php  if(in_array(123,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(123)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="124" <?php  if(in_array(124,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(124)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4 " name="type[]" value="125" <?php  if(in_array(125,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(125)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="126" <?php  if(in_array(126,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(126)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="127" <?php  if(in_array(127,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(127)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="128" <?php  if(in_array(128,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(128)"></i></td>
                                </tr>
                                <tr>
                                <th scope="">17</th>
                                    <th scope="row">Consultant Cancel Appoinment (Before Grace Period)</th>
                                    <td>Consultant</td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="129" <?php  if(in_array(129,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(129)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="130" <?php  if(in_array(130,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(130)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4 " name="type[]" value="131" <?php  if(in_array(131,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(131)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="132" <?php  if(in_array(132,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(132)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="133" <?php  if(in_array(134,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(134)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="134" <?php  if(in_array(134,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(134)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4 " name="type[]" value="135" <?php  if(in_array(135,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(135)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="136" <?php  if(in_array(136,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(136)"></i></td>
                                </tr>
                                <tr>
                                <th scope="">18</th>
                                    <th scope="row">Customer Reschedule Appoinment (Before Grace Period)</th>
                                    <td>Customer / Admin /Consultant</td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="137" <?php  if(in_array(137,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(137)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="138" <?php  if(in_array(138,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(138)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="139" <?php  if(in_array(139,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(139)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="140" <?php  if(in_array(140,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(140)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="141" <?php  if(in_array(141,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(141)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="142" <?php  if(in_array(142,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(142)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4 " name="type[]" value="143" <?php  if(in_array(143,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(143)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="144" <?php  if(in_array(144,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(144)"></i></td>
                                </tr>
                                <tr>
                                <th scope="">19</th>
                                    <th scope="row">Customer Reschedule Appoinment (After Grace Period)</th>
                                    <td> Admin /Consultant</td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="145" <?php  if(in_array(145,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(145)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="146" <?php  if(in_array(146,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(146)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="147" <?php  if(in_array(147,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(147)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="148" <?php  if(in_array(148,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(148)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="149" <?php  if(in_array(149,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(149)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="150" <?php  if(in_array(150,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(150)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4 " name="type[]" value="151" <?php  if(in_array(151,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(151)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="152" <?php  if(in_array(152,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(152)"></i></td>
                                </tr>
                                <tr>
                                <th scope="">20</th>
                                    <th scope="row">No Show Appointments</th>
                                    <td>Consultant / Admin</td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="153" <?php  if(in_array(153,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(153)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="154" <?php  if(in_array(154,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(154)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="155" <?php  if(in_array(155,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(155)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4 " name="type[]" value="156" <?php  if(in_array(156,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(156)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="157" <?php  if(in_array(157,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(157)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="158" <?php  if(in_array(158,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(158)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4 " name="type[]" value="159" <?php  if(in_array(159,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(159)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="160" <?php  if(in_array(160,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(160)"></i></td>
                                </tr>
                                <tr>
                                <th scope="">21</th>
                                    <th scope="row">Consultant Signed Up Successfully</th>
                                    <td>Consultant</td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="161" <?php  if(in_array(161,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(161)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="162" <?php  if(in_array(162,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(162)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="163" <?php  if(in_array(163,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(163)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="164" <?php  if(in_array(164,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(164)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="165" <?php  if(in_array(165,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(165)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="166" <?php  if(in_array(166,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(166)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4 " name="type[]" value="167" <?php  if(in_array(167,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(167)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="168" <?php  if(in_array(168,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(168)"></i></td>
                                </tr>
                                <tr>
                                <th scope="">22</th>
                                    <th scope="row">Consultant Approves Appointment (Paid by Insurance)</th>
                                    <td>Consultant / Admin</td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="169" <?php  if(in_array(169,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(169)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="170" <?php  if(in_array(170,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(170)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="171" <?php  if(in_array(171,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(171)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4 " name="type[]" value="172" <?php  if(in_array(172,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(172)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="173" <?php  if(in_array(173,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(173)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="174" <?php  if(in_array(174,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(174)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="175" <?php  if(in_array(175,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(175)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="176" <?php  if(in_array(176,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(176)"></i></td>
                                </tr>
                                <tr>
                                <th scope="">23</th>
                                    <th scope="row">Consultant Denies Appointment (Paid by Insurance)</th>
                                    <td>Consultant / Admin</td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="177" <?php  if(in_array(177,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(177)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="178" <?php  if(in_array(178,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(178)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="179" <?php  if(in_array(179,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(179)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4 " name="type[]" value="180" <?php  if(in_array(180,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(180)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="181" <?php  if(in_array(181,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(181)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="182" <?php  if(in_array(182,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(182)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="183" <?php  if(in_array(183,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(183)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="184" <?php  if(in_array(184,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(184)"></i></td>
                                </tr>
                                <tr>
                                <th scope="">24</th>
                                    <th scope="row">Consultant Request for Payout</th>
                                    <td>Consultant</td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="185" <?php  if(in_array(185,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(185)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="186" <?php  if(in_array(186,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(186)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="187" <?php  if(in_array(187,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(187)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="188" <?php  if(in_array(188,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(188)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="189" <?php  if(in_array(189,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(189)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="190" <?php  if(in_array(190,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(190)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="191" <?php  if(in_array(191,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(191)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="192" <?php  if(in_array(192,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(192)"></i></td>
                                </tr>
                                <tr>
                                <th scope="">25</th>
                                    <th scope="row">Admin approves pay out</th>
                                    <td>Admin</td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="193" <?php  if(in_array(193,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(193)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4 " name="type[]" value="194" <?php  if(in_array(194,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(194)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="195" <?php  if(in_array(195,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(195)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="196" <?php  if(in_array(196,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(196)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="197" <?php  if(in_array(197,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(197)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4 " name="type[]" value="198" <?php  if(in_array(198,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(198)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="199" <?php  if(in_array(199,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(199)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="200" <?php  if(in_array(200,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(200)"></i></td>
                                </tr>
                                <tr>
                                <th scope="">26</th>
                                    <th scope="row">Admin denies pay out</th>
                                    <td>Admin</td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="201" <?php  if(in_array(201,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(201)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4 " name="type[]" value="202" <?php  if(in_array(202,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(202)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="203" <?php  if(in_array(203,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(203)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="204" <?php  if(in_array(204,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(204)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="205" <?php  if(in_array(205,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(205)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4 " name="type[]" value="206" <?php  if(in_array(206,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(206)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="207" <?php  if(in_array(207,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(207)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="208" <?php  if(in_array(208,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(208)"></i></td>
                                </tr>
                                <tr>
                                <th scope="">27</th>
                                    <th scope="row">Schedule not entered (prior to 7 days, 3 days, 1 day)</th>
                                    <td>Automatically</td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="209" <?php  if(in_array(209,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(209)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4 " name="type[]" value="210" <?php  if(in_array(2010,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(210)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="211" <?php  if(in_array(211,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(211)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="212" <?php  if(in_array(212,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(212)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="213" <?php  if(in_array(213,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(213)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4 " name="type[]" value="214" <?php  if(in_array(214,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(214)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="215" <?php  if(in_array(215,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(215)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="216" <?php  if(in_array(216,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(216)"></i></td>
                                </tr>
                                <tr>
                                <th scope="">28</th>
                                    <th scope="row">Admin approves profile</th>
                                    <td>Admin</td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="217" <?php  if(in_array(217,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(217)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="218" <?php  if(in_array(218,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(218)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="219" <?php  if(in_array(219,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(219)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="220" <?php  if(in_array(220,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(220)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="221" <?php  if(in_array(221,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(221)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4 " name="type[]" value="222" <?php  if(in_array(222,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(222)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="223" <?php  if(in_array(223,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(223)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="224" <?php  if(in_array(224,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(224)"></i></td>
                                </tr>
                                <tr>
                                <th scope="">29</th>
                                    <th scope="row">Admin denies profile</th>
                                    <td>Admin</td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="225" <?php  if(in_array(225,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(225)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="226" <?php  if(in_array(226,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(226)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="227" <?php  if(in_array(227,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(227)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="228" <?php  if(in_array(228,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(228)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="229" <?php  if(in_array(229,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(229)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4 " name="type[]" value="230" <?php  if(in_array(230,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(230)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="231" <?php  if(in_array(231,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(231)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="232" <?php  if(in_array(232,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(232)"></i></td>
                                </tr>
                                <tr>
                                <th scope="">30</th>
                                    <th scope="row">Customer Purchased offer</th>
                                    <td>Customer</td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="233" <?php  if(in_array(233,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(233)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="234" <?php  if(in_array(234,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(234)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="235" <?php  if(in_array(235,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(235)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="236" <?php  if(in_array(236,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(236)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="237" <?php  if(in_array(237,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(237)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4 " name="type[]" value="238" <?php  if(in_array(238,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(238)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="239" <?php  if(in_array(239,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(239)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4 " name="type[]" value="240" <?php  if(in_array(240,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(240)"></i></td>
                                </tr>
                                <tr>
                                <th scope="">31</th>
                                    <th scope="row">Offer Posted</th>
                                    <td>Consultant / Admin</td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="241" <?php  if(in_array(241,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(241)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="242" <?php  if(in_array(242,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(242)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="243" <?php  if(in_array(243,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(243)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="244" <?php  if(in_array(244,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(244)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="245" <?php  if(in_array(245,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(245)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="246" <?php  if(in_array(246,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(246)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="247" <?php  if(in_array(247,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(247)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="248" <?php  if(in_array(248,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(248)"></i></td>
                                </tr>
                                <tr>
                                <th scope="">32</th>
                                    <th scope="row">Discount Posted</th>
                                    <td>Consultant / Admin</td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="249" <?php  if(in_array(249,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(249)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="250" <?php  if(in_array(250,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(250)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="251" <?php  if(in_array(251,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(251)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="252" <?php  if(in_array(252,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(252)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="253" <?php  if(in_array(253,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(253)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="254" <?php  if(in_array(254,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(254)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="255" <?php  if(in_array(255,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(255)"></i></td>
                                    <td><input type="checkbox" class="form-check-input mb-4" name="type[]" value="256" <?php  if(in_array(256,$datas)){echo "checked";} ?>><br>
                                    <i class='fas fa-exclamation-circle' onclick="Myfunction(256)"></i></td>
                                </tr>
                                <tbody>
                                </table>
                                <button type="submit" class="btn btn-info" style="margin-left: 629px;">Save</button>
                            </form>
                            </div>
                        </div>
                    </div>
                    <!--end::Card body-->
                </div>
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!-- Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content rounded">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                transform="rotate(-45 6 17.3137)" fill="currentColor" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)"
                                fill="currentColor" />
                        </svg>
                    </span>
                </div>
            </div>
            <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                <form id="exampleModal77" class="form" action="#" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-8">
                            <div class="d-flex flex-column mb-8 fv-row">
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span class="required">Title or Subject</span>
                                </label>
                                <textarea class="form-control" id="title" required placeholder="" required name="title" ></textarea>
                                <input type="hidden" name="type" value="" class="set_type">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="d-flex flex-column mb-8">
                                <label class="required fs-6 fw-bold mb-2">Description of Body</label>
                                <textarea id="templateBody" name="description" class="tox-target"></textarea>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="d-flex flex-column mb-8">
                                <label class="required fs-6 fw-bold mb-2">Variables</label>
                                <textarea class="form-control variables" required placeholder="" disabled name="variables" rows="22">
                                    {message}
                                    {name}
                                    {phone_no}
                                    {email}
                                    {amount}
                                </textarea>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="reset" class="btn btn-light me-3 kt_modal_new_target_cancel">Cancel</button>
                        <button type="submit" class="btn btn-primary kt_modal_new_target_submit">
                            <span class="indicator-label">Submit</span>
                            <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script src='{{ URL::asset(theme()->getDemo().'/plugins/custom/flatpickr/flatpickr.bundle.js')}}'></script>
<script src='{{ URL::asset(theme()->getDemo().'/plugins/custom/tinymce/tinymce.bundle.js')}}'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
<script src='{{ URL::asset(theme()->getDemo().'/plugins/custom/fslightbox/fslightbox.bundle.js') }}'></script>
<script src="{{ URL::asset(theme()->getDemo().'/js/template.js') }}"></script>
<script>
    const updateURL = `{{ route('notification.notification.template-store') }}`
    </script>
<script>

var options2 = {selector: "#templateBody"};

if (KTApp.isDarkMode()) {
            options2["skin"] = "oxide-dark";
            options2["content_css"] = "dark";
        }

        tinymce.init(options2);



function Myfunction(val)
{
    $('.set_type').val(val);
    $.ajax({
        type: 'GET',
        url: `{{url('/')}}/notification/variables/`+val,
        data: {value:val},
    success: function(data) {
        if(!data.status){
            alert("Something is wrong");
            return;
        }
        var allVals = [];
        data.variable.forEach((element) => {
            allVals.push(("\r\n")+ '{'+element+'}');
        });
        $('.variables').val(allVals);
        tinymce.get('templateBody').setContent(data.notify.description || '')
        $('#title').val(data.notify.title)
        $('#exampleModal').modal('show');
    }
    });
}
</script>
@endsection
</x-base-layout>
