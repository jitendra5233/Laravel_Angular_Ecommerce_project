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
@endsection

@section('content')
<style>
    .form-check-input[type=checkbox] {
        border: 1px solid #00000061;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
          <h5 class="card-header">Agent Time Slotes</h5>
          <!-- Account -->
          {{-- <form action="/submit-user" method="post"> --}}
            @csrf
            <div class="card-body">
                <div class="row">
                    <div>
                        <div class="mb-3 col-md-12">
                            <label for="exampleFormControlSelect1" class="form-label">Agent</label>
                            <select onchange="getAgentTimeSlot(event.target.value)" id="role" name="role" class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                                <option value="0">Select Agent</option>
                                @foreach($allAgents as $row)
                                <option value="{{$row->id}}">{{$row->first_name}} {{$row->last_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="my-0">
          <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                    <h5>Monday</h5>
                </div>
                  <div class="mb-3 col-md-4">
                    <label for="firstName" class="form-label">Start</label>
                    <input class="form-control" type="time" value="" id="s1">
                  </div>
                  <div class="mb-3 col-md-4">
                    <label for="firstName" class="form-label">End</label>
                    <input class="form-control" type="time" value="" id="e1">
                  </div>
                  <div class="mb-3 col-md-4">
                    <label for="firstName" class="form-label">Total</label>
                    <input class="form-control" min="0" type="number" id="n1" name="no" value="" />
                  </div>
                  <div class="col-md-12">
                    <h5>Tuesday</h5>
                  </div>
                  <div class="mb-3 col-md-4">
                    <label for="firstName" class="form-label">Start</label>
                    <input class="form-control" type="time" value="" id="s2">
                  </div>
                  <div class="mb-3 col-md-4">
                    <label for="firstName" class="form-label">End</label>
                    <input class="form-control" type="time" value="" id="e2">
                  </div>
                  <div class="mb-3 col-md-4">
                    <label for="firstName" class="form-label">Total</label>
                    <input class="form-control" min="0" type="number" id="n2" name="no" value="" />
                  </div>
                  <div class="col-md-12">
                    <h5>Wednesday</h5>
                  </div>
                  <div class="mb-3 col-md-4">
                    <label for="firstName" class="form-label">Start</label>
                    <input class="form-control" type="time" value="" id="s3">
                  </div>
                  <div class="mb-3 col-md-4">
                    <label for="firstName" class="form-label">End</label>
                    <input class="form-control" type="time" value="" id="e3">
                  </div>
                  <div class="mb-3 col-md-4">
                    <label for="firstName" class="form-label">Total</label>
                    <input class="form-control" min="0" type="number" id="n3" name="no" value="" />
                  </div>
                  <div class="col-md-12">
                    <h5>Thursday</h5>
                  </div>
                  <div class="mb-3 col-md-4">
                    <label for="firstName" class="form-label">Start</label>
                    <input class="form-control" type="time" value="" id="s4">
                  </div>
                  <div class="mb-3 col-md-4">
                    <label for="firstName" class="form-label">End</label>
                    <input class="form-control" type="time" value="" id="e4">
                  </div>
                  <div class="mb-3 col-md-4">
                    <label for="firstName" class="form-label">Total</label>
                    <input class="form-control" min="0" type="number" id="n4" name="no" value="" />
                  </div>
                  <div class="col-md-12">
                    <h5>Friday</h5>
                  </div>
                  <div class="mb-3 col-md-4">
                    <label for="firstName" class="form-label">Start</label>
                    <input class="form-control" type="time" value="" id="s5">
                  </div>
                  <div class="mb-3 col-md-4">
                    <label for="firstName" class="form-label">End</label>
                    <input class="form-control" type="time" value="" id="e5">
                  </div>
                  <div class="mb-3 col-md-4">
                    <label for="firstName" class="form-label">Total</label>
                    <input class="form-control" min="0" type="number" id="n5" name="no" value="" />
                  </div>
                  <div class="col-md-12">
                    <h5>Saturday</h5>
                  </div>
                  <div class="mb-3 col-md-4">
                    <label for="firstName" class="form-label">Start</label>
                    <input class="form-control" type="time" value="" id="s6">
                  </div>
                  <div class="mb-3 col-md-4">
                    <label for="firstName" class="form-label">End</label>
                    <input class="form-control" type="time" value="" id="e6">
                  </div>
                  <div class="mb-3 col-md-4">
                    <label for="firstName" class="form-label">Total</label>
                    <input class="form-control" min="0" type="number" id="n6" name="no" value="" />
                  </div>
                  <div class="col-md-12">
                    <h5>Sunday</h5>
                  </div>
                  <div class="mb-3 col-md-4">
                    <label for="firstName" class="form-label">Start</label>
                    <input class="form-control" type="time" value="" id="s7">
                  </div>
                  <div class="mb-3 col-md-4">
                    <label for="firstName" class="form-label">End</label>
                    <input class="form-control" type="time" value="" id="e7">
                  </div>
                  <div class="mb-3 col-md-4">
                    <label for="firstName" class="form-label">Total</label>
                    <input class="form-control" min="0" type="number" id="n7" name="no" value="" />
                  </div>
              </div>
          </div>
          <hr class="my-0">
          <div class="card-body">
            <div class="row">
                <div class="mt-4">
                <button type="submit" class="btn btn-primary me-2" onclick="handleSubmit()">Save changes</button>
                <button type="reset" class="btn btn-outline-secondary">Discard</button>
                </div>
            </div>
        </div>
        <!-- /Notifications -->
      </div>
  </div>
{{-- </form> --}}
  <!-- /Account -->
        </div>
      </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.1.3/axios.js"></script>
<script>

  let selectedUserId = 0;

    getAgentTimeSlot = (id) => {
        selectedUserId = id;
        let data = new FormData;
        data.append('id',id)
        axios.post('./getAgentTimeSlot',data).then((result) => {
          if(result.data != 0){
            let allData = result.data[0];
            let jsonData = JSON.parse(allData.dataJson);
            
            jsonData.map(x => {
              document.getElementById(`s${x.id}`).value = x.start;
              document.getElementById(`e${x.id}`).value = x.end;
              document.getElementById(`n${x.id}`).value = x.no;
            })
          }else{
            for(let i = 1; i<=7; i++){
              document.getElementById(`s${i}`).value = '';
              document.getElementById(`e${i}`).value = '';
              document.getElementById(`n${i}`).value = '';
            }
          }

        }).catch((err) => {
            console.log(err)
        });
    }

    handleSubmit = () =>{
      let s1 = document.getElementById('s1').value;
      let e1 = document.getElementById('e1').value;
      let n1 = document.getElementById('n1').value;

      let s2 = document.getElementById('s2').value;
      let e2 = document.getElementById('e2').value;
      let n2 = document.getElementById('n2').value;
      
      let s3 = document.getElementById('s3').value;
      let e3 = document.getElementById('e3').value;
      let n3 = document.getElementById('n3').value;

      let s4 = document.getElementById('s4').value;
      let e4 = document.getElementById('e4').value;
      let n4 = document.getElementById('n4').value;

      let s5 = document.getElementById('s5').value;
      let e5 = document.getElementById('e5').value;
      let n5 = document.getElementById('n5').value;

      let s6 = document.getElementById('s6').value;
      let e6 = document.getElementById('e6').value;
      let n6 = document.getElementById('n6').value;

      let s7 = document.getElementById('s7').value;
      let e7 = document.getElementById('e7').value;
      let n7 = document.getElementById('n7').value;

      let TimeObj = [
        {
          id:1,
          start:s1,
          end:e1,
          no:n1
        },
        {
          id:2,
          start:s2,
          end:e2,
          no:n2
        },
        {
          id:3,
          start:s3,
          end:e3,
          no:n3
        },
        {
          id:4,
          start:s4,
          end:e4,
          no:n4
        },
        {
          id:5,
          start:s5,
          end:e5,
          no:n5
        },
        {
          id:6,
          start:s6,
          end:e6,
          no:n6
        },
        {
          id:7,
          start:s7,
          end:e7,
          no:n7
        },
      ]

      let data = new FormData;
      data.append('TimeObj',JSON.stringify(TimeObj));
      data.append('id',selectedUserId)

      axios.post('{{ENV("APP_URL")}}/submit-agentTimeSlot',data).then((result) => {
        console.log(result.data)
      }).catch((err) => {
        console.log(err)
      });

    }
</script>

@endsection

