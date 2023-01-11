@if($page != 'Edit')

<div class="form-group row">
    <div class="col-md-6">
        <label class="required form-label fs-6 mb-4" >Registered Address</label>
        <textarea id="register_address" name="register_address" class="tox-target"></textarea>
    </div>
    <div class="col-md-6">
        <label class="required form-label fs-6 mb-4" >Country</label>
        <select class="form-select mb-4" id="country_id" name="country_id" data-control="select2" data-placeholder="Select an Country" required>
            <option></option>
            @foreach($countrys as $country)
                <option value="{{$country->id}}" data-dialing="{{ $country->dialing }}" data-has_state='{{ $country->has_state }}'>{{$country->country_name}}</option>
              
            @endforeach
        </select>
        
        <div id="stateDiv">
            <label class="required form-label fs-6 mb-4" >State</label>
            <select class="form-select mb-4" name="state_id" id="state_id" data-control="select2" data-placeholder="Select an State" required>
                <option></option>
            </select>
        </div>

        <label class="required form-label fs-6 mb-4" >City</label>
        <select class="form-select mb-4" name="city_id" id="city_id" data-control="select2" data-placeholder="Select an City" required>
            <option></option>
        </select>
        <label class="required form-label fs-6 mb-4" >Zip Code</label>
        <input type="text" name="zipcode" class="form-control mb-4" placeholder="Zip Code" required />
       
        @if(isset($phone))
            <label class="required form-label fs-6 mb-4" >Mobile no</label>
            <div class="input-group mb-5">
                <span class="input-group-text" data-repeater-dialle="" data-cphone="">--</span>
                <input type="text" name="phone" class="form-control" value="" placeholder="Mobile no" required/>
            </div>
        @endif
    </div>
</div>

@else

<div class="form-group row">
    <div class="col-md-6">
        <label class="required form-label fs-6 mb-4" >Registered Address</label>
        <textarea id="register_address" name="register_address" class="form-control">{{ $register_address }}</textarea>
    </div>
    
    <div class="col-md-6">
        <label class="required form-label fs-6 mb-4" >Country</label>
        <select class="form-select mb-4" id="country_id" name="country_id" data-control="select2" data-placeholder="Select an Country" required>
            <option></option>
            @php
                $stateDiv = true;
            @endphp
            @foreach($countrys as $country)
                <option value="{{$country->id}}" data-dialing="{{ $country->dialing }}" data-has_state='{{ $country->has_state }}' {{ ($country_id == $country->id)?'selected':'' }}>{{$country->country_name}}</option>
                @php
                    if($country_id == $country->id){
                        $stateDiv = ($country->has_state)?true : false;
                        $dialing = $country->dialing;
                    }
                @endphp
            @endforeach
        </select>
        <div id="stateDiv" style="{{ (!$stateDiv)?'display:none':'' }}">
            <label class="required form-label fs-6 mb-4" >State</label>
            <select class="form-select mb-4" name="state_id" id="state_id" data-control="select2" data-placeholder="Select an State">
                <option></option>
                @if ($stateDiv)
                    @foreach($state as $state)
                        <option value="{{$state->id}}" {{ ($state_id == $state->id)?'selected':'' }}>{{$state->state_name}}</option>
                    @endforeach
                @endif
            </select>
        </div>

        <label class="required form-label fs-6 mb-4" >City</label>
        <select class="form-select mb-4" name="city_id" id="city_id" data-control="select2" data-placeholder="Select an City" required>
            <option></option>
            @foreach($city as $city)
                <option value="{{$city->id}}" {{ ($city_id == $city->id)?'selected':'' }}>{{$city->city_name}}</option>
            @endforeach
        </select>
    
        <label class="required form-label fs-6 mb-4" >Zip Code</label>
        <input type="text" name="zipcode" value="{{ $zipcode }}" class="form-control mb-4" placeholder="Zip Code" required />
        
        @if(isset($phone))
            <label class="required form-label fs-6 mb-4" >Mobile no</label>
            <div class="input-group mb-5">
                <span class="input-group-text" data-repeater-dialle="" data-cphone="">{{$dialing}}</span>
                <input type="text" name="phone" class="form-control" value="{{$phone}}" placeholder="Mobile no" required/>
            </div>
            
        @endif
    </div>
</div>

@endif

{{-- country dial code --}}
<input type="hidden" id="#dial_code">

@section('scripts')
@parent
<script>

    var options2 = {selector: "#register_address"};
   
    var state = $("#state_id")
    var city = $("#city_id")
    var stateDiv = $('#stateDiv')
    var dialing_code = null;
    if (KTApp.isDarkMode()) {
            options2["skin"] = "oxide-dark";
            options2["content_css"] = "dark";
        }

        tinymce.init(options2);

        $("#country_id").on('select2:select', function (e) {
            var data = e.params.data;
            let has_state =  e.params.data.element.dataset.has_state
            if(typeof REPEAT_dialing !== undefined){REPEAT_dialing = data.element.dataset.dialing
            $("[data-cmobile]").html(REPEAT_dialing)
            $("[data-cphone]").html(REPEAT_dialing)
            }
            if(has_state != "0"){
                stateDiv.show(500)
                state.attr('required',true);
            }else{
                stateDiv.hide(500)
                state.removeAttr('required');
            }
            console.log($('#dial_code').val());
            $.ajax({
                url:"{{route('master.country.getState')}}",
                method:"POST",
                data:{id:data.id,"_token": "{{ csrf_token() }}",},
                success:function(data){
                    var option = `<option selected></option>`
                    var option1 = `<option selected></option>`
                    if(data.states.length != null){
                        data.states.forEach((e)=>{
                            option += '<option value='+e.id+'>'+e.state_name+'</option>';
                        })
                    }
                    if(data.city.length != null){
                        data.city.forEach((e)=>{
                            option1 += '<option value='+e.id+'>'+e.city_name+'</option>';
                        })
                    }
                    state.html(option).val('').trigger("change");
                    city.html(option1).val('').trigger("change");
                    if(data.Country){
                        // $("input[data-cmobile]").val(data.Country.dialing)
                        $("#dial_code").val(data?.Country?.dialing)
                        $('.base_curency').html(data?.currency?.currencycode)
                    }
                }
            })
        });
        $("#state_id").on('select2:select', function (e) {
            var data = e.params.data;
            $.ajax({
                url:"{{route('master.country.getCity')}}",
                method:"POST",
                data:{id:data.id,"_token": "{{ csrf_token() }}",},
                success:function(data){
                    var option = `<option selected></option>`
                    if(data.length != null){
                        data.forEach((e)=>{
                            option += '<option value='+e.id+'>'+e.city_name+'</option>';
                        })
                    }
                    city.html(option).val('').trigger("change");
                }
            })
        });

        // function has_state(state){
        //     if(state){
        //         stateDiv.show(500)
        //         state.attr('required');
        //     }else{
        //         stateDiv.hide(500)
        //         state.removeAttr('required');
        //     }
        // }
</script>

@endsection
