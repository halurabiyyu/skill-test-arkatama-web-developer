@extends('layout.app')
@section('content')

<div class="container-fluid bg-body-tertiary px-4">
    <div>
        <h1 class="text-bold">Dashboard</h1>
        <p>Welcome Back!</p>
    </div>
    @if (session('error'))
        <div class="alert alert-warning">
            <p>{{session('error')}}</p>
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success">
            <p>{{session('success')}}</p>
        </div>
    @endif
    <div class="">
        <div>
            <p class="fw-bold">Quick Stats</p>
        </div>
        <div class="d-flex flex-row gap-2 mb-2">
            <div class="shadow-sm bg-white rounded p-3 container-lg">
                <p>Total Bookings</p>
                <h1>100</h1>
            </div>
            <div class="shadow-sm bg-white rounded p-3 container-lg">
                <p>Pending Approval</p>
                <h1 class="text-danger">100</h1>
            </div>
            <div class="shadow-sm bg-white rounded p-3 container-lg">
                <p>New Clients this month</p>
                <h1>100</h1>
            </div>
            <div class="shadow-sm bg-white rounded p-3 container-lg">
                <p>Returning Clients</p>
                <h1>100</h1>
            </div>
        </div>
    </div>
    <div class="d-flex flex-row gap-2 border-bottom mb-3">
        <div>
            <a class="fs-4 text-black fw-bold link-offset-2 link-underline link-underline-opacity-0" href="">Bookings</a>
        </div>
        <div>
            <a class="fs-4 text-black fw-bold link-offset-2 link-underline link-underline-opacity-0" href="">My Service</a>
        </div>
    </div>
    <div class="">
        <div class="d-flex flex-wrap justify-content-between">
            <div class="d-flex flex-column gap-1">
                <p class="fs-4 fw-medium mb-0">Booking Client</p>
                <p class="fs-6 text-secondary mt-0">List of all bookings</p>
            </div>
            <div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">+ Add Passanger</button>
            </div>
        </div>
        <div class="d-flex flex-wrap row-gap-3 gap-2 mb-3 py-2">
            @foreach ($passengers as $passenger)      
                <div class="bg-white rounded shadow-sm p-2">
                    <h3 class="mx-2">{{$passenger->nama}}</h3>
                    <small class="mx-2">Service</small>
                    <p class="mx-2">Trip to {{$passenger->kota}}</p>
                    <div class="d-flex justify-content-between mx-2">
                        <div>
                            <small>Date</small>
                            <p class="mb-0">25 Jul 2020</p>
                        </div>
                        <div>
                            <small>Time</small>
                            <p class="mb-0">11:00 - 12:00</p>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mx-2">
                        <div>
                            <p class="text-primary-emphasis">Close Booking</p>
                        </div>
                        <div>
                            <p class="text-secondary">Reject</p>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="bg-white rounded shadow-sm p-2">
                    <h3 class="mx-2">Amanda Chavez</h3>
                    <small class="mx-2">Service</small>
                    <p class="mx-2">Trip to Malang</p>
                    <div class="d-flex justify-content-between mx-2">
                        <div>
                            <small>Date</small>
                            <p class="mb-0">25 Jul 2020</p>
                        </div>
                        <div>
                            <small>Time</small>
                            <p class="mb-0">11:00 - 12:00</p>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mx-2">
                        <div>
                            <p class="text-primary-emphasis">Close Booking</p>
                        </div>
                        <div>
                            <p class="text-secondary">Reject</p>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Passanger</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route("passengers.store")}}" method="POST">
                    @csrf
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Passenger*</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="data_penumpang" placeholder="Name Age City">
                      <small class="text-secondary">Contoh: Halur 20 Malang</small>
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputPassword1" class="form-label">Travel Services*</label>
                      <select class="form-select" aria-label="Default select example" name="kode_booking">
                        <option selected>Choose Services</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                      </select>
                    </div>
                    <div class="mb-3 ">
                        <label class="form-label" for="exampleCheck1">Pickup Location</label>
                        <input type="text" class="form-control" id="pickup_location" name="pickup_location" placeholder="Pickup Location" aria-describedby="">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="exampleCheck1">Whatsapp Number</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">+62</span>
                            <input type="number" class="form-control" placeholder="number" name="no_telp" aria-label="no_telp" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="d-flex justify-content-end gap-1">
                        <button type="button" class="btn btn-outline-secondary">Cancel</button>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
          </div>
        </div>
    </div>

    {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Launch demo modal
    </button> --}}
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p class="text-center fw-bold fs-3">Data Added Successfully</p>
          <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate impedit quisquam beatae nesciunt officiis blanditiis rerum optio distinctio animi ab esse omnis vero sequi, quaerat accusantium aliquam illum odio? Mollitia.</p>
        </div>
        <div class="modal-footer d-flex justify-content-center">
          <button type="button" class="btn btn-primary">OK</button>
        </div>
      </div>
    </div>
  </div>
</div>