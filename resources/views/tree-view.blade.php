@extends('inc')
@section('content')
<div class="row justify-content-centet">
    <div class="col-md-11">
        <h1><b>Name: </b>{{$self->name}}</h1>
        @if (count($self->wife)>0 || count($self->husband)>0)
        <h2><b>Spouse: </b>{{(strcmp($self->gender,'Male')==0)?$self->wife[0]->name:$self->husband[0]->name}}</h2>
        @endif
    </div>
</div>
<div class="row justify-content-center">
    @foreach ($patGrdPa as $key => $person)
    @if ($key != $patDepth)
    <div class="col-md-6">
        <table class="table table-bordered">
            <thead>
                <th>Name</th>
                <th>Relation</th>
                <th>Spouse</th>
                <th>Relation</th>
            </thead>
            <tbody>
                <tr>
                    <td>{{$person->name}}</td>
                    <td>
                        @if ($key==$patDepth)
                        {{'Self'}}
                        @elseif ($key==$patDepth-1)
                        {{'Father'}}
                        @elseif ($key==$patDepth-2)
                        {{'Grand Father'}}
                        @else
                        @for ($x=2;$x<$patDepth-$key;$x++)
                        {{'Great '}}
                        @endfor
                        {{'Grand Father'}}
                        @endif
                    </td>
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
                    <td>
                        @if ($key==$patDepth)
                        {{(strcmp($person->gender,'Female')==0)?'Husband':'Wife'}}
                        @elseif ($key==$patDepth-1)
                        {{'Mother'}}
                        @elseif ($key==$patDepth-2)
                        {{'Grand Mother'}}
                        @else
                        @for ($x=2;$x<$patDepth-$key;$x++)
                        {{'Great '}}
                        @endfor
                        {{'Grand Mother'}}
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    @endif
    @endforeach
</div>
<div class="row justify-content-center">
    @foreach ($matGrdPa as $key => $person)
    @if ($key != $matDepth)
    <div class="col-md-6">
        <table class="table table-bordered">
            <thead>
                <th>Name</th>
                <th>Relation</th>
                <th>Spouse</th>
                <th>Relation</th>
            </thead>
            <tbody>
                <tr>
                    <td>{{$person->name}}</td>
                    <td>
                        @if ($key==$matDepth)
                        {{'Self'}}
                        @elseif ($key==$matDepth-1)
                        {{'Mother'}}
                        @elseif ($key==$matDepth-2)
                        {{'Grand Father'}}
                        @else
                        @for ($x=2;$x<$matDepth-$key;$x++)
                        {{'Great '}}
                        @endfor
                        {{'Grand Father'}}
                        @endif
                    </td>
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
                    <td>
                        @if ($key==$matDepth)
                        {{'Wife'}}
                        @elseif ($key==$matDepth-1)
                        {{'Father'}}
                        @elseif ($key==$matDepth-2)
                        {{'Grand Mother'}}
                        @else
                        @for ($x=2;$x<$matDepth-$key;$x++)
                        {{'Great '}}
                        @endfor
                        {{'Grand Mother'}}
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    @endif

    @endforeach
</div>
<div class="row justify-content-center">
    <div class="col-md-6">
        <table class="table table-bordered">
            <thead>
                <th>Name</th>
                <th>Relation</th>
            </thead>
            <tbody>
                @foreach ($siblings as $sibling)
                <tr>
                    <td>{{$sibling->name}}</td>
                    <td>{{(strcmp($sibling->gender,'Male')==0)?'Brother':'Sister'}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-md-6">
        <table class="table table-bordered">
            <thead>
                <th>Name</th>
                <th>Relation</th>
            </thead>
            <tbody>
                @foreach ($cousins as $cousin)
                <tr>
                    <td>{{$cousin->name}}</td>
                    <td>{{(strcmp($cousin->gender,'Male')==0)?'Cousin Brother':'Cousin Sister'}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
