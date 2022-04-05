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
        $males = Person::where('gender','Male')->get();
        $females = Person::where('gender','Female')->get();
        return view('person-create',compact('males','females'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $data = Validator::make($request->all(),[
            'name'      => 'required|min:5',
            'gender'    => 'required',
            'father_id'    => 'nullable',
            'mother_id'    => 'nullable',
            'spouse'    => 'nullable',
        ])->validate();
        // dd($data);
        DB::beginTransaction();
        try{
            $person = Person::create([
                'name'      => $data['name'],
                'gender'    => $data['gender'],
                'father_id'    => $data['father_id'],
                'mother_id'    => $data['mother_id'],
            ]);
            if($data['spouse'] != null){
                if(strcmp($data['gender'],'Male')==0){
                    $person->wife()->attach($data['spouse']);
                }
                else{
                    $person->husband()->attach($data['spouse']);
                }
            }
            DB::commit();
            return redirect(route('person.index'));
        }catch(Exception $e){
            DB::rollBack();
            dd($e);
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
        return view('person-show',compact('person'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function edit(Person $person)
    {
        $males = Person::where('gender','Male')->get();
        $females = Person::where('gender','Female')->get();
        return view('person-edit',compact('person','males','females'));
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
            'father_id'    => 'nullable',
            'mother_id'    => 'nullable',
            'spouse'    => 'nullable',
        ])->validate();
        DB::beginTransaction();
        try{
            $person->name = $data['name'];
            $person->gender = $data['gender'];
            $person->father_id = $data['father_id'];
            $person->mother_id = $data['mother_id'];
            if($data['spouse'] != null){
                if(strcmp($person->gender,'Male')==0){
                    $person->wife()->sync([$data['spouse']]);
                }
                else{
                    $person->husband()->sync([$data['spouse']]);
                }
            }
            $person->save();
            DB::commit();
            return redirect(route('person.index'));
        }catch(Exception $e){
            DB::rollBack();
            dd($e);
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
        return redirect(route('person.index'));
    }
    //get ajax spouse
    public function getAjaxSpouse(Request $request)
    {
        $persons = Person::where('gender','!=',$request->gender)->get();
        return response()->json(['spouse'=>$persons]);
    }
    //tree view
    public function treeView(Person $person)
    {
        $self = $person;
        $patGrdPa = array();
        $matGrdPa = array();
        $patDepth = 0;
        $matDepth = 0;
        if($person->father != null){
            array_push($patGrdPa,$person->father);
            $person = $person->father;
            $patDepth++;
            while($person->father != null){
                $person = $person->father;
                array_unshift($patGrdPa,$person);
                $patDepth++;
            }
        }
        $person = $self;
        if($person->mother != null){
            array_push($matGrdPa,$person->mother);
            $person = $person->mother;
            $matDepth++;
            while($person->father != null){
                $person = $person->father;
                array_unshift($matGrdPa,$person);
                $matDepth++;
            }
        }
        $siblings = $this->getSibling($self);
        $cousins = $this->getCousins($self);
        return view('tree-view',compact('patGrdPa','matGrdPa','patDepth','matDepth','siblings','cousins','self'));
    }
    public function getSibling(Person $person)
    {
        if($person == null){
            return null;
        }
        return Person::where('father_id',$person->father_id)
                        ->where('father_id','!=',null)
                        ->where('id','!=',$person->id)
                        ->where('mother_id',$person->mother_id)
                        ->where('mother_id','!=',null)
                        ->orderBy('name')
                        ->get();
    }
    public function getCousins(Person $person)
    {
        $cousins = array();
        if($person->father != null){
            $fatherSiblings = $this->getSibling($person->father);
            foreach($fatherSiblings as $fs){
                $paternalCousins = Person::orWhere('father_id',$fs->id)
                                            ->orwhere('mother_id',$fs->id)
                                            ->orderBy('name')
                                            ->get();
                foreach($paternalCousins as $pc){
                    array_push($cousins,$pc);
                }
            }
        }
        if($person->mother != null){
            $motherSiblings = $this->getSibling($person->mother);
            foreach($motherSiblings as $ms){
                $maternalCousins = Person::orWhere('father_id',$fs->id)
                                            ->orwhere('mother_id',$fs->id)
                                            ->orderBy('name')
                                            ->get();
                foreach($maternalCousins as $mc){
                    array_push($cousins,$mc);
                }
            }
        }
        return $cousins;
    }
}
