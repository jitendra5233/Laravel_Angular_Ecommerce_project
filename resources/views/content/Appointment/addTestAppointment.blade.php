@extends('layouts/contentNavbarLayout')



@section('title', 'Dashboard - Analytics')



@section('vendor-style')

<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">

@endsection



@section('vendor-script')

<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>

@endsection



@section('page-script')


<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>

<script src="{{asset('assets/js/ui-toasts.js')}}"></script>

<script src='https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js'></script>

<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js" charset="utf-8"></script>

<script src="https://cdn.jsdelivr.net/npm/timepicker@1.14.0/jquery.timepicker.js"></script>
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/timepicker@1.14.0/jquery.timepicker.css"
/>

<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">


<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css" >
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.1/css/bootstrap.min.css">

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">

<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.0/css/responsive.bootstrap.min.css">

@endsection

<script

  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAoyZ_yVsI5N8KhjbWRyQeme1Pfz2DRYYc&libraries=places&callback=initAutocomplete"></script>

@section('content')

<style>

  .form-check-input[type=checkbox] {

    border: 1px solid #00000061;

  }



  .error {

    color: red;

  }



  .loader {

    display: none;

    position: fixed;

    top: 0;

    left: 0;

    right: 0;

    bottom: 0;

    width: 100%;

    background: rgba(0, 0, 0, 0.75) url(images/loading2.gif) no-repeat center center;

    z-index: 10000;

  }

</style>

<!-- <script>

  $(document).ready(function () {



    var getemail = $('#email');

    if (getemail.val() == 0) {

      $('#remarkrow').hide();

    }

  });

</script> -->

<div class="loader"></div>

<div class="row">

  <div class="col-md-12">



    <div class="card mb-4">

      <h5 class="card-header">New Appointment</h5>

      <!-- Account -->

      <div class="card-body">

        <div class="row">

        <div class="mb-3 col-md-6">

        <label for="exampleFormControlSelect1" class="form-label">Call Back Status</label>

          <select name="callbackstatus" class="form-select btn-sm" id="callbackstatus" aria-label="Default select example">

            <option value="0" <?php echo $client[0]->status == 0 ? 'selected': '' ?>>Pending</option>

            <option value="1" <?php echo $client[0]->status == 1 ? 'selected': '' ?>>Assigned</option>

            <option value="2" <?php echo $client[0]->status == 2 ? 'selected': '' ?>>Cancelled</option>

            <option value="3" <?php echo $client[0]->status == 3 ? 'selected': '' ?>>Completed</option>

            </select>

        </div>

        </div>

        <div class="row" id="remarkrow">

          <div class="mb-3 col-md-12">

            <label for="exampleFormControlSelect1" class="form-label">Enter Your Remark</label>

            <textarea class="form-control" type="text" id="addremark" name="remark">{{(!empty($client[0]->remark)) ? $client[0]->remark :''}}</textarea>

          </div>

          <div class="mb-3 col-md-4">

            <input type='checkbox' id="check" onchange='handleChange(this);'>

            <label for="check">Click here and add Your Appointment</label>

          </div>

        <div id="mydata" style="display:none;">

          <div class="row" id="myheader">

            <div class="mb-3 col-md-6">

              <input type="hidden" name="clientid" id="clientid" value="{{(!empty($client[0]->id)) ? $client[0]->id :''}}">

              <label for="exampleFormControlSelect1" class="form-label">First Name</label>

              <input class="form-control" type="text" id="firstName" name="firstName"

                value="{{(!empty($client[0]->name)) ? $client[0]->name :''}}">

            </div>

            <div class="mb-3 col-md-6">

              <label for="exampleFormControlSelect1" class="form-label">last Name</label>

              <input class="form-control" type="text" id="lastName" name="lastName"

                value="{{(!empty($client[0]->last_name)) ? $client[0]->last_name :''}}">

            </div>

            <div class="mb-3 col-md-6">

              <label for="exampleFormControlSelect1" class="form-label"> Email

              </label>

              <input class="form-control" type="text" id="email" name="email"

                value="{{(!empty($client[0]->email)) ? $client[0]->email :''}}">

            </div>

            <div class="mb-3 col-md-6">

              <label for="exampleFormControlSelect1" class="form-label">Phone</label>

              <input class="form-control" type="text" id="phone" name="phone"

                value="{{(!empty($client[0]->phone)) ? $client[0]->phone :''}}">

            </div>

            <div class="mb-3 col-md-12">

              <label for="address" class="form-label">Agent Location</label>

              <input type="text" class="form-control" id="address" name="location" placeholder="Enter Agent Location" />

            </div>

            <div class="mb-3 col-md-6">

              <label for="exampleFormControlSelect1" class="form-label">Users</label>

              <select id="user" name="user" class="select2 form-select" onchange="getAgentTimeSlot(event.target.value)">

                <option value="0">Select User</option>

                <option value="no_user">No User</option>

              </select>

            </div>

                <div class="mb-3 col-md-6">

                <label for="exampleFormControlSelect1" class="form-label">Property</label>

                <select  name="property" class="form-select" id="property" aria-label="Default select example" onclick="changeProeprtyID(event.target.value)">

                <option value="0">Select Property</option>

                <option value="no_property">No Property</option>


                </select>

                </div>


            <div class="mb-3 col-md-6" id='datepickerInput' name='datepickerInput'>

              <label for="exampleFormControlSelect1" class="form-label">Date</label>

              <input class="form-control" type="text" value="" readonly="readonly" id="datepicker">

            </div>

            <div class="mb-3 col-md-6">

              <label for="exampleFormControlSelect1" class="form-label">Time</label>

              <input class="form-control" type="text" value=""  id="time">

            </div>

          </div>

        </div>

        <hr class="my-0">

        <div class="card-body" id="myfooter">

          <div class="row">

            <div class="mt-4" id="firstbtn" style="display:none">

              <button type="submit" class="btn btn-primary me-2" id="postme" onclick="handleSubmit()">Save

                changes</button>

                

            </div>

            <div class="mt-4" id="secondbtn">

            <button type="submit" class="btn btn-primary me-2" id="postme1" onclick="handleSubmit1()">Save

                Remark</button>

                

              </div>

          </div>

        </div>

      </div>





      <!-- /Notifications -->

    </div>

  </div>

  <!-- /Account -->

</div>

</div>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.1.3/axios.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<link rel="stylesheet" href="sweetalert2.min.css">
<script async  src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script async  src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

<script>


var dateArry = [];
      var slotG = [];
      var workingDays = []

      let propertyId = 0;
      let userId = 0;
      
      changeProeprtyID = (id) =>{
        propertyId = id;
      }

      updateAb = (date) => {
        let ndate = new Date(date);
        let day = new Date(date).getDay();
        ndate = ndate.toISOString();
        ndate = ndate.substring(0, ndate.indexOf("T"));

        console.log(ndate, day);
        let data = new FormData();
        data.append("propertyId", propertyId);
        data.append("userId", userId);
        data.append("ndate", ndate);

        axios
          .post(`{{ENV("APP_URL")}}/api/getAppointmentTime`, data)
          .then((res) => {
            let times = [];

            slot = JSON.parse(slotG.dataJson);

            time_arr = ["00:00", slot[day].start, slot[day].end, "23:45"];

            res.data.map((x) => {
              let end = x.time;
              let start = end.substring(0, end.indexOf("pm"));
              let startEnd = end.substring(end.indexOf(":"), end.length);
              start = start.substring(0, start.indexOf(":"));
              start = parseInt(start) + 2;
              let endFull = start + startEnd;

              time_arr.push(end, endFull);
            });

            time_arr.forEach(function (v, k, arr) {
              if (k % 2 & 1) times.push([arr[k - 1], arr[k]]); // check for odd keys
            });

            $("#time").timepicker({
              disableTimeRanges: times,
            });
          })
          .catch((err) => {
            console.log(err);
          });
      };

  $(document).ready(function () {

    $('#mydata').hide();

    $('secondbtn').show(); 

  });

  function handleChange(checkbox) {

    if (checkbox.checked == true) {

      $('#mydata').show();

      $('#firstbtn').show();

      $('#secondbtn').hide();

      // handleSubmit();

    }

     else {



      $('#mydata').hide();

      $('#firstbtn').hide();

      $('#secondbtn').show();

    }

  }



  function handleSubmit() {

        let firstName = document.getElementById('firstName').value;

        let lastName = document.getElementById('lastName').value;

        let email = document.getElementById('email').value;

        let phone = document.getElementById('phone').value;

        let property = document.getElementById('property').value;

        let user = document.getElementById('user').value;

        let date = document.getElementById('datepicker').value;

        let time = document.getElementById('time').value;

        let addremark = document.getElementById('addremark').value;

        let clientid = document.getElementById('clientid').value;

        var e = document.getElementById("callbackstatus");

        var status=e.value;

        $(".error").remove();

        var spinner = $('.loader');

        spinner.show();

        if (addremark.length < 10) {

          $('#addremark').after('<span class="error">Fill Remark  More than 10  Charecters*</span>');

          spinner.hide();

          return false;

        }



        if (firstName.length < 1) {

          $('#firstName').after('<span class="error">This field is required*</span>');

          spinner.hide();

          return false;

        }

      

        if (lastName.length < 1) {

          $('#lastName').after('<span class="error">This field is required*</span>');

          spinner.hide();
          return false;
        }

        if (email.length < 1) {

          $('#email').after('<span class="error">This field is required*</span>');

          spinner.hide();

          return false;



        } else {

          var regEx = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/;

          var validEmail = regEx.test(email);

          if (!validEmail) {

            $('#email').after('<span class="error">Enter a valid email*</span>');

            spinner.hide();



            return false;



          }

        }



        if (phone.length < 8 || phone.length > 13) {

          $('#phone').after('<span class="error">Phone Length Should be in Between 8 To 13 Digit*</span>');

          spinner.hide();

          return false;

        }



        var getaddress=$('#address');

        if (getaddress.val() == 0) {

          $('#address').after('<span class="error">Chose a Valid address for Choose valid user acording to area*</span>');

          spinner.hide();

          return false;

        }

        var getuser = $('#user');

        if (getuser.val() == 0) {

          $('#user').after('<span class="error"> Select a Valid User*</span>');

          spinner.hide();

          return false;

        }

        var getproperty = $('#property');

        if (getproperty.val() == 0) {

          $('#property').after('<span class="error"> Select a Valid Property*</span>');

          spinner.hide();

          return false;

        }

        if (date == '') {

          $('#date').after('<span class="error"> Date is Required*</span>');

          spinner.hide();

          return false;

        }



        if (time == '') {

          $('#time').after('<span class="error"> Time is Required*</span>');

          spinner.hide();

          return false;

        }

        else {

          let data = new FormData;

          data.append('firstName', firstName);

          data.append('lastName', lastName);

          data.append('email', email);

          data.append('phone', phone);

          data.append('property', property);

          data.append('user', user);

          data.append('date', date);

          data.append('time', time);

          data.append('remark', addremark);

          data.append('id', clientid);

          data.append('status',status);

          axios.post('{{ENV("APP_URL")}}/submit-appointment', data).then((result) => {

            if(result.data ==1)
            {
            spinner.hide();
           Swal.fire('Appointment Added Successfully!', '', 'success').then((result) => {     
             window.location.href = '{{ENV("APP_URL")}}/appointment-view';
        });
              

            }

          }).catch((err) => {

            spinner.hide();

            console.log(err)

          });

        }



      }



  function handleSubmit1() {

        let addremark = document.getElementById('addremark').value;

        let clientid = document.getElementById('clientid').value;

        var e = document.getElementById("callbackstatus");

        var status=e.value;

        $(".error").remove();

        var spinner = $('.loader');

        spinner.show();

        if (addremark.length < 10) {

          $('#addremark').after('<span class="error">Fill Remark  More than 10  Charecters*</span>');

          spinner.hide();

          return false;

        }

        else {

          let data = new FormData;

          data.append('firstName', '0');

          data.append('lastName', '0');

          data.append('email', '0');

          data.append('phone', '0');

          data.append('property', '0');

          data.append('user', '0');

          data.append('date', '0');

          data.append('time', '0');

          data.append('remark',addremark);

          data.append('id',clientid);

          data.append('status',status);

          axios.post('{{ENV("APP_URL")}}/submit-appointment', data).then((result) => {

            if (result.data == 1) {
         spinner.hide();
        Swal.fire('Remark  Added Successfully!', '', 'success').then((result) => {     
             window.location.href = '{{ENV("APP_URL")}}/callback';
        });
              

            }

          }).catch((err) => {

            spinner.hide();

            console.log(err)

          });

        }

      }



</script>

<script>

  function init() {

    var input = document.getElementById("address");

    var autocomplete = new google.maps.places.Autocomplete(input);

    autocomplete.addListener('place_changed', fillInAddress)

    function fillInAddress() {

      var place = autocomplete.getPlace();

      var address = place.formatted_address;

      let userElement = document.getElementById('user')

      let data = new FormData;

      data.append('location', address)

      axios.post('{{ENV("APP_URL")}}/getuserbyaddress', data).then((result) => {

        var i, L = userElement.options.length - 1;

        for (i = L; i >= 0; i--) {

          userElement.remove(i);

        }

        var doption = document.createElement("option");

        doption.text = 'Select';

        doption.value = 0;

        userElement.appendChild(doption);

        var doption2 = document.createElement("option");

        doption2.text = 'No User';

        doption2.value = 'no_user';

        userElement.appendChild(doption2);

        result.data.map(x => {

          var option = document.createElement("option");

          option.text = x.first_name + " " + x.last_name;

          option.value = x.id;

          userElement.appendChild(option);

        })

      }).catch((err) => {

        console.log(err)

      });

    }

  }

  google.maps.event.addDomListener(window, "load", init);

</script>







<script>







  // var dateArry = [];



  



    getPublicHolidayData = () =>{



      axios.get('{{ENV("APP_URL")}}/api/getAllPublicHolidays').then(res=> {

        axios
          .get('{{ENV("APP_URL")}}/api/getWorkingDays')
          .then((res2) => {
            workingDays = JSON.parse(res2.data[0].access);
 

  



        let newArr = [];



        res.data.map(x => {



                  let noOfAddYear = 20;



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



                          newArr.push(newObj)



                      }



                  } else {



                      newArr.push(x)



                  }



              })



  



  



        newArr.map(x=>{



          dateArry.push(x.date)



        })



  



        $('#datepicker').datepicker({

          dateFormat: "yy-mm-dd",

          minDate: 0,

          onSelect: function (selected, evnt) {
                updateAb(selected);
              },

          beforeShowDay: function(date){



            var string = jQuery.datepicker.formatDate('yy-mm-dd', date);



            return [ dateArry.indexOf(string) == -1 ]



          }



        });




      }).catch(err => {



console.log(err)



})


      }).catch(err => {



        console.log(err)



      })



    }







    // getPublicHolidayData();
    
    $('document').ready(function() {
      setTimeout(() => {
        getPublicHolidayData();
      }, 2000);
    })








    let dateStore = [];



  



    getAgentTimeSlot = (id) => {

      userId = id

      let userElement1 = document.getElementById('property')



    dateStore = [];







      let data = new FormData();



  



      data.append('id',id);



  



      axios.post('{{ENV("APP_URL")}}/api/getAgentSlot',data).then(res => {





        let dataJson = [];



        let appointmeant = res.data.appointmeant;



        let slot = res.data.slot;
        slotG = res.data.slot[0];



        let property =res.data.property;







        // Jitendra Code is start here

        var i, L = userElement1.options.length - 1;



for(i = L; i >= 0; i--) {



  userElement1.remove(i);



}



var doption = document.createElement("option");



  doption.text = 'Select Property';



  doption.value = 0;



  userElement1.appendChild(doption);



  var doption2 = document.createElement("option");



  doption2.text = 'No Property';



  doption2.value = 'no_property';



  userElement1.appendChild(doption2);



  property.map(x => {



    var option = document.createElement("option");



    option.text = x.name;



    option.value = x.id;



    userElement1.appendChild(option);



  })



        // Jitendra Code is end here

  



        if(slot.length != 0){



          dataJson = JSON.parse(slot[0].dataJson);



        }



  



        if(appointmeant.length !=0){



          appointmeant.map(x => {



            let checkWeakDay = new Date(x.date).getDay();



            // let thatDaySlot = dataJson[checkWeakDay] == undefined ? 5 : dataJson[checkWeakDay].no;



            let thatDaySlot = dataJson[checkWeakDay].no == ''  ?  0 : dataJson[checkWeakDay].no;







            // if(dateStore.length != 0){



            //   dateStore.map(y=>{



            //     if(y.date == x.date){



            //       y.booking += 1;



            //     }else{



            //       dateStore.push({



            //         id: 1,



            //         date: x.date,



            //         maxBooking: thatDaySlot,



            //         booking:1



            //       })



            //     }



            //   })



            // }else{



            //   dateStore.push({



            //     id: 1,



            //     date: x.date,



            //     maxBooking: thatDaySlot,



            //     booking:1



            //   })



            // }







            dateStore.push({



              id: x.id,



              date: x.date,



              maxBooking: parseInt(thatDaySlot),



            })



          })







          const res = {};



          dateStore.forEach((obj) => {



            const key = obj.date;



            if (!res[key]) {



                res[key] = { ...obj, booking: 0 };



            };



            res[key].booking += 1;



          });







          dateStore = Object.values(res);



          



          let dayOff = []



          dataJson.map(x => {



            if(x.no == '' || x.no == 0){



              dayOff.push({id:x.id,status:true})



            }else{



              dayOff.push({id:x.id,status:false})



            }



          })







         let fulldates = [];







          $("#datepicker").remove();







          $('#datepickerInput').append('<input class="form-control" type="text" value="" id="datepicker" readonly="readonly" placeholder="Select Date">');



          



          var dates = ["29/12/2022",];



          $( "#datepicker" ).datepicker({

            dateFormat: "yy-mm-dd",

            minDate: 0,

            onSelect: function (selected, evnt) {
                updateAb(selected);
              },

            beforeShowDay: function(date){



              var string = jQuery.datepicker.formatDate('yy/mm/dd', date);



              var string2 = jQuery.datepicker.formatDate('yy-mm-dd', date);







              let statusD = fulldates.indexOf(string) == -1







              if (date.getDay() === 1 && dayOff[0].status === false){



                let fStatus = statusD == true;



                return getResult(string2);



              } else if (date.getDay() === 2 && dayOff[1].status === false){



                let fStatus = statusD == true;



                return getResult(string2);



              }else if (date.getDay() === 3 && dayOff[2].status === false){



                let fStatus = statusD == true;



                return getResult(string2);



              }else if (date.getDay() === 4 && dayOff[3].status === false){



                let fStatus = statusD == true;



                return getResult(string2);



              }else if (date.getDay() === 5 && dayOff[4].status === false){



                let fStatus = statusD == true;



                return getResult(string2);



              }else if (date.getDay() === 6 && dayOff[5].status === false){



                let fStatus = statusD == true;



                return getResult(string2);



              }else if (date.getDay() === 0 && dayOff[6].status === false){



                let fStatus = statusD == true;



                return getResult(string2);



              }else { 



                return [ false, "closed", "Closed" ]



              }



            }



          }); 







          











        }else{



          let dayOff = []



          dataJson.map(x => {



            if(x.no == ''){



              dayOff.push({id:x.id,status:true})



            }else{



              dayOff.push({id:x.id,status:false})



            }



          })



          $("#datepicker").remove();



          



          $('#datepickerInput').append('<input class="form-control" type="text" value="" id="datepicker" readonly="readonly" placeholder="Select Date">');



          



          



          if(dayOff.length != 0){ 



              $( "#datepicker" ).datepicker({

                dateFormat: "yy-mm-dd",

                minDate: 0,

                onSelect: function (selected, evnt) {
                updateAb(selected);
              },

                beforeShowDay: function(date){



                  if (date.getDay() === 1 && dayOff[0].status === false){



                    return [ true, "", "" ]



                  } else if (date.getDay() === 2 && dayOff[1].status === false){



                  return [ true, "", "" ]



                }else if (date.getDay() === 3 && dayOff[2].status === false){



                  return [ true, "", "" ]



                }else if (date.getDay() === 4 && dayOff[3].status === false){



                  return [ true, "", "" ]



                }else if (date.getDay() === 5 && dayOff[4].status === false){



                  return [ true, "", "" ]



                }else if (date.getDay() === 6 && dayOff[5].status === false){



                  return [ true, "", "" ]



                }else if (date.getDay() === 7 && dayOff[6].status === false){



                  return [ true, "", "" ]



                }else { 



                  return [ false, "closed", "Closed" ]



                } 



              }



            }); 



          }else{



            $( "#datepicker" ).datepicker({

              dateFormat: "yy-mm-dd",

              minDate: 0,

              onSelect: function (selected, evnt) {
                updateAb(selected);
              },

              beforeShowDay: function(date){



                return [ false, "closed", "Closed" ];



              }



            }); 



          }



        }



      }).catch(err => {



        console.log(err);



      })



    }







    getResult = (date) => {

      let checkDate = new Date(date).getDay();
        

        if(checkDate == 0){
          console.log(date,workingDays.d7)
          if(workingDays.d7 == false){
            return [false, "", ""];
          }
        }
        if(checkDate == 1){
          if(workingDays.d1 == false){
            return [false, "", ""];
          }
        }
        if(checkDate == 2){
          if(workingDays.d2 == false){
            return [false, "", ""];
          }
        }
        if(checkDate == 3){
          if(workingDays.d3 == false){
            return [false, "", ""];
          }
        }
        if(checkDate == 4){
          if(workingDays.d4 == false){
            return [false, "", ""];
          }
        }
        if(checkDate == 5){
          if(workingDays.d5 == false){
            return [false, "", ""];
          }
        }
        if(checkDate == 6){
          if(workingDays.d6 == false){
            return [false, "", ""];
          }
        }


        for(let i = 0; i < dateArry.length ; i++){



          if(dateArry[i] == date){



            console.log('ok',date)



            return [false,'',''];



          }



        }



        for(let i = 0; i < dateStore.length ; i++){



          if(dateStore[i].date == date){



            console.log(dateStore[i]);



            if(dateStore[i].booking == dateStore[i].maxBooking){



              return [false,'',''];



            }else{



              return [true,'',''];



            }



          }



        }



        return [ true, '', '' ];



    }



  </script>





@endsection