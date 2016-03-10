<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\DefenceRequest;

use App\Defence;

use JavaScript;

class DefenceController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($attack)
    {
        $this->authorize('append',$attack);

        return view('defence.create')->with('attack',$attack);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Requests\riskRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DefenceRequest $request, $attack)
    {
        $this->authorize('append',$attack);

        if ($attack->tree->id != $request->input('tree'))
            abort(400);

        $new_defence = new Defence($request->all());
        $new_defence->tree()->associate($request->input('tree'));
        $new_defence->tempAttacks = $request->input('attacks');
        $new_defence->save();
        $new_defence->attacks()->sync($request->input('attacks'));
       
        $new_defence->syncTags($request->input('tags'));

        return redirect()->route('tree.show',[$attack->tree])->with('succes','Defence successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\risk  $risk  risk Model
     * @return \Illuminate\Http\Response
     */
    public function show($attack, $defence)
    {
        return view('defence.view')->with('attack',$attack);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\risk  $risk  risk Model
     * @return \Illuminate\Http\Response
     */
    public function edit($attack, $defence)
    {
        $this->authorize('edit', $defence);

        $defence->lock();

        $defence->save();

        JavaScript::put([
            'model' => [
                'type' => (new \ReflectionClass($defence))->getShortName(),
                'id' => $defence->id
                ]
            ]);

        return view('defence.edit')->with('defence',$defence)->with('attack',$attack);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Requests\riskRequest  $request
     * @param  \App\riske  $risk  risk Model
     * @return \Illuminate\Http\Response
     */
    public function update(DefenceRequest $request, $attack, $defence)
    {        
        $this->authorize('update', $defence);

        $defence->unlock();

        $defence->attacks()->sync($request->input('attacks'));

        $defence->update($request->all());

        $defence->syncTags($request->input('tags'));
        
        return redirect()->route('tree.show', [$defence->tree->id])->with('success','Defence successfully edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Requests\Request  $request
     * @param  \App\risk $risk risk Model
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $defence)
    {        
        $this->authorize('destroy', $defence);

        $defence->delete();

        return redirect()->route('tree.show',[$defence->tree->id])->with('success','Defence successfully deleted');
    }

}
