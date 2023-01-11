    // var KTcalendar = {
    //     init: function () {
        // $( window ).on( "load", function() {
        //     window.dispatchEvent(new Event('resize'))
        // });
            $("#test").on("click",function(e){
                // alert(e)
                window.dispatchEvent(new Event('resize'))
            })
           
            const viewElement = document.getElementById('kt_modal_view_event1');
            viewModal = new bootstrap.Modal(viewElement);
            viewEventName = viewElement.querySelector('[data-kt-calendar1="event_name"]');
            viewAllDay = viewElement.querySelector('[data-kt-calendar1="all_day"]');
            viewEventDescription = viewElement.querySelector('[data-kt-calendar1="event_description"]');
            viewEventLocation = viewElement.querySelector('[data-kt-calendar1="event_location"]');
            viewStartDate = viewElement.querySelector('[data-kt-calendar1="event_start_date"]');
            viewEndDate = viewElement.querySelector('[data-kt-calendar1="event_end_date"]');
            viewEditButton = viewElement.querySelector('#kt_modal_view_event1_edit');
            viewDeleteButton = viewElement.querySelector('#kt_modal_view_event1_delete');
            viewConsultantName = viewElement.querySelector('[data-kt-calendar1="c_name"]');
            viewAppType = viewElement.querySelector('[data-kt-calendar1="app_type"]');
            viewAppStatus = viewElement.querySelector('[data-kt-calendar1="app_status"]');
            viewMapId = viewElement.querySelector('[data-kt-calendar1="map_id"]');
            var popoverState = false;
            var calendarEl = document.getElementById('kt_calendar_app1');
            console.log(calendarEl);
            const hidePopovers = () => {
                if (popoverState) {
                    popover.dispose();
                    popoverState = false;
                }
            }

            calendar = new FullCalendar.Calendar(calendarEl, {
                        headerToolbar: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'dayGridMonth,timeGridWeek,timeGridDay'
                        },
                       
                        // height: 650,
                        navLinks: true,
                        navLinks: true, 
                        selectable: true,
                        selectMirror: true,
                        select: function (arg) {
                            hidePopovers();
                            formatArgs(arg);
                            handleNewEvent();
                        },
                        eventMouseEnter: function (arg) {

                            axios.get(`${appdetails}?id=${data.id}`)
                            .then(function (response) {
                                
                                if(!response.data.appointment){
                                    // console.log(response.data);
                                    appnotfound.removeAttribute('hidden');
                                    
                                    appfound.setAttribute('hidden',true);
                                    popup_edit.setAttribute('hidden',true);
                                    popup_delete.setAttribute('hidden',true);
            
                                }else{
                                    
                                    console.log(response.data);
                                    appfound.removeAttribute('hidden');
                                    popup_edit.removeAttribute('hidden');
                                    popup_delete.removeAttribute('hidden');
            
                                    appnotfound.setAttribute('hidden',true);
                                    viewConsultantName.innerText = response.data.appointment.consultant.name;
                                    viewAppType.innerText  = response.data.appointment.appointment_type;
                                    viewAppStatus.innerText  = response.data.status;
                                    viewMapId.innerText = data.id;
                                    appStatus = response.data.appointment.status;
                                    status.value = appStatus;
                                }
                            })

                            
                            formatArgs({
                                id: arg.event.id,
                                title: arg.event.title,
                                description: arg.event.extendedProps.description,
                                location: arg.event.extendedProps.location,
                                startStr: arg.event.startStr,
                                endStr: arg.event.endStr,
                                allDay: arg.event.allDay
                            });
            
                            // Show popover preview
                            initPopovers(arg.el);
                        
                        
                        },
                        eventClick: function (arg) {
                            
                            hidePopovers();
                            axios.get(`${appdetails}?id=${data.id}`)
                            .then(function (response) {
                                // console.log(response.data);
                                if(!response.data.appointment){
                                    // console.log(response.data);
                                    appnotfound.removeAttribute('hidden');
                                    
                                    appfound.setAttribute('hidden',true);
                                    popup_edit.setAttribute('hidden',true);
                                    popup_delete.setAttribute('hidden',true);
            
                                }else{
                                    
                                    console.log(response.data);
                                    appfound.removeAttribute('hidden');
                                    popup_edit.removeAttribute('hidden');
                                    popup_delete.removeAttribute('hidden');
            
                                    appnotfound.setAttribute('hidden',true);
                                    viewConsultantName.innerText = response.data.appointment.consultant.name;
                                    viewAppType.innerText  = response.data.appointment.appointment_type;
                                    viewAppStatus.innerText  = response.data.status;
                                    viewMapId.innerText = data.id;
                                    appStatus = response.data.appointment.status;
                                    status.value = appStatus;
                                }
                            })
                            // initPopovers();
                            formatArgs({
                                id: arg.event.id,
                                title: arg.event.title,
                                description: arg.event.extendedProps.description,
                                location: arg.event.extendedProps.location,
                                startStr: arg.event.startStr,
                                endStr: arg.event.endStr,
                                allDay: arg.event.allDay,
                            });
                            handleViewEvent();
                        },
                        datesSet: function(){
                            hidePopovers();
                        }

            });
            calendar.render();

            const formatArgs = (res) => {
                console.log(res);
                data.id = res.id;
                data.eventName = res.title;
                data.eventDescription = res.description;
                data.eventLocation = res.location;
                data.startDate = res.startStr;
                data.endDate = res.endStr;
                data.allDay = res.allDay;
                
            }

            var data = {
                id: '',
                eventName: '',
                eventDescription: '',
                eventLocation: '',
                startDate: '',
                endDate: '',
                allDay: false,
                consultantName: '',
                appType: '',
                appStatus: '',
                mapId: '',                    
            };

            const initPopovers = (element) => {
                hidePopovers();

                // Generate popover content
                const startDate = data.allDay ? moment(data.startDate).format('Do MMM, YYYY') : moment(data.startDate).format('Do MMM, YYYY - h:mm a');
                const endDate = data.allDay ? moment(data.endDate).format('Do MMM, YYYY') : moment(data.endDate).format('Do MMM, YYYY - h:mm a');
                const popoverHtml = '<div class="fw-bolder mb-2">' + data.eventName + '</div><div class="fs-7"><span class="fw-bold">Start:</span> ' + startDate + '</div><div class="fs-7 mb-4"><span class="fw-bold">End:</span> ' + endDate + '</div><div id="kt_calendar_event_view_button" type="button" class="btn btn-sm btn-light-primary">View More</div>';

                // Popover options
                var options = {
                    container: 'body',
                    trigger: 'manual',
                    boundary: 'window',
                    placement: 'auto',
                    dismiss: true,
                    html: true,
                    title: 'Event Summary',
                    content: popoverHtml,
                }

                // Initialize popover
                popover = KTApp.initBootstrapPopover(element, options);

                // Show popover
                popover.show();

                // Update popover state
                popoverState = true;
                handleViewButton();

            }

            const handleViewButton = () => {
                const viewButton = document.querySelector('#kt_calendar_event_view_button');
                viewButton.addEventListener('click', e => {
                    e.preventDefault();

                    hidePopovers();
                    handleViewEvent();
                });
            }

            const createtriggerevent = function(){
                trigerClick1.addEventListener("click", function(){
                    refeshcalender();
                });
            }
            const refeshcalender = function(){
                axios.post(refresh1)
                .then(function (response) {
                console.log(response);
                    calendar.removeAllEventSources()
                    calendar.addEventSource(response.data.getslots)
                    // table?.ajax.reload(null, false);
                })
            }

                    // Handle view event
            const handleViewEvent = () => {
                viewModal.show();
                // Detect all day event
                var eventNameMod;
                var startDateMod;
                var endDateMod;
                // console.log(data);
                // Generate labels
                if (data.allDay) {
                    eventNameMod = 'All Day';
                    startDateMod = moment(data.startDate).format('Do MMM, YYYY');
                    endDateMod = moment(data.endDate).format('Do MMM, YYYY');
                } else {
                    eventNameMod = '';
                    startDateMod = moment(data.startDate).format('Do MMM, YYYY - h:mm a');
                    endDateMod = moment(data.endDate).format('Do MMM, YYYY - h:mm a');
                }
                // Populate view data
            
                viewEventName.innerText = data.eventName;
                viewAllDay.innerText = eventNameMod;
                viewEventDescription.innerText = data.eventDescription ? data.eventDescription : '--';
                viewEventLocation.innerText = data.eventLocation ? data.eventLocation : '--';
                viewStartDate.innerText = startDateMod;
                viewEndDate.innerText = endDateMod;
                viewConsultantName.innerText = data.consultantName ? data.consultantName : '--';
                viewAppStatus.innerText = data.appStatus ? data.appStatus : '--';
                viewAppType.innerText = data.appType ? data.appType : '--';
                viewMapId.innerText = data.id ? data.id : '--';
            } 
       

    //     }
    // }
    // KTUtil.onDOMContentLoaded((function () {
    //     KTcalendar.init()
    // }));
    
