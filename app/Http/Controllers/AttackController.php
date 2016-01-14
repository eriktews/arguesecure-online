<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\AttackRequest;

use App\Attack;

use JavaScript;

class AttackController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($risk)
    {
        $this->authorize('append',$risk);

        return view('attack.create')->with('risk',$risk);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Requests\riskRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttackRequest $request, $risk)
    {
        $this->authorize('append',$risk);

        $new_attack = new Attack($request->all());
        $new_attack->risk()->associate($risk)->save();

        return redirect()->route('tree.show',[$risk->tree])->with('succes','Attack successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\risk  $risk  risk Model
     * @return \Illuminate\Http\Response
     */
    public function show($risk, $attack)
    {
        return view('attack.view')->with('attack',$attack);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\risk  $risk  risk Model
     * @return \Illuminate\Http\Response
     */
    public function edit($risk, $attack)
    {
        $this->authorize('edit', $attack);

        $attack->lock();

        $attack->save();

        JavaScript::put([
            'model' => [
                'type' => (new \ReflectionClass($attack))->getShortName(),
                'id' => $attack->id
                ]
            ]);

        return view('attack.edit')->with('attack',$attack);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Requests\riskRequest  $request
     * @param  \App\riske  $risk  risk Model
     * @return \Illuminate\Http\Response
     */
    public function update(AttackRequest $request, $risk, $attack)
    {        
        $this->authorize('update', $attack);

        $attack->unlock();

        $attack->update($request->all());

        return redirect()->route('tree.show', [$attack->tree->id])->with('success','Attack successfully edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Requests\Request  $request
     * @param  \App\risk $risk risk Model
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $attack)
    {        
        $this->authorize('destroy', $attack);

        $attack->delete();

        return redirect()->route('tree.show',[$attack->tree->id])->with('success','Attack successfully deleted');
    }

}
