@extends('layouts.master')
@section('page_title', 'My Dashboard')
@section('content')

    @if(Qs::userIsSubjTeam())
       <div class="row" id="links">
        {{-- <form method="post" @submit.prevent(generateLink) enctype="multipart/form-data" class="wizard-form steps-validation ajax-store" data-fouc>
            @csrf
            <h6>Generate Link</h6> --}}
            {{-- <fieldset> --}}
                <div class="row p-3 col-md-12">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="user_type"> Select User: <span class="text-danger">*</span></label>
                            <select ref="type" required data-placeholder="Select User" class="form-control select" id="user_type">
                                @foreach($user_types as $ut)
                                    @if ($ut->title != 'super_admin' && $ut->title != 'student')
                                        <option value="{{ $ut->id }}">{{ $ut->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="school"> Select School: <span class="text-danger">*</span></label>
                            @if (Qs::userIsTeamSA())
                                <select ref="school" required  data-placeholder="Select User" class="form-control select" id="school">
                                    <option value="">Select School</option>
                                    @foreach($schools as $school)
                                        <option value="{{ $school->id }}">{{ $school->name }}</option>
                                    @endforeach
                                </select>
                            @else
                                <select ref="school" required  data-placeholder="Select User" class="form-control select" id="school">
                                    <option value="{{ $schools->id }}">{{ $schools->name }}</option>
                                </select>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12 row">
                        <div v-if="link" class="col-md-6">
                            <input readonly :value="link" type="text" class="form-control bg-success text-white">
                        </div>
                        <div class="form-group ml-auto">
                            <button @click="generateLink" class="btn btn-primary">Generate Link</button>
                        </div>
                    </div>
            {{-- </fieldset>
        </form> --}}
       </div>
       @endif

    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        new Vue({
            el:'#links',
            data(){
                return {
                    link:null,
                }
            },
            methods:{
                generateLink(){
                    this.link = "{{ url('/') }}" + '/register-by-url/' + this.$refs.type.value+"/"+this.$refs.school.value
                },
            },
        });
    </script>
    @endsection
