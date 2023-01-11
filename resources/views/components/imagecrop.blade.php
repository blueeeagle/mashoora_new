<!-- image modal -->

<label for="{{ $name }}">
    <img class="file-preview" @if(isset($imgsrc)) src="{{ asset("storage/$imgsrc") }}" @else src="{{ asset("storage//uploadFiles/default_image.jpg") }}" @endif style="width:100px; #222;height: 100px">
    <input type="hidden" id="imageValue" name="{{ $name }}" value="">
</label>
<input type="file" id="{{ $name }}" class="{{ $name }}" accept="image/png, image/jpeg" style="width:70px;padding:20px; #222; display:none">


  <button type="button"  {{ isset($imgsrc) ? '':'hidden'}} id="removeImage">X</button>

{{-- model --}}
<div id="uploadimageModal_{{ $name }}" class="modal" role="dialog" style="z-index: 10000;top: 55px;">
    <div class="modal-dialog">
        <div class="modal-content">
              <div class="modal-header" style="padding: 10px">
                <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                <h4 class="modal-title">Upload & Crop Image</h4>
              </div>
              <div class="modal-body">
                <div class="row">
                    <div class="col-md-12" style="text-align: center">
                        <span class="btn btn-success crop_image_{{$name}}">Crop & Upload Image</span>
                    </div>
                </div>
                <div class="row">
                      <div class="col-md-12 text-center">
                          <div id="image_demo_{{$name}}" style="width:100%; margin-top:5px"></div>
                      </div>
                </div>
              </div>
              <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
              </div>
        </div>
    </div>
</div>

@section('scripts')
@parent
@if(!isset($qqqq))

@endif
<script>
   
    $(document).ready(function(){
        $image_crop_{{ $name }} = $('#image_demo_{{$name}}').croppie({
        enableExif: true,
        viewport: {
          width:{{ isset($width)?$width:500 }},
          height:{{ isset($height)?$height:500 }},
          type:'square' //circle
        },
        boundary:{
          width:{{ isset($width)?$width + 100:800 }},
          height:{{ isset($height)?$height + 100:800 }}
        }
      });

      $('.{{$name}}').on('change', function(){
       
        if(this.files[0].size > 5242880){
          Swal.fire({
                    text: 'Image must be less than 5Mb',
                    icon: status,
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: 'btn btn-primary'
                    }
                });
        }
        else{
            objectB = this.parentElement;
            objectA = this;
            let reader = new FileReader();

            reader.onload = function (event) {
              console.log(this);
              $image_crop_{{ $name }}.croppie('bind', {
                url: event.target.result
              }).then(function(){
                console.log('jQuery bind complete');
              });
            }
            reader.readAsDataURL(this.files[0]);
            $('#uploadimageModal_{{ $name }}').modal('show');
            $('#removeImage').removeAttr('hidden');
        }
        
      });

      $('.crop_image_{{ $name }}').click(function(event){
        $image_crop_{{ $name }}.croppie('result', {
          type: 'canvas',
          size: 'viewport'
        }).then(function(response){
            $.ajax({
                url:'{{ route('help.uploadimage') }}',
                type: "POST",
                data:{"image": response,"_token": "{{ csrf_token() }}"},
                success:function(data){
                    objectB.children[0].children[0].src = response;
                    $('#uploadimageModal_{{ $name }}').modal('hide');
                    objectB.children[0].children[1].value = data['Name'];
                },error:function(data){ 
                    objectB.children[0].children[0].src = response;
                    $('#uploadimageModal_{{ $name }}').modal('hide');
                    objectB.children[0].children[1].value = data['Name'];
                }
            });
            $('#uploadimageModal_{{ $name }}').modal('hide');
        })
      });
    })
    
    $('#removeImage').click(function(event){
    
      this.parentElement.querySelector('.file-preview').src= defaultImage;
      this.parentElement.querySelector('#imageValue').value='';
      this.parentElement.querySelector('#removeImage').setAttribute('hidden',true)
      
    })

</script>
@php 
  $qqqqq = 'hhh';
@endphp
@endsection
