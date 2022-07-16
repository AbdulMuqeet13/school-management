@extends('layouts.master')
@section('page_title', 'Timetable')
@section('content')
<style>
    td{
        vertical-align: initial !important;
    }
</style>
<div id="subjects" class="card">
    <div class="card-header header-elements-inline">
        <h6 class="card-title">TimeTable</h6>
        {{-- {!! Qs::getPanelOptions() !!} --}}
    </div>
    <div class="card-body">
        <table class="table datatable-button-html5-columns">
            <thead>
            <tr>
                <th>S/N</th>
                <th>Subject</th>
                <th>Time</th>
                <th>Days</th>
                <th>Class</th>
                <th>Teacher</th>
            </tr>
            </thead>
            <tbody>
            @foreach($subjects as $s)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $s->name }} </td>
                    <td>{{ $s->time }} </td>
                    <td>
                        @foreach (json_decode($s->days) as $day)
                            {{$day}} <br> <br>
                        @endforeach
                    </td>
                    <td>{{ $s->my_class->name }}</td>
                    <td>{{ $s->teacher->name }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
