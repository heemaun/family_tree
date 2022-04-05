@extends('inc')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-11">
        <label>Name</label>
        <label class="float-end">{{$person->name}}</label>
        <hr>
    </div>
    <div class="col-md-11">
        <label>Gender</label>
        <label class="float-end">{{$person->gender}}</label>
        <hr>
    </div>
    <div class="col-md-11">
        <label>Father</label>
        <label class="float-end">{{($person->father)?$person->father->name:'N/A'}}</label>
        <hr>
    </div>
    <div class="col-md-11">
        <label>Mother</label>
        <label class="float-end">{{($person->mother)?$person->mother->name:'N/A'}}</label>
        <hr>
    </div>
    <div class="col-md-11">
        <label>Spouse(s)</label>
        <label class="float-end">
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
        </label>
        <hr>
    </div>
</div>
<a href="{{route('person.index')}}" class="btn btn-primary">Back</a>
<a href="{{route('person.edit',$person->id)}}" class="btn btn-success">Edit</a>
<a href="{{route('tree.view',$person->id)}}" class="btn btn-info">Tree View</a>
<form action="{{route('person.destroy',$person->id)}}" method="POST" class="float-end">
    @csrf
    @method("DELETE")
    <button type="submit" class="btn btn-danger">Delete</button>
</form>
@endsection
