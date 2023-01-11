"use strict";

// Class definition
var KTAppCalendar = function () {
    // Shared variables
    // Calendar variables
    var calendar;
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
    // console.log(data);
    var popover;
    var popoverState = false;

    
    // Add event variables
    var eventName;
    var eventDescription;
    var eventLocation;
    var startDatepicker;
    var startFlatpickr;
    var endDatepicker;
    var endFlatpickr;
    var startTimepicker;
    var startTimeFlatpickr;
    var endTimepicker
    var endTimeFlatpickr;
    var modal;
    var modalTitle;
    var form;
    var validator;
    var addButton;
    var submitButton;
    var cancelButton;
    var closeButton;
    var consultantName;
    var appType;
    var mapId;

    // View event variables
    var viewEventName;
    var viewAllDay;
    var viewEventDescription;
    var viewEventLocation;
    var viewStartDate;
    var viewEndDate;
    var viewModal;
    var viewEditButton;
    var viewDeleteButton;
    var EditingForm = false;
    var recurring;
    var from_date;
    var to_date;
    var EditUrl;
    var viewConsultantName;
    var viewAppType;
    var viewAppStatus;
    var viewMapId;
    var appStatus;

    // Private functions
    var initCalendarApp = function () {
        // Define variables
        var calendarEl = document.getElementById('kt_calendar_app');
        var todayDate = moment().startOf('day');
        var YM = todayDate.format('YYYY-MM');
        var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
        var TODAY = todayDate.format('YYYY-MM-DD');
        var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');

        // Init calendar --- more info: https://fullcalendar.io/docs/initialize-globals
        calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            initialDate: TODAY,
            navLinks: true, // can click day/week names to navigate views
            selectable: true,
            selectMirror: true,

            // Select dates action --- more info: https://fullcalendar.io/docs/select-callback
            select: function (arg) {
                hidePopovers();
                formatArgs(arg);
                handleNewEvent();
            },

            // Click event --- more info: https://fullcalendar.io/docs/eventClick
            eventClick: function (arg) {
                hidePopovers();
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
                    allDay: arg.event.allDay,
                });
                handleViewEvent();
            },

            // MouseEnter event --- more info: https://fullcalendar.io/docs/eventMouseEnter
            eventMouseEnter: function (arg) {
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

            editable: true,
            dayMaxEvents: true, // allow "more" link when too many events

            // Reset popovers when changing calendar views --- more info: https://fullcalendar.io/docs/datesSet
            datesSet: function(){
                hidePopovers();
            }
        });

        calendar.render();
    }
    // Initialize popovers --- more info: https://getbootstrap.com/docs/4.0/components/popovers/
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

        // Open view event modal
        handleViewButton();
    }

    // Hide active popovers
    const hidePopovers = () => {
        if (popoverState) {
            popover.dispose();
            popoverState = false;
        }
    }

    // Init validator
    const initValidator = () => {
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validator = FormValidation.formValidation(
            form,
            {
                fields: {

                },

                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
                    })
                }
            }
        );
    }

    // Initialize datepickers --- more info: https://flatpickr.js.org/
    const initDatepickers = () => {
        startFlatpickr = flatpickr(startDatepicker, {
            enableTime: false,
            dateFormat: "Y-m-d",
        });

        endFlatpickr = flatpickr(endDatepicker, {
            enableTime: false,
            dateFormat: "Y-m-d",
        });

        startTimeFlatpickr = flatpickr(startTimepicker, {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
        });

        endTimeFlatpickr = flatpickr(endTimepicker, {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
        });
    }

    // Handle add button
    const handleAddButton = () => {

        addButton.addEventListener('click', e => {
            hidePopovers();
            // Reset form data
            data = {
                id: '',
                eventName: '',
                eventDescription: '',
                startDate: new Date(),
                endDate: new Date(),
                allDay: false
            };
            handleNewEvent();
        });
    }

    // Handle add new event
    const handleNewEvent = () => {
        // Update modal title
        modalTitle.innerText = "Add a Schedule";

        modal.show();
        EditingForm = false;
        // Select datepicker wrapper elements
        const datepickerWrappers = form.querySelectorAll('[data-kt-calendar="datepicker"]');

        // Handle all day toggle
        const allDayToggle = form.querySelector('#kt_calendar_datepicker_allday');
        allDayToggle.addEventListener('click', e => {
            if (e.target.checked) {
                datepickerWrappers.forEach(dw => {
                    dw.classList.add('d-none');
                });
            } else {
                endFlatpickr.setDate(data.startDate, true, 'Y-m-d');
                datepickerWrappers.forEach(dw => {
                    dw.classList.remove('d-none');
                });
            }
        });

        populateForm(data);
    }
    const refeshcalender = function(){
        axios.post(refresh)
        .then(function (response) {
        //    console.log(response);
            calendar.removeAllEventSources()
            calendar.addEventSource(response.data.getslots)
            // table?.ajax.reload(null, false);
        })
    }
const createformEvent = function (){
    // Handle submit form
    form.addEventListener('submit', function (e) {
        // Prevent default button action
        e.preventDefault();
        let formData = new FormData(e.target);
        formData.append('Consultamt_id',Consultamt_id)

        if (validator) {
            validator.validate().then(function (status) {
                console.log('validated!');

                if (status == 'Valid') {
                    submitButton.setAttribute('data-kt-indicator', 'on');
                    submitButton.disabled = true;
                        submitButton.removeAttribute('data-kt-indicator');
                        $.ajax({
                            method:"POST",
                            url:(EditingForm)?EditUrl:$(form).prop('action'),
                            data:formData,
                            cache: false,
                            processData: false,
                            contentType: false,
                            success:function(data){
                                refeshcalender()
                                modal.hide();
                                submitButton.disabled = false;
                                form.reset();

                                Swal.fire({
                                    text: "New Schedule added to calendar!",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                })
                            },
                            error:function(erroe){
                                submitButton.disabled = false;
                                Swal.fire({
                                    text: "Sorry, looks like there are some errors detected, please try again.",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                });
                            }
                        });


                        // Swal.fire({
                        //     text: "New event added to calendar!",
                        //     icon: "success",
                        //     buttonsStyling: false,
                        //     confirmButtonText: "Ok, got it!",
                        //     customClass: {
                        //         confirmButton: "btn btn-primary"
                        //     }
                        // }).then(function (result) {
                        //     if (result.isConfirmed) {
                        //         modal.hide();
                        //         submitButton.disabled = false;

                        //         // Detect if is all day event
                        //         let allDayEvent = false;
                        //         if (allDayToggle.checked) { allDayEvent = true; }
                        //         if (startTimeFlatpickr.selectedDates.length === 0) { allDayEvent = true; }

                        //         // Merge date & time
                        //         var startDateTime = moment(startFlatpickr.selectedDates[0]).format();
                        //         var endDateTime = moment(endFlatpickr.selectedDates[endFlatpickr.selectedDates.length - 1]).format();
                        //         if (!allDayEvent) {
                        //             const startDate = moment(startFlatpickr.selectedDates[0]).format('YYYY-MM-DD');
                        //             const endDate = startDate;
                        //             const startTime = moment(startTimeFlatpickr.selectedDates[0]).format('HH:mm:ss');
                        //             const endTime = moment(endTimeFlatpickr.selectedDates[0]).format('HH:mm:ss');

                        //             startDateTime = startDate + 'T' + startTime;
                        //             endDateTime = endDate + 'T' + endTime;
                        //         }

                        //         // Add new event to calendar
                        //         calendar.addEvent({
                        //             id: uid(),
                        //             title: eventName.value,
                        //             description: eventDescription.value,
                        //             location: eventLocation.value,
                        //             start: startDateTime,
                        //             end: endDateTime,
                        //             allDay: allDayEvent
                        //         });
                        //         calendar.render();

                        //         // Reset form for demo purposes only
                        //         form.reset();
                        //     }
                        // });
                } else {
                    // Show popup warning
                    Swal.fire({
                        text: "Sorry, looks like there are some errors detected, please try again.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                    submitButton.disabled = false;
                }
            });
        }
    });
}


    // Handle edit event
    const handleEditEvent = () => {
        // Update modal title
        modalTitle.innerText = "Edit an";
        modal.show();
        EditingForm = true
        // Select datepicker wrapper elements
        const datepickerWrappers = form.querySelectorAll('[data-kt-calendar="datepicker"]');

        // Handle all day toggle
        const allDayToggle = form.querySelector('#kt_calendar_datepicker_allday');
        allDayToggle.addEventListener('click', e => {
            if (e.target.checked) {
                datepickerWrappers.forEach(dw => {
                    dw.classList.add('d-none');
                });
            } else {
                endFlatpickr.setDate(data.startDate, true, 'Y-m-d');
                datepickerWrappers.forEach(dw => {
                    dw.classList.remove('d-none');
                });
            }
        });

        EditFormData(data)
        // populateForm(data);
    }

    const EditFormData = function(data){
        const id = data.id.split('-')

        axios.post(`${baseURl}/activities/schedules/${id[0]}/editget?_token=${csrf}`)
        .then(function (response) {
            formrepeat.setList(response.data.data)
            $(`input[name=schedule_type][value='${response.data.schedules.schedule_type}']`).prop("checked",true);
            recurring.value =  response.data.schedules.recurring
            from_date.value = response.data.schedules.from_date
            to_date.value = response.data.schedules.to_date
            EditUrl = response.data.url
            toogleSchedule();
        })
        .catch(function (error) {
            Swal.fire({
                text: "Sorry, looks like there are some errors detected, please try again.",
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "Ok, got it!",
                customClass: {
                    confirmButton: "btn btn-primary"
                }
            });
            return false
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

    // Handle delete event
    const handleDeleteEvent = () => {
        viewDeleteButton.addEventListener('click', e => {
            e.preventDefault();

            Swal.fire({
                text: "Are you sure you would like to delete this event?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, return",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-active-light"
                }
            }).then(function (result) {
                if (result.value) {
                    calendar.getEventById(data.id).remove();

                    viewModal.hide(); // Hide modal
                } else if (result.dismiss === 'cancel') {
                    Swal.fire({
                        text: "Your event was not deleted!.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        }
                    });
                }
            });
        });
    }

    // Handle edit button
    const handleEditButton = () => {
        viewEditButton.addEventListener('click', e => {
            e.preventDefault();

            viewModal.hide();
            handleEditEvent();
        });
    }

    // Handle cancel button
    const handleCancelButton = () => {
        // Edit event modal cancel button
        cancelButton.addEventListener('click', function (e) {
            e.preventDefault();

            Swal.fire({
                text: "Are you sure you would like to cancel?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Yes, cancel it!",
                cancelButtonText: "No, return",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-active-light"
                }
            }).then(function (result) {
                if (result.value) {
                    form.reset(); // Reset form
                    modal.hide(); // Hide modal
                } else if (result.dismiss === 'cancel') {
                    Swal.fire({
                        text: "Your form has not been cancelled!.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        }
                    });
                }
            });
        });
    }

    // Handle close button
    const handleCloseButton = () => {
        // Edit event modal close button
        closeButton.addEventListener('click', function (e) {
            e.preventDefault();

            Swal.fire({
                text: "Are you sure you would like to cancel?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Yes, cancel it!",
                cancelButtonText: "No, return",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-active-light"
                }
            }).then(function (result) {
                if (result.value) {
                    form.reset(); // Reset form
                    modal.hide(); // Hide modal
                } else if (result.dismiss === 'cancel') {
                    Swal.fire({
                        text: "Your form has not been cancelled!.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        }
                    });
                }
            });
        });
    }

    // Handle view button
    const handleViewButton = () => {
        const viewButton = document.querySelector('#kt_calendar_event_view_button');
        viewButton.addEventListener('click', e => {
            e.preventDefault();

            hidePopovers();
            handleViewEvent();
        });
    }

    // Helper functions

    // Reset form validator on modal close
    const resetFormValidator = (element) => {
        // Target modal hidden event --- For more info: https://getbootstrap.com/docs/5.0/components/modal/#events
        element.addEventListener('hidden.bs.modal', e => {
            if (validator) {
                // Reset form validator. For more info: https://formvalidation.io/guide/api/reset-form
                validator.resetForm(true);
            }
        });
    }

    // Populate form
    const populateForm = () => {
        eventName.value = data.eventName ? data.eventName : '';
        eventDescription.value = data.eventDescription ? data.eventDescription : '';
        eventLocation.value = data.eventLocation ? data.eventLocation : '';
        startFlatpickr.setDate(data.startDate, true, 'Y-m-d');

        // Handle null end dates
        const endDate = data.endDate ? data.endDate : moment(data.startDate).format();
        endFlatpickr.setDate(endDate, true, 'Y-m-d');

        const allDayToggle = form.querySelector('#kt_calendar_datepicker_allday');
        const datepickerWrappers = form.querySelectorAll('[data-kt-calendar="datepicker"]');
        if (data.allDay) {
            allDayToggle.checked = true;
            datepickerWrappers.forEach(dw => {
                dw.classList.add('d-none');
            });
        } else {
            startTimeFlatpickr.setDate(data.startDate, true, 'Y-m-d H:i');
            endTimeFlatpickr.setDate(data.endDate, true, 'Y-m-d H:i');
            endFlatpickr.setDate(data.startDate, true, 'Y-m-d');
            allDayToggle.checked = false;
            datepickerWrappers.forEach(dw => {
                dw.classList.remove('d-none');
            });
        }
    }

    // Format FullCalendar reponses
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

    // Generate unique IDs for events
    const uid = () => {
        return Date.now().toString() + Math.floor(Math.random() * 1000).toString();
    }
    const initevents = () => {
        form.querySelectorAll('[name=schedule_type]').forEach(e => {
            e.addEventListener('change',function(event) { toogleSchedule() } )
        })

    }
    
    const toogleSchedule = () => {
        let schedule_type = form.querySelector('[name=schedule_type]:checked').value
        if(schedule_type == 1){
            RemoveRequired(form.querySelector('[data-standard]'),0)
            RemoveRequired(form.querySelector('[data-Variant]'),1)
        }else{
            RemoveRequired(form.querySelector('[data-standard]'),1)
            RemoveRequired(form.querySelector('[data-Variant]'),0)
            if(!EditingForm)Standard()
        }
    }
    
    const RemoveRequired = (Element,state) => {
        if(state){
            Element.querySelectorAll('input').forEach(e => {
                e.removeAttribute('required')
            })
            Element.setAttribute('hidden',true)
        }else{
            Element.querySelectorAll('input').forEach(e => {
                e.setAttribute('required',true)
            })
            Element.removeAttribute('hidden')
        }
    }
    
    const createtriggerevent = function(){
        trigerClick.addEventListener("click", function(){
            refeshcalender();
        });
    }
    return {
        // Public Functions
        init: function () {
            // Define variables
            // Add event modal
            const element = document.getElementById('kt_modal_add_event');
            const trigerClick = document.getElementById('trigerClick');
            form = element.querySelector('#kt_modal_add_event_form');
            eventName = form.querySelector('[name="calendar_event_name"]');
            eventDescription = form.querySelector('[name="description"]');
            eventLocation = form.querySelector('[name="calendar_event_location"]');
            startDatepicker = form.querySelector('#kt_calendar_datepicker_start_date');
            endDatepicker = form.querySelector('#kt_calendar_datepicker_end_date');
            startTimepicker = form.querySelector('#kt_calendar_datepicker_start_time');
            endTimepicker = form.querySelector('#kt_calendar_datepicker_end_time');
            recurring = form.querySelector('#recurring');
            from_date = form.querySelector('#from_date');
            to_date = form.querySelector('#to_date');
            addButton = document.querySelector('[data-kt-calendar="add"]');
            submitButton = form.querySelector('#kt_modal_add_event_submit');
            cancelButton = form.querySelector('#kt_modal_add_event_cancel');
            closeButton = element.querySelector('#kt_modal_add_event_close');
            modalTitle = form.querySelector('[data-kt-calendar="title"]');
            
            modal = new bootstrap.Modal(element);

            // View event modal
            const viewElement = document.getElementById('kt_modal_view_event');
            viewModal = new bootstrap.Modal(viewElement);
            viewEventName = viewElement.querySelector('[data-kt-calendar="event_name"]');
            viewAllDay = viewElement.querySelector('[data-kt-calendar="all_day"]');
            viewEventDescription = viewElement.querySelector('[data-kt-calendar="event_description"]');
            viewEventLocation = viewElement.querySelector('[data-kt-calendar="event_location"]');
            viewStartDate = viewElement.querySelector('[data-kt-calendar="event_start_date"]');
            viewEndDate = viewElement.querySelector('[data-kt-calendar="event_end_date"]');
            viewEditButton = viewElement.querySelector('#kt_modal_view_event_edit');
            viewDeleteButton = viewElement.querySelector('#kt_modal_view_event_delete');
            viewConsultantName = viewElement.querySelector('[data-kt-calendar="c_name"]');
            viewAppType = viewElement.querySelector('[data-kt-calendar="app_type"]');
            viewAppStatus = viewElement.querySelector('[data-kt-calendar="app_status"]');
            viewMapId = viewElement.querySelector('[data-kt-calendar="map_id"]');
            // console.log(appStatus);
            
            initCalendarApp();
            initValidator();
            initDatepickers();
            handleEditButton();
            handleAddButton();
            handleDeleteEvent();
            handleCancelButton();
            handleCloseButton();
            resetFormValidator(element);
            toogleSchedule();
            initevents();
            createformEvent();
            refeshcalender();
            createtriggerevent();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTAppCalendar.init();
});
