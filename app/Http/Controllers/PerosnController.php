<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PerosnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $persons = Person::all();
        return view('index',compact('persons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return 'This will return person create page';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = Validator::make($request->all(),[
            'name'      => 'required|min:5',
            'gender'    => 'required',
            'father'    => 'nullable',
            'mother'    => 'nullable',
            'spouse'    => 'nullable',
        ])->validate();
        DB::beginTransaction();
        try{
            $person = Person::create([
                'name'      => $data['name'],
                'gender'    => $data['gender'],
                'father'    => $data['father'],
                'mother'    => $data['mother'],
            ]);
            if($data['spouse'] != null){
                $person->attach($data['spouse']);
            }
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
            return $e;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function show(Person $person)
    {
        return $person;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function edit(Person $person)
    {
        return 'This will return person edit page';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Person $person)
    {
        $data = Validator::make($request->all(),[
            'name'      => 'required|min:5',
            'gender'    => 'required',
            'father'    => 'nullable',
            'mother'    => 'nullable',
            'spouse'    => 'nullable',
        ])->validate();
        DB::beginTransaction();
        try{
            $person->name = $data['name'];
            $person->gender = $data['gender'];
            $person->father = $data['father'];
            $person->mother = $data['mother'];
            $person->sync([$data['spouse']]);
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
            return $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function destroy(Person $person)
    {
        $person->delete();
    }
}
