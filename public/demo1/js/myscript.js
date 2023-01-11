var ToogleColum = null
var back = null
$(document).ready(function () {
const _token =  document.getElementById('csrf-token').getAttribute('content')
const SearchSubmit = document.getElementById('search')
const SearchSubmit_two = document.getElementById('search_two')
ToogleColum = $('#toogleColum');
const resetSubmit = document.getElementById('reset')
SearchSubmit?.addEventListener('click',search)
SearchSubmit_two?.addEventListener('click',search)
resetSubmit?.addEventListener('click',reset)

$("#formreset").click(function(){
    $('select').val("").trigger( "change" );
})

  // Edit Form Reset
$("#formEditReset").click(function(){
    $('select').val("").trigger( "change" );
    
    let form = document.querySelector('#formEdit')
    form.querySelectorAll("input[type='text'] ,div[id='kt_docs_jstree_checkable'],textarea,input[type='radio'] ,input[name='tags'] ,input[id='kt_daterangepicker_3'],input[type='number'],input[type='email'],input[type='time'],input[type='file'],input[type='hidden'][name='img'],img[class='file-preview'], input[type='checkbox']")
        .forEach(e=>{
            if(e.type=='text'||e.name=='tags'||e.type=='hidden'||e.type=='textarea'||e.type=='number'||e.type=='time'||e.type=='email'|| e.id=='kt_daterangepicker_3'){ e.value = ''; }
            if(e.type=='checkbox') {e.checked=false;}
            if(e.src){e.src = ''}
            if(e.id=='kt_docs_jstree_checkable'){ $('#kt_docs_jstree_checkable').jstree("deselect_all");}
        })  
})

function search(event){
    event.preventDefault()
    var params = {}
    const datatable_input = document.querySelectorAll('.datatable-input')
    datatable_input.forEach((data) => {
        var i = data.dataset.colIndex
        if(!i) return
        if (params[i]) {
            if(data.hasAttribute('multiple')) params[i] += '|' + $(data).val();
            else params[i] += '|' + data.value;
        } else {
            if(data.hasAttribute('multiple')) params[i] = $(data).val();
            else params[i] = data.value;
        }
    })
    $.each(params, function(i, val) {
        table.column(i).search(val ? val : '', false, false);
    });
    table.table().draw();
}



function reset(event){
    event.preventDefault()
    const datatable_input = document.querySelectorAll('.datatable-input')
    datatable_input.forEach((data) => {
        data.value = ''
        table.column(data.dataset.colIndex).search('', false, false);
    })
    table.table().draw();
}



    $('#formCreate').submit(function(e){
        e.preventDefault();
        const formData = new FormData(e.target);
        $.ajax({
            method:"POST",
            url:$(this).prop('action'),
            data:formData,
            cache: false,
            processData: false,
            contentType: false,
            success:function(data){
                if(data.msg){
                    e.target.reset();
                    Switealert(data.msg,'success')
                    setTimeout(() => {
                        if(back) window.location.href = back
                    }, 1000);
                }else{
                    var Ptag = "";
                    for(var error in data.errors) { Ptag += data.errors[error]+', '; };
                    Switealert(Ptag,'error')
                }
                console.log(data);
                window.scrollTo({top:0,behavior:'smooth'});
            },
            error:function(erroe){
                console.log(erroe);
                window.scrollTo({top:0,behavior:'smooth'});
                alert("Something is wrong");
            }
        });
    });

    $('#formEdit').submit(function(e){
        e.preventDefault();
        const formData = new FormData(e.target);
        $.ajax({
            method:"POST",
            url:$(this).prop('action'),
            data:new FormData(e.target),
            cache: false,
            processData: false,
            contentType: false,
            success:function(data){
                if(data.msg){
                    Switealert(data.msg,'success')
                    setTimeout(() => {
                        if(back) window.location.href = back
                    }, 1000);
                }else{
                    var Ptag = "";
                    for(var error in data.errors) { Ptag += data.errors[error]+', '; };
                    Switealert(Ptag,'error')
                }
                console.log(data);
                window.scrollTo({top:0,behavior:'smooth'});
            },
            error:function(erroe){
                console.log(erroe);
                window.scrollTo({top:0,behavior:'smooth'});
                alert("Something is wrong");
            }
        });
    });
    function Switealert(Msg,status){
        Swal.fire({
            text: Msg,
            icon: status,
            buttonsStyling: false,
            confirmButtonText: "Ok, got it!",
            customClass: {
                confirmButton: 'btn btn-primary'
            }
        });
    }
    document.body.addEventListener('click', function(event){

        const e = event
        if(e.srcElement.hasAttribute('status')){
            e.preventDefault()
            let status  = (e.srcElement.checked)?1:0
            let data = { _token: _token , status: status }
            let route = e.srcElement.dataset.url
            fetch(route,{
                method: 'POST', // or 'PUT'
                headers: { 'Content-Type': 'application/json', },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                Switealert((data.status)?'Status Updated':'error',(data.status)?'success':'error')
                table.ajax.reload(null, false);
            });
        }

        if(e.srcElement.hasAttribute('delete')){
            e.preventDefault()
            var text = e.srcElement.hasAttribute('text')? e.srcElement.getAttribute('text'): 'Are you sure you want to delete ?'
            Swal.fire({
                text: text,
                icon: "warning",
                showCancelButton: !0,
                buttonsStyling: !1,
                confirmButtonText: "Yes, delete!",
                cancelButtonText: "No, cancel",
                customClass: {
                    confirmButton: "btn fw-bold btn-danger",
                    cancelButton: "btn fw-bold btn-active-light-primary"
                }
            }).then((function (t) {
                if(t.value){
                    let route = e.srcElement.getAttribute('href')
                    let data = { _token: _token,_method:'DELETE' }
                   
                    fetch(route,{
                        method: 'DELETE',
                        headers: { 'Content-Type': 'application/json','Accept':'application/json' },
                        body: JSON.stringify(data)
                    })
                    .then(response => response.json())
                    .then(data => {
                        table.ajax.reload(null, false);
                        Switealert((data.status)?data.msg:data.error,(data.status)?'success':'error')
                    });
                }
            }))
        }
    }, true);

    ToogleColum?.on('change', function (e) {
        const select = ToogleColum.val()
        table.columns().every(function (index) {
            if(!select.includes(index.toString())){
                var column =  table.column(index)
                column.visible(false)
            }else{
                var column =  table.column(index)
                column.visible(true)
            }
        })
    })

    $('#filter').on('change', function (e) {
        const selected = $('#filter').val()
        const length = selected.length
        if(length > 0){
            document.getElementById('search_div').removeAttribute('hidden')
        }else{
            document.getElementById('search_div').setAttribute('hidden',true)
        }
        document.querySelectorAll('[data-id-filter').forEach((a) =>{
            if(selected.indexOf(a.getAttribute('data-id-filter')) !== -1)  {
                a.removeAttribute('hidden')
            }else{
                a.setAttribute('hidden',true)
            }
        })
    })
})
