@extends('layouts.master')
@section('page_title', 'Manage Subjects')
@section('content')

    <div id="subjects" class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">Manage Subjects</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="nav-item"><a href="#new-subject" class="nav-link active" data-toggle="tab">Add Subject</a></li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Manage Subjects</a>
                    <div class="dropdown-menu dropdown-menu-right">
                        @foreach($my_classes as $c)
                            <a href="#c{{ $c->id }}" class="dropdown-item" data-toggle="tab">{{ $c->name }}</a>
                        @endforeach
                    </div>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane show  active fade" id="new-subject">
                    <div class="row">
                        <div class="col-md-6">
                            <form class="ajax-store" method="post" action="{{ route('subjects.store') }}">
                                @csrf
                                <div class="form-group row">
                                    <label for="name" class="col-lg-3 col-form-label font-weight-semibold">Name <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <select @change="getTeachers($event)" required data-placeholder="Select Subject" class="form-control">
                                            <option value=""></option>
                                            @foreach($sysSubjects as $subject)
                                                <option {{ old('name') == $subject->id ? 'selected' : '' }} value="{{ $subject->id }}">{{ $subject->name }}</option>
                                            @endforeach
                                        </select>
                                        <input id="name" name="name" v-model="subjects" value="{{ old('name') }}" required type="hidden" class="form-control" placeholder="Name of subject">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="slug" class="col-lg-3 col-form-label font-weight-semibold">Short Name <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input id="slug" required name="slug" value="{{ old('slug') }}" type="text" class="form-control" placeholder="Eg. B.Eng">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="time" class="col-lg-3 col-form-label font-weight-semibold"> Select Time <span class="text-danger">*</span></label>
                                    <div class="col-lg-4">
                                        <input id="time" required name="time_from" value="{{ old('time_form') }}" type="time" class="form-control" placeholder="Eg. B.Eng">
                                    </div>
                                    <div class="col-lg-1">
                                        <h5>to</h5>
                                    </div>
                                    <div class="col-lg-4">
                                        <input id="time" required name="time_to" value="{{ old('time_to') }}" type="time" class="form-control" placeholder="Eg. B.Eng">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="marks" class="col-lg-3 col-form-label font-weight-semibold"> Marks <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input id="marks" required name="marks" value="{{ old('marks') }}" type="number" class="form-control" placeholder="Eg. 100">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="days" class="col-lg-3 col-form-label font-weight-semibold">Select Days <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <select required data-placeholder="Select Days" class="form-control select" multiple name="days[]" id="days">
                                            <option value="Moday">Monday</option>
                                            <option value="Tuesday">Tuesday</option>
                                            <option value="Wednesday">Wednesday</option>
                                            <option value="Thursday">Thursday</option>
                                            <option value="Friday">Friday</option>
                                            <option value="Saturday">Saturday</option>
                                            <option value="Sunday">Sunday</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="my_class_id" class="col-lg-3 col-form-label font-weight-semibold">Select Class <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <select required data-placeholder="Select Class" class="form-control select" name="my_class_id" id="my_class_id">
                                            <option value=""></option>
                                            @foreach($my_classes as $c)
                                                <option {{ old('my_class_id') == $c->id ? 'selected' : '' }} value="{{ $c->id }}">{{ $c->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="teacher_id" class="col-lg-3 col-form-label font-weight-semibold">Teacher <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <select required data-placeholder="Select Teacher" class="form-control select-search"  name="teacher_id" id="teacher_id">
                                            <option disabled value="">Select a Teacher</option>
                                            {{-- <template v-for="(t,index) in teachers" :key="index"> --}}

                                                <option v-for="(t,index) in teachers" :key="index" :value="t.id">@{{ t.name }}</option>
                                            {{-- </template> --}}
                                        </select>
                                    </div>
                                </div>

                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Submit form <i class="icon-paperplane ml-2"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                @foreach($my_classes as $c)
                    <div class="tab-pane fade" id="c{{ $c->id }}">
                        <table class="table datatable-button-html5-columns">
                            <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Name</th>
                                <th>Short Name</th>
                                <th>Class</th>
                                <th>Days</th>
                                <th>Time From</th>
                                <th>Time To</th>
                                <th>Marks</th>
                                <th>Teacher</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if (count($subjects) > 0)
                            @foreach($subjects->where('my_class.id', $c->id) as $s)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $s->name }} </td>
                                    <td>{{ $s->slug }} </td>
                                    <td>{{ $s->my_class->name }}</td>
                                    {{-- <td>
                                        @php
                                            $days = json_decode($s->days);
                                            dd($days[0]);
                                        @endphp
                                        @for ($i=0; $i<=count($days); $i++)
                                            {{ $days[$i] }}
                                        @endfor
                                    </td> --}}
                                    <td>{{ $s->time_from }} </td>
                                    <td>{{ $s->time_to }} </td>
                                    <td>{{ $s->marks }} </td>
                                    <td>{{ $s->teacher->name }}</td>
                                    <td class="text-center">
                                        <div class="list-icons">
                                            <div class="dropdown">
                                                <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                    <i class="icon-menu9"></i>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-left">
                                                    {{--edit--}}
                                                    @if(Qs::userIsTeamSA() || Qs::userIsSubjTeam())
                                                        <a href="{{ route('subjects.edit', $s->id) }}" class="dropdown-item"><i class="icon-pencil"></i> Edit</a>
                                                    @endif
                                                    {{--Delete--}}
                                                    @if(Qs::userIsSuperAdmin() || Qs::userIsSubjTeam())
                                                        <a id="{{ $s->id }}" onclick="confirmDelete(this.id)" href="#" class="dropdown-item"><i class="icon-trash"></i> Delete</a>
                                                        <form method="post" id="item-delete-{{ $s->id }}" action="{{ route('subjects.destroy', $s->id) }}" class="hidden">@csrf @method('delete')</form>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                @endforeach

            </div>
        </div>

    </div>


    {{--subject List Ends--}}
    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        new Vue({
            el: '#subjects',
            data() {
                return {
                    teachers:[],
                    subjects:null,
                    teacher:null,
                }
            },
            methods:{
                getTeachers(e){
                    let input = {}
                    let subs = {!! $sysSubjects !!}
                    input.input = e.target.value
                    if (input.input){
                        axios.post('{{ route('teachers.get') }}',input)
                        .then( response => {
                            this.teachers = response.data.teachers
                            for (let index = 0; index < subs.length; index++) {
                                if(subs[index].id == e.target.value){
                                    // Vue.set(e.target.value," ",subs[index].name)
                                    this.subjects = subs[index].name
                                    console.log(this.subjects);
                                }
                            }

                        })
                    }
                },
            }
        })

    </script>
@endsection
