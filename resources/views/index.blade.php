@extends('inc')
@section('content')
<table class="table table-striped table-bordered table-dark">
    <thead class="text-center">
        <th>Name</th>
        <th>Gender</th>
        <th>Father</th>
        <th>Mother</th>
        <th>Spouse</th>
    </thead>
    <tbody class="clickable-row">
        @foreach ($persons as $person)
        <tr class="clickable-row text-center" data-href="{{route('person.show',$person->id)}}">
            <td>{{$person->name}}</td>
            <td>{{$person->gender}}</td>
            <td>{{($person->father)?$person->father->name:'N/A'}}</td>
            <td>{{($person->mother)?$person->mother->name:'N/A'}}</td>
            <td>
                @if (strcmp($person->gender,'Male')==0)
                    @if (count($person->wife)==0)
                        {{'N/A'}}
                    @else
                        @foreach ($person->wife as $wife)
                        {{$wife->name}}
                        @endforeach
                    @endif
                @else
                    @if (count($person->husband)==0)
                        {{'N/A'}}
                    @else
                        @foreach ($person->husband as $husband)
                        {{$husband->name}}
                        @endforeach
                    @endif
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<a href="{{route('person.create')}}" class="btn btn-primary">Add Person</a>
@endsection
@push('scripts')
<script>
    $(document).ready(function(){
        $(".clickable-row").on("click","tr",function(){
            window.location = $(this).data("href");
        });
    });
</script>
@endpush
