@extends('layouts.login_master')
    @include('partials.inc_top')

@section('content')

<div class="page-content">
    <div class="content-wrapper">
        <div class="content">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title font-weight-bold text-center"> Register Yourself </h1>
                </div>
                <div class="card-body">
                    <div class="fade show active" >
                        <form method="post" enctype="multipart/form-data" class=" steps-validation ajax-store" action="{{ route('user.saveByURL') }}" data-fouc>
                            @csrf
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="user_type"> User Type: <span class="text-danger">*</span></label>
                                            <input id="user_type" value="{{ Qs::hash($user_type->id) }}" required type="hidden" name="user_type" class="form-control">
                                            <input  value="{{ $school ? $school->id : '' }}" required type="hidden" name="school_id" class="form-control">
                                            <input  value="{{ $user_type->name }}" readonly required type="text" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Full Name: <span class="text-danger">*</span></label>
                                            <input value="{{ old('name') }}" required type="text" name="name" placeholder="Full Name" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Address: <span class="text-danger">*</span></label>
                                            <input value="{{ old('address') }}" class="form-control" placeholder="Address" name="address" type="text" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Email address: </label>
                                            <input value="{{ old('email') }}" type="email" name="email" class="form-control" placeholder="your@email.com">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Username: </label>
                                            <input value="{{ old('username') }}" type="text" name="username" class="form-control" placeholder="Username">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Phone:</label>
                                            <input value="{{ old('phone') }}" type="text" name="phone" class="form-control" placeholder="+2341234567" >
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Telephone:</label>
                                            <input value="{{ old('phone2') }}" type="text" name="phone2" class="form-control" placeholder="+2341234567" >
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Date of Employment:</label>
                                            <input autocomplete="off" name="emp_date" value="{{ old('emp_date') }}" type="text" class="form-control date-pick" placeholder="Select Date...">

                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="password">Password: </label>
                                            <input id="password" required type="password" name="password" class="form-control"  >
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="gender">Gender: <span class="text-danger">*</span></label>
                                            <select class="select form-control" id="gender" name="gender" required data-fouc data-placeholder="Choose..">
                                                <option value=""></option>
                                                <option {{ (old('gender') == 'Male') ? 'selected' : '' }} value="Male">Male</option>
                                                <option {{ (old('gender') == 'Female') ? 'selected' : '' }} value="Female">Female</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="nal_id">Nationality: <span class="text-danger">*</span></label>
                                            <select data-placeholder="Choose..." required name="nal_id" id="nal_id" class="select-search form-control">
                                                <option value=""></option>
                                                @foreach($nationals as $nal)
                                                    <option {{ (old('nal_id') == $nal->id ? 'selected' : '') }} value="{{ $nal->id }}">{{ $nal->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    {{--State--}}
                                    <div class="col-md-4">
                                        <label for="state_id">State: <span class="text-danger">*</span></label>
                                        <select onchange="getLGA(this.value)" required data-placeholder="Choose.." class="select-search form-control" name="state_id" id="state_id">
                                            <option value=""></option>
                                            @foreach($states as $st)
                                                <option {{ (old('state_id') == $st->id ? 'selected' : '') }} value="{{ $st->id }}">{{ $st->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{--LGA--}}
                                    <div class="col-md-4">
                                        <label for="lga_id">LGA: <span class="text-danger">*</span></label>
                                        <select required data-placeholder="Select State First" class="select-search form-control" name="lga_id" id="lga_id">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                    {{--BLOOD GROUP--}}
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="bg_id">Blood Group: </label>
                                            <select class="select form-control" id="bg_id" name="bg_id" data-fouc data-placeholder="Choose..">
                                                <option value=""></option>
                                                @foreach($blood_groups as $bg)
                                                    <option {{ (old('bg_id') == $bg->id ? 'selected' : '') }} value="{{ $bg->id }}">{{ $bg->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    {{--PASSPORT--}}
                                    @if ($subjects)
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="subject_id">Select Subject: </label>
                                                <select class="select form-control" id="subject_id" name="subject" data-fouc data-placeholder="Choose..">
                                                    <option value=""></option>
                                                    @foreach($subjects as $subject)
                                                        <option {{ (old('subject_id') == $subject->id ? 'selected' : '') }} value="{{ $subject->id }}">{{ $subject->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="d-block">Upload Passport Photo:</label>
                                            <input value="{{ old('photo') }}" accept="image/*" type="file" name="photo" class="form-input-styled" data-fouc>
                                            <span class="form-text text-muted">Accepted Images: jpeg, png. Max file size 2Mb</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <button type="submit" class="btn-primary btn ml-auto col-1">Regiter</button>
                                </div>
                            </fieldset>



                        </form>
                    </div>
                </div>

            </div>
        </div>
</div>
</div>
@endsection
