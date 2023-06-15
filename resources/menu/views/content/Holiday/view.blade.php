@extends('layouts/contentNavbarLayout')

@section('title', '')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script src='https://cdn.jsdelivr.net/npm/rrule@2.6.4/dist/es5/rrule.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/rrule@5.5.0/main.global.min.js'></script>
@section('content')
<h4 class="fw-bold py-3 mb-4">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
        Add Holiday
    </button>
</h4>

<!-- Modal -->
<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">New Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 mb-3">
                        <label for="HolidayName" class="form-label">Name</label>
                        <input type="text" id="HolidayName" class="form-control" placeholder="Enter Name">
                    </div>
                    <div class="col-12 mb-3">
                        <label for="HolidayDate" class="form-label">Date</label>
                        <input class="form-control" type="date" value="" id="HolidayDate">
                    </div>
                    <div class="col-12 mb-3 form-switch" style="padding-left: 1rem">
                        <label class="form-check-label" for="flexSwitchCheckChecked">Every Year</label>
                        <input type="checkbox" name="acceptRules" class="form-check-input" id="flexSwitchCheckChecked"
                            value="false" style="margin-left: 0">
                        <!-- <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked="" style="margin-left: 0"> -->
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="handleSaveHoliday()">Save</button>
            </div>
        </div>
    </div>
</div>

<div id='calendar'></div>
<input type="hidden" id="checkbox-value" value="">
<script>
    $('#checkbox-value').val($('#flexSwitchCheckChecked').val());
    $("#flexSwitchCheckChecked").on('change', function () {
        if ($(this).is(':checked')) {
            $(this).attr('value', 'true');
        } else {
            $(this).attr('value', 'false');
        }
        $('#checkbox-value').val($('#flexSwitchCheckChecked').val());
    });

    var calendarEl = document.getElementById('calendar');
    var calendar = '';
    document.addEventListener('DOMContentLoaded', function () {
        calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: "prev,next today",
                center: "title",
                right: "dayGridMonth,timeGridWeek,timeGridDay",
            },
            initialDate: new Date,
            navLinks: true,
            selectMirror: true,
            dayMaxEvents: true,
        });
        calendar.render();
    });

    handleSaveHoliday = () => {
        let title = document.getElementById('HolidayName').value;
        let hDate = document.getElementById('HolidayDate').value;
        let everyyear = document.getElementById('checkbox-value').value;
        let data = new FormData;
        data.append('title', title);
        data.append('hDate', hDate);
        data.append('everyyear', everyyear);
        axios.post('{{ENV("APP_URL")}}/save_holiday', data).then((result) => {
            calendar.addEvent({
                title: document.getElementById('HolidayName').value,
                start: document.getElementById('HolidayDate').value,
                end: document.getElementById('HolidayDate').value,
                allDay: true,
            });
            $('#basicModal').modal('hide');
        }).catch((err) => {
            console.log(err);
        });
    }

    getAllHolidays = () => {
        axios.get('{{ENV("APP_URL")}}/getAllHolidays').then((result) => {
            let newArr = [];
            result.data.map(x => {
                let noOfAddYear = 30;
                if (x.everyYear == 'true') {
                    let date = new Date(x.date).getFullYear();
                    let month = new Date(x.date).getMonth()+1;
                    let day = new Date(x.date).getDate();
                    for (let i = 0; i <= noOfAddYear; i++) {
                        if(day < 10 && month < 10)
                        {
                            var newDate = `${date + i}-0${month}-0${day}`
                        }
                        if(day > 10 && month > 10){
                            var newDate = `${date + i}-${month}-${day}`
                        }
                        if(day < 10  && month > 10){
                            var newDate = `${date + i}-${month}-0${day}`  
                        }
                       if(month < 10 && day > 10 ){
                            var newDate = `${date + i}-0${month}-${day}`
                        }

                        let newObj = {
                            'userId': x.userId,
                            'date': newDate,
                            'id': x.id+i,
                            'name': x.name,
                            'everyYear': x.everyYear,
                            'created_at': x.created_at,
                            'updated_at': x.updated_at,
                        }
                        console.log(newObj);
                        newArr.push(newObj)
                    }
                } else {
                    newArr.push(x)
                }
            })

            console.log(newArr)

            newArr.map(x=>{
                calendar.addEvent({
                    title: x.name,
                    start: x.date,
                    end: x.date,
                    allDay: true,
                });
            })
        }).catch((err) => {
            console.log(err)
        });
    }

    getAllHolidays()
</script>

<!--/ Basic Bootstrap Table -->
@endsection
