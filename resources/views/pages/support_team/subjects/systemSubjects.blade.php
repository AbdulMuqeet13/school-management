@extends('layouts.master')
@section('page_title', 'System Subjects')
@section('content')

    <div id="subjects" class="card">
        <div class="card-header">
            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModalCenter">
                Add new Subject
              </button>
        </div>
        <div class="card-body">
            <table class="table datatable-button-html5-columns">
                <thead>
                <tr>
                    <th>S/N</th>
                    <th>Name</th>
                    <th>Short Name</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($subjects as $s)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $s->name }} </td>
                        <td>{{ $s->slug }} </td>
                        <td class="text-center">
                            <div class="list-icons">
                                <div class="dropdown">
                                    <a href="#" class="list-icons-item" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-left">
                                        {{--edit--}}
                                        @if(Qs::userIsTeamSA())
                                            <a href="{{ route('subjects.edit', $s->id) }}" class="dropdown-item"><i class="icon-pencil"></i> Edit</a>
                                        @endif
                                        {{--Delete--}}
                                        @if(Qs::userIsSuperAdmin())
                                            <a id="{{ $s->id }}" onclick="confirmDelete(this.id)" href="#" class="dropdown-item"><i class="icon-trash"></i> Delete</a>
                                            <form method="post" id="item-delete-{{ $s->id }}" action="{{ route('subjects.destroy', $s->id) }}" class="hidden">@csrf @method('delete')</form>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="name" class="col-lg-3 col-form-label font-weight-semibold">Name <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input id="name" v-model="name" name="name" value="{{ old('name') }}" required type="text" class="form-control" placeholder="Name of subject">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="short-name" class="col-lg-3 col-form-label font-weight-semibold">Short Name <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input id="short-name" v-model="shortName" value="{{ old('name') }}" required type="text" class="form-control" placeholder="Short name of subject">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button @click="saveSubject" type="button" class="btn btn-primary">Save Subject</button>
                </div>
              </div>
            </div>
          </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        new Vue({
            el:"#subjects",
            data() {
                return {
                    name: '',
                    shortName: '',
                }
            },
            methods:{
                saveSubject(){
                    let data = {}
                    data.name = this.name
                    data.short_name = this.shortName
                    console.log(data)
                    axios.post('{{route("subjects.system.save")}}',data)
                        .then( res => {
                            swal('Saved Subject Successfully')
                            setTimeout(function(){
                                window.location.reload();
                            }, 2000);
                        })
                        .catch(err=>{
                            swal(err.data.message)
                        })
                }
            }
        })
    </script>
@endsection
