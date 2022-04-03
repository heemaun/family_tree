@extends('inc')
@section('content')
    <table class="table table-striped table-bordered table-dark">
        <thead>
            <th>Name</th>
            <th>Gender</th>
            <th>Father</th>
            <th>Mother</th>
            <th>Spouse</th>
        </thead>
        @foreach ($persons as $person)
        <tr>
            <td>{{$person->name}}</td>
            <td>{{$person->gender}}</td>
            <td>{{($person->father)?$person->father->name:'N/A'}}</td>
            <td>{{($person->mother)?$person->mother->name:'N/A'}}</td>
            <td>
                @if (strcmp($person->gender,'Male')==0)
                    @foreach ($person->wife as $wife)
                    {{$wife->name}}
                    @endforeach
                @else
                    @foreach ($person->husband as $husband)
                    {{$husband->name}}
                    @endforeach
                @endif

            </td>
        </tr>
        @endforeach
    </table>
    <a href="{{route('person.create')}}" class="btn btn-primary">Add Person</a>
@endsection
