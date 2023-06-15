@extends('layouts/contentNavbarLayout')

@section('title', 'Account settings - Account')

@section('page-script')
<script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>
@endsection

<link rel="stylesheet" href="{{asset('assets/richtexteditor/rte_theme_default.css')}}" />
<script type="text/javascript" src="{{asset('assets/richtexteditor/rte.js')}}"></script>
<script type="text/javascript" src='{{asset('assets/richtexteditor/plugins/all_plugins.js')}}'></script>
<script type="text/javascript" src='{{asset('assets/richtexteditor/rte-upload.js')}}'></script>


@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">New Hill /</span> View Property
</h4>

<div class="row">
    <div class="card mb-4">
      <h5 class="card-header">Property Details</h5>
      <!-- Account -->
      <div class="card-body">
        <form action="/submit-add-property" method="post">
            @csrf
          <div class="row">
            <div class="mb-3 col-md-6">
              <label for="firstName" class="form-label">Name</label>
              <input class="form-control" type="text" id="name" name="name" placeholder="Name" value="{{$propertyDetail->name}}"  />
            </div>
            <div class="mb-3 col-md-6">
              <label for="agent" class="form-label">Agent</label>
              <select id="country" name="agent" class="select2 form-select">
                <option value="0">Select</option>
                @foreach($agents as $row)
                <option value="{{$row->id}}" <?php echo $propertyDetail->userId == $row->id ? 'selected' : '' ?> >{{$row->first_name}}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3 col-md-6">
                <label for="project" class="form-label">Project</label>
                <select id="country" name="project" class="select2 form-select">
                  <option value="">Select</option>
                  @foreach($project as $row)
                  <option value="{{$row->id}}" <?php echo $propertyDetail->typeId == $row->id ? 'selected' : '' ?> >{{$row->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="mb-3 col-md-6">
                <label for="subproject" class="form-label">Sub project</label>
                <select id="subproject" name="subproject" class="select2 form-select">
                  <option value="">Select</option>
                  @foreach($subProject as $row)
                  <option value="{{$row->id}}" <?php echo $propertyDetail->categoryId == $row->id ? 'selected' : '' ?> >{{$row->name}}</option>
                  @endforeach
                </select>
              </div>
            <div class="mb-3 col-md-6">
              <label for="address" class="form-label">Address</label>
              <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="{{$propertyDetail->address}}" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="state" class="form-label">State</label>
              <input class="form-control" type="text" id="state" name="state" placeholder="California" value="{{$propertyDetail->state}}" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="zipCode" class="form-label">Zip Code</label>
              <input type="text" class="form-control" id="zipCode" name="zipCode" placeholder="231465" maxlength="6" value="{{$propertyDetail->city}}" />
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label" for="country">Country</label>
              <select id="country" name="country" class="select2 form-select">
                <option value="">Select</option>
                <option value="Australia">Australia</option>
                <option value="Bangladesh">Bangladesh</option>
                <option value="Belarus">Belarus</option>
                <option value="Brazil">Brazil</option>
                <option value="Canada">Canada</option>
                <option value="China">China</option>
                <option value="France">France</option>
                <option value="Germany">Germany</option>
                <option value="India">India</option>
                <option value="Indonesia">Indonesia</option>
                <option value="Israel">Israel</option>
                <option value="Italy">Italy</option>
                <option value="Japan">Japan</option>
                <option value="Korea">Korea, Republic of</option>
                <option value="Mexico">Mexico</option>
                <option value="Philippines">Philippines</option>
                <option value="Russia">Russian Federation</option>
                <option value="South Africa">South Africa</option>
                <option value="Thailand">Thailand</option>
                <option value="Turkey">Turkey</option>
                <option value="Ukraine">Ukraine</option>
                <option value="United Arab Emirates">United Arab Emirates</option>
                <option value="United Kingdom">United Kingdom</option>
                <option value="United States">United States</option>
              </select>
            </div>
            <div class="mb-3 col-md-6">
                <label for="price" class="form-label">Price</label>
                <input type="text" class="form-control" id="price" name="price" placeholder="" maxlength="6" value="{{$propertyDetail->price}}" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="size" class="form-label">Size</label>
              <input type="text" class="form-control" id="size" name="size" placeholder="" maxlength="6" value="{{$propertyDetail->sizeSqFt}}" />
            </div>
            <div class="mb-3 col-md-6">
                <label for="bedroom" class="form-label">Bedroom</label>
                <input type="text" class="form-control" id="bedroom" name="beadroom" placeholder="" maxlength="6" value="{{$propertyDetail->bedroom}}" />
            </div>
            <div class="mb-3 col-md-6">
                <label for="bathroom" class="form-label">Bathroom</label>
                <input type="text" class="form-control" id="bathroom" name="bathroom" placeholder="" maxlength="6" value="{{$propertyDetail->bathroom}}" />
            </div>
            <div class="mb-3 col-md-6">
                <label for="status" class="form-label">Status</label>
                <select id="status" name="status" class="select2 form-select">
                  <option value="">Select</option>
                  <option value="Australia">Avaliable</option>
                  <option value="Australia">Now Avaliable</option>
                  <option value="Australia">On Hold</option>
                </select>
            </div>
            <div class="mb-3 col-md-6">
              <label for="features" class="form-label">Features</label>
              <select id="features" name="features" class="select2 form-select">
                <option value="">Select</option>
                <option value="Australia">Near School</option>
                <option value="Australia">Near Hospital</option>
                <option value="Australia">Near Park</option>
              </select>
            </div>
          <div class="mb-3 col-md-12">
            <label for="description" class="form-label">Description</label>
            <input name="description" id="inp_htmlcode" type="hidden" value="{{$propertyDetail->description}}"  />
            <div id="div_editor1" class="richtexteditor"></div>
          </div>
          <div class="mt-2">
            <button type="submit" class="btn btn-primary me-2">Save changes</button>
            <button type="reset" class="btn btn-outline-secondary">Cancel</button>
          </div>
        </form>
      </div>
      <!-- /Account -->
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.1.slim.min.js" integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA=" crossorigin="anonymous"></script>

<script>
    var editor1 = new RichTextEditor(document.getElementById("div_editor1"));

    editor1.attachEvent("change", function () {
        document.getElementById("inp_htmlcode").value = editor1.getHTMLCode();
    });

    $(document).ready(function() {
        let oldhtml = document.getElementById('inp_htmlcode').value
        editor1.insertHTML(oldhtml)
    });
</script>
@endsection
