<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Appointmeant</title>
    <link
      rel="stylesheet"
      href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css"
    />

    <link rel="stylesheet" href="/resources/demos/style.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/timepicker@1.14.0/jquery.timepicker.js"></script>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/timepicker@1.14.0/jquery.timepicker.css"
    />

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
      crossorigin="anonymous"
    />
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
      crossorigin="anonymous"
    ></script>
  </head>
  <body>
    <div class="myContainer">
      <div>
        <div class="row" style="--bs-gutter-x: 0; padding: 1rem">
          <div class="col-12 text-center">
            <h4 class="pt-2 pb-3">SCHEDULE A TOUR</h4>
          </div>
          <div class="col-12 col-md-12 col-lg-6">
            <div class="mb-3 px-2">
              <label for="exampleInputEmail1" class="form-label">
                First Name
              </label>
              <input type="text" id="fname" class="form-control" />
            </div>
          </div>
          <div class="col-12 col-md-12 col-lg-6">
            <div class="mb-3 px-2">
              <label for="exampleInputEmail1" class="form-label">
                Last Name
              </label>
              <input id="lname" type="text" class="form-control" />
            </div>
          </div>
          <div class="col-12 col-md-12 col-lg-6">
            <div class="mb-3 px-2">
              <label for="exampleInputEmail1" class="form-label"> Email </label>
              <input id="email" type="text" class="form-control" />
            </div>
          </div>
          <div class="col-12 col-md-12 col-lg-6">
            <div class="mb-3 px-2">
              <label for="exampleInputEmail1" class="form-label"> Phone </label>
              <input id="phone" type="text" class="form-control" />
            </div>
          </div>
          <div class="col-12 col-md-12 col-lg-6">
            <div class="mb-3 px-2">
              <label for="exampleInputEmail1" class="form-label"> Date </label>
              <div id="datepickerInput">
                {{-- <input type="text" id="datepicker" readonly="readonly" /> --}}
                <input class="form-control" type="text" value="" id="datepicker" readonly="readonly" placeholder="Select Date">
                <input
                  type="hidden"
                  id="aID"
                  value="<?php if(isset($_GET['id'])) echo $_GET['id']; ?>"
                />
                <input
                  type="hidden"
                  id="pID"
                  value="<?php if(isset($_GET['pid'])) echo $_GET['pid']; ?>"
                />
              </div>
            </div>
          </div>
          <div class="col-12 col-md-12 col-lg-6">
            <div class="mb-3 px-2">
              <label for="exampleInputEmail1" class="form-label"> Time </label>
              <input id="a_time" type="text"  class="form-control" />
            </div>
          </div>
          <div class="col-12 col-md-12 col-lg-6">
            <button
              onclick="closeWin()"
              class="btn btn-primary"
              style="background-color: #000000"
            >
              Close
            </button>
            <button
              onclick="handelSubmit()"
              class="btn btn-primary mx-2"
              style="background-color: #11574b"
            >
              Submit
            </button>
          </div>
        </div>
      </div>
    </div>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.2.2/axios.min.js"
      integrity="sha512-QTnb9BQkG4fBYIt9JGvYmxPpd6TBeKp6lsUrtiVQsrJ9sb33Bn9s0wMQO9qVBFbPX3xHRAsBHvXlcsrnJjExjg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
    <script>
      var dateArry = [];
      var slotG = [];
      var workingDays = []
      updateAb = (date) => {
        let ndate = new Date(date);
        let day = new Date(date).getDay();
        ndate = ndate.toISOString();
        ndate = ndate.substring(0, ndate.indexOf("T"));

        console.log(ndate, day);
        let data = new FormData();
        data.append("propertyId", document.getElementById("pID").value);
        data.append("userId", document.getElementById("aID").value);
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

            $("#a_time").timepicker({
              disableTimeRanges: times,
              forceRoundTime: true
            });
          })
          .catch((err) => {
            console.log(err);
          });
      };

      closeWin = () => {
        window.parent.document.getElementById("ok").click();
      };

      handelSubmit = () => {
        let fname = document.getElementById("fname");
        let lname = document.getElementById("lname");
        let email = document.getElementById("email");
        let phone = document.getElementById("phone");
        let a_date = document.getElementById("datepicker");
        let a_time = document.getElementById("a_time");

        let data = "";
        if (fname.value == undefined) {
          data += '<div class="errorName">First Name Required</div>';
        }
        if (lname.value == undefined) {
          data += '<div class="errorName">Last Name Required</div>';
        }
        if (/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/.test(email.value)) {
        } else {
          data +=
            '<div class="errorName">Invalid Email Address or Use Small Letters</div>';
        }
        if (phone.value == undefined) {
          data += '<div class="errorName">Invalid Phone</div>';
        } else {
          if (phone.value.length >= 8 && phone.value.length <= 13) {
          } else {
            data += '<div class="errorName">Invalid Phone</div>';
          }
        }
        if (a_date.value == undefined) {
          data += '<div class="errorName">Date Required</div>';
        }
        if (a_time.value == undefined) {
          data += '<div class="errorName">Time Required</div>';
        }
        if (data == "") {
          let data = new FormData();
          data.append("fname", fname.value);
          data.append("lname", lname.value);
          data.append("email", email.value);
          data.append("phone", phone.value);
          data.append("a_date", a_date.value);
          data.append("a_time", a_time.value);
          data.append("propertyId", document.getElementById("pID").value);
          data.append("userId", document.getElementById("aID").value);
          axios
            .post(`{{ENV("APP_URL")}}/api/saveAppointmeant`, data)
            .then((res) => {
              console.log(res);
              //   Swal.fire("Submitted Successfully", "", "success");
              closeWin();
            })
            .catch((err) => {
              console.log(err);
            });
          //   this.ds.saveAppointmeant(data).subscribe((response) => {
          //     this.fname = "";
          //     this.lname = "";
          //     this.email = "";
          //     this.phone = "";
          //     this.a_date = "";
          //     this.a_time = "";
          //     this.closeModel();
          //     Swal.fire("Submitted Successfully", "", "success");
          //   });
        } else {
          Swal.fire({
            title: "",
            icon: "error",
            html: `<div>${data}</div>`,
            showCloseButton: true,
            confirmButtonText: "close",
          });
        }
      };

      getPublicHolidayData = () => {
        axios
          .get('{{ENV("APP_URL")}}/api/getAllPublicHolidays')
          .then((res) => {
          
            axios
          .get('{{ENV("APP_URL")}}/api/getWorkingDays')
          .then((res2) => {
            workingDays = JSON.parse(res2.data[0].access);
 
            let newArr = [];

            res.data.map((x) => {
              let noOfAddYear = 20;

              if (x.everyYear == "true") {
                let date = new Date(x.date).getFullYear();

                let month = new Date(x.date).getMonth() + 1;

                let day = new Date(x.date).getDate();

                for (let i = 0; i <= noOfAddYear; i++) {
                  if (day < 10 && month < 10) {
                    var newDate = `${date + i}-0${month}-0${day}`;
                  }

                  if (day > 10 && month > 10) {
                    var newDate = `${date + i}-${month}-${day}`;
                  }

                  if (day < 10 && month > 10) {
                    var newDate = `${date + i}-${month}-0${day}`;
                  }

                  if (month < 10 && day > 10) {
                    var newDate = `${date + i}-0${month}-${day}`;
                  }

                  let newObj = {
                    userId: x.userId,

                    date: newDate,

                    id: x.id + i,

                    name: x.name,

                    everyYear: x.everyYear,

                    created_at: x.created_at,

                    updated_at: x.updated_at,
                  };

                  newArr.push(newObj);
                }
              } else {
                newArr.push(x);
              }
            });

            newArr.map((x) => {
              dateArry.push(x.date);
            });

            $("#datepicker").datepicker({
              minDate: 0,
              dateFormat: "yy-mm-dd",
              onSelect: function (selected, evnt) {
                updateAb(selected);
              },
              beforeShowDay: function (date) {
                var string = jQuery.datepicker.formatDate("yy-mm-dd", date);

                return [dateArry.indexOf(string) == -1];
              },
            });
            let aId = document.getElementById("aID").value;
            getAgentTimeSlot(aId);
          })
        }).catch(err => {
            
          })
          .catch((err) => {
            console.log(err);
          });
      };

      getPublicHolidayData();

      let dateStore = [];

      getAgentTimeSlot = (id) => {
        let userElement1 = document.getElementById("property");

        dateStore = [];

        let data = new FormData();

        data.append("id", id);

        axios
          .post('{{ENV("APP_URL")}}/api/getAgentSlot', data)
          .then((res) => {
            let dataJson = [];

            let appointmeant = res.data.appointmeant;

            let slot = res.data.slot;
            slotG = res.data.slot[0];

            let property = res.data.property;

            if (slot.length != 0) {
              dataJson = JSON.parse(slot[0].dataJson);
            }

            if (appointmeant.length != 0) {
              appointmeant.map((x) => {
                let checkWeakDay = new Date(x.date).getDay();

                // let thatDaySlot = dataJson[checkWeakDay] == undefined ? 5 : dataJson[checkWeakDay].no;

                let thatDaySlot =
                  dataJson[checkWeakDay].no == ""
                    ? 0
                    : dataJson[checkWeakDay].no;

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
                });
              });

              const res = {};

              dateStore.forEach((obj) => {
                const key = obj.date;

                if (!res[key]) {
                  res[key] = { ...obj, booking: 0 };
                }

                res[key].booking += 1;
              });

              dateStore = Object.values(res);

              let dayOff = [];

              dataJson.map((x) => {
                if (x.no == "" || x.no == 0 || x.no == '0') {
                  dayOff.push({ id: x.id, status: true });
                } else {
                  dayOff.push({ id: x.id, status: false });
                }
              });

              console.log(dayOff)

              let fulldates = [];

              $("#datepicker").remove();

              $("#datepickerInput").append(
                '<input class="form-control" type="text" value="" id="datepicker" readonly="readonly" placeholder="Select Date">'
              );

              var dates = ["29/12/2022"];

              $("#datepicker").datepicker({
                minDate: 0,
                dateFormat: "yy-mm-dd",
                onSelect: function (selected, evnt) {
                  updateAb(selected);
                },
                beforeShowDay: function (date) {
                  var string = jQuery.datepicker.formatDate("yy/mm/dd", date);

                  var string2 = jQuery.datepicker.formatDate("yy-mm-dd", date);

                  let statusD = fulldates.indexOf(string) == -1;

                

                  if (date.getDay() === 1) {
                    let fStatus = statusD == true;

                    return getResult(string2,dayOff[1].status);
                  } else if (
                    date.getDay() === 2
                  ) {
                    let fStatus = statusD == true;

                    return getResult(string2,dayOff[2].status);
                  } else if (
                    date.getDay() === 3 
                  ) {
                    let fStatus = statusD == true;

                    return getResult(string2,dayOff[3].status);
                  } else if (
                    date.getDay() === 4
                  ) {
                    let fStatus = statusD == true;

                    return getResult(string2,dayOff[4].status);
                  } else if (
                    date.getDay() === 5
                  ) {
                    let fStatus = statusD == true;

                    return getResult(string2,dayOff[5].status);
                  } else if (
                    date.getDay() === 6
                  ) {
                    let fStatus = statusD == true;

                    return getResult(string2,dayOff[6].status);
                  } else if (
                    date.getDay() === 0
                  ) {
                    let fStatus = statusD == true;

                    return getResult(string2,dayOff[0].status);
                  } else {
                    return [false, "closed", "Closed"];
                  }
                },
              });
            } else {
              let dayOff = [];

              dataJson.map((x) => {
                if (x.no == "") {
                  dayOff.push({ id: x.id, status: true });
                } else {
                  dayOff.push({ id: x.id, status: false });
                }
              });

              $("#datepicker").remove();

              $("#datepickerInput").append(
                '<input class="form-control" type="text" value="" id="datepicker" readonly="readonly" placeholder="Select Date">'
              );

              if (dayOff.length != 0) {
                $("#datepicker").datepicker({
                  minDate: 0,
                  dateFormat: "yy-mm-dd",
                  onSelect: function (selected, evnt) {
                    updateAb(selected);
                  },
                  beforeShowDay: function (date) {
                    if (date.getDay() === 1 && dayOff[0].status === false) {
                      return [true, "", ""];
                    } else if (
                      date.getDay() === 2 &&
                      dayOff[1].status === false
                    ) {
                      return [true, "", ""];
                    } else if (
                      date.getDay() === 3 &&
                      dayOff[2].status === false
                    ) {
                      return [true, "", ""];
                    } else if (
                      date.getDay() === 4 &&
                      dayOff[3].status === false
                    ) {
                      return [true, "", ""];
                    } else if (
                      date.getDay() === 5 &&
                      dayOff[4].status === false
                    ) {
                      return [true, "", ""];
                    } else if (
                      date.getDay() === 6 &&
                      dayOff[5].status === false
                    ) {
                      return [true, "", ""];
                    } else if (
                      date.getDay() === 7 &&
                      dayOff[6].status === false
                    ) {
                      return [true, "", ""];
                    } else {
                      return [false, "closed", "Closed"];
                    }
                  },
                });
              } else {
                $("#datepicker").datepicker({
                  minDate: 0,
                  dateFormat: "yy-mm-dd",
                  onSelect: function (selected, evnt) {
                    updateAb(selected);
                  },
                  beforeShowDay: function (date) {
                    return [false, "closed", "Closed"];
                  },
                });
              }
            }
          })
          .catch((err) => {
            console.log(err);
          });
      };

      getResult = (date,statusActive) => {
        let checkDate = new Date(date).getDay();
  
        // console.log(date , checkDate, statusActive)
        
       if(statusActive != false){
        return [false, "", ""];
       }

        if(checkDate == 0){
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


        for (let i = 0; i < dateArry.length; i++) {
          if (dateArry[i] == date) {
            return [false, "", ""];
          }
        }

        for (let i = 0; i < dateStore.length; i++) {
          if (dateStore[i].date == date) {
            if (dateStore[i].booking == dateStore[i].maxBooking) {
              return [false, "", ""];
            } else {
              return [true, "", ""];
            }
          }
        }
        

        return [true, "", ""];
      };
    </script>
  </body>
</html>
