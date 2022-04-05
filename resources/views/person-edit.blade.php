@extends('inc')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <form action="{{route('person.update',$person->id)}}" method="POST">
            <legend>Add new person</legend>
            @csrf
            @method("PUT")
            <div class="row form-floating">
                <input type="text" name="name" id="name" placeholder="enter person name here" value="{{$person->name}}" class="form-control">
                <label for="name" class="form-label">Name</label>
                @error('name')
                <span>{{$message}}</span>
                @enderror
                <br>
            </div>
            <div class="row form-floating">
                <select name="gender" id="gender" class="form-select" onchange="spouseCheck()">
                    <option value="" {{($person->gender==null)?'selected':''}}>None</option>
                    <option value="Male" {{(strcmp($person->gender,'Male')==0)?'selected':''}}>Male</option>
                    <option value="Female" {{(strcmp($person->gender,'Female')==0)?'selected':''}}>Female</option>
                    <option value="Other" {{(strcmp($person->gender,'Other')==0)?'selected':''}}>Other</option>
                </select>
                <label for="gender" class="form-label">Select a gender</label>
                @error('gender')
                <span>{{$message}}</span>
                @enderror
                <br>
            </div>
            <div class="row form-floating">
                <select name="father_id" id="father_id" class="form-select">
                    <option value="">None</option>
                    @foreach ($males as $male)
                    <option value="{{$male->id}}" {{($person->father_id==$male->id)?'selected':''}}>{{$male->name}}</option>
                    @endforeach
                </select>
                <label for="father_id" class="form-label">Select father</label>
                @error('gender')
                <span>{{$message}}</span>
                @enderror
                <br>
            </div>
            <div class="row form-floating">
                <select name="mother_id" id="mother_id" class="form-select">
                    <option value="">None</option>
                    @foreach ($females as $female)
                    <option value="{{$female->id}}" {{($person->mother_id==$female->id)?'selected':''}}>{{$female->name}}</option>
                    @endforeach
                </select>
                <label for="mother_id" class="form-label">Select mother</label>
                @error('gender')
                <span>{{$message}}</span>
                @enderror
                <br>
            </div>
            <div class="row form-floating" id="male_div">
                <select name="spouse" id="spouse" class="form-select">
                    <option value="">None</option>
                    @if (strcmp($person->gender,'Male')==0)
                        @foreach ($females as $female)
                        <option value="{{$female->id}}" {{$person->wife->contains($female->id)?'selected':''}}>{{$female->name}}</option>
                        @endforeach
                    @else
                        @foreach ($males as $male)
                        <option value="{{$male->id}}" {{$person->husband->contains($male->id)?'selected':''}}>{{$male->name}}</option>
                        @endforeach
                    @endif
                </select>
                <label for="spouse" class="form-label">Select spouse</label>
                @error('spouse')
                <span>{{$message}}</span>
                @enderror
                <br>
            </div>
            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{route('person.index')}}" class="btn btn-primary">Back</a>
        </form>
    </div>
</div>
@push('scripts')
<script>
    function spouseCheck()
    {
        let gender = $("#gender").val();
        let spouse = $("#spouse");
        $.ajax({
            url: app_url+"/ajax-spouse",
            method: "GET",
            data:{
                "gender":gender,
            },
            dataType:"json",
            success:function(data){
                spouse.empty();
                spouse.append("<option value=''>None</option>");
                data.spouse.forEach(function(s){
                    spouse.append("<option value='"+s.id+"'>"+s.name+"</option>");
                });
            }
        });
    }
</script>
@endpush
@endsection
