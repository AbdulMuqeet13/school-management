@extends('layouts.master')
@section('page_title', 'Manage School')
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title font-weight-semibold">Create New School</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="nav-item"><a href="#all-classes" class="nav-link active" data-toggle="tab">Manage Schools</a></li>
                <li class="nav-item"><a href="#new-school" class="nav-link" data-toggle="tab"><i class="icon-plus2"></i> Create New School</a></li>
            </ul>

            <div class="tab-content">
                    <div class="tab-pane fade show active" id="all-classes">
                        <table class="table table-responsive datatable-button-html5-columns">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Motto</th>
                                <th>Address</th>
                                <th>State License Number</th>
                                <th>Tax ID</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Section</th>
                                <th>Category</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($schools as $shcool)
                                <tr>
                                    <td>{{ $shcool->name }}</td>
                                    <td>{{ $shcool->motto }}</td>
                                    <td>{{ $shcool->address }}</td>
                                    <td>{{ $shcool->state_license_number }}</td>
                                    <td>{{ $shcool->tax_id }}</td>
                                    <td>{{ $shcool->phone }}</td>
                                    <td>{{ $shcool->email }}</td>
                                    <td>{{ $shcool->section }}</td>
                                    <td>{{ $shcool->category }}</td>
                                    <td class="text-center">
                                        <div class="list-icons">
                                            <div class="dropdown">
                                                {{-- <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                    <i class="icon-menu9"></i>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-left">
                                                    @if(Qs::userIsTeamSA()) --}}
                                                    {{--Edit--}}
                                                    {{-- <a href="{{ route('classes.edit', $c->id) }}" class="dropdown-item"><i class="icon-pencil"></i> Edit</a>
                                                   @endif
                                                        @if(Qs::userIsSuperAdmin()) --}}
                                                    {{--Delete--}}
                                                    {{-- <a id="{{ $c->id }}" onclick="confirmDelete(this.id)" href="#" class="dropdown-item"><i class="icon-trash"></i> Delete</a> --}}
                                                    {{-- <form method="post" id="item-delete-{{ $c->id }}" action="{{ route('classes.destroy', $c->id) }}" class="hidden">@csrf @method('delete')</form>
                                                        @endif --}}

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                <div class="tab-pane fade" id="new-school">
                    <div class="row">
                        {{-- <div class="col-md-12">
                            <div class="alert alert-info border-0 alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>

                                <span>When a class is created, a Section will be automatically created for the class, you can edit it or add more sections to the class at <a target="_blank" href="{{ route('sections.index') }}">Manage Sections</a></span>
                            </div>
                        </div> --}}
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" enctype="multipart/form-data" class="wizard-form steps-validation ajax-store" action="{{ route('schools.store') }}" data-fouc>
                                @csrf
                                <h6>School Information</h6>
                                <fieldset>
                                    <div class="row">        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>School Name: <span class="text-danger">*</span></label>
                                                <input value="{{ old('name') }}" required type="text" name="name" placeholder="School Name" class="form-control">
                                            </div>
                                        </div>
        
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Address: <span class="text-danger">*</span></label>
                                                <input value="{{ old('address') }}" class="form-control" placeholder="Address" name="address" type="text" required>
                                            </div>
                                        </div>
                                    </div>
        
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Email address: <span class="text-danger">*</span></label>
                                                <input value="{{ old('email') }}" type="email" name="email" class="form-control" placeholder="your@email.com">
                                            </div>
                                        </div>
        
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Section: </label>
                                                <input value="{{ old('section') }}" type="text" name="section" class="form-control" placeholder="Section">
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
                                                <label>State License Number:</label>
                                                <input value="{{ old('state_license_number') }}" type="text" name="state_license_number" class="form-control" placeholder="State License Number" >
                                            </div>
                                        </div>        
                                    </div>
        
                                    <div class="row">
                                        {{--State--}}
                                        <div class="col-md-4">
                                            <label for="motto">Mtto:</label>
                                            <input value="{{ old('motto') }}" type="text" name="motto" class="form-control" placeholder="Motto" >
                                        </div>
                                        {{--LGA--}}
                                        <div class="col-md-4">
                                            <label for="tax_id">Tax ID: </label>
                                            <input value="{{ old('tax_id') }}" type="text" name="tax_id" class="form-control" placeholder="tax_id" >
                                        </div>
                                        {{--BLOOD GROUP--}}
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="category">Category: <span class="text-danger">*</span></label>
                                                <input value="{{ old('category') }}" type="text" name="category" class="form-control" placeholder="Category" >
                                            </div>
                                        </div>
        
                                    </div>
        
                                    <div class="row">
                                        {{--PASSPORT--}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="d-block">Upload School Logo:</label>
                                                <input value="{{ old('photo') }}" accept="image/*" type="file" name="photo" class="form-input-styled" data-fouc>
                                                <span class="form-text text-muted">Accepted Images: jpeg, png. Max file size 2Mb</span>
                                            </div>
                                        </div>
                                    </div>
        
                                </fieldset>
        
        
        
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--Settings Edit Ends--}}

@endsection
