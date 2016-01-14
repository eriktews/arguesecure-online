<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\RiskRequest;

use App\Risk;

use JavaScript;

class RiskController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($tree)
    {
        $this->authorize('append',$tree);

        return view('risk.create')->with('tree',$tree);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Requests\riskRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RiskRequest $request, $tree)
    {
        $this->authorize('append',$tree);

        $new_risk = new Risk($request->all());
        $new_risk->tree()->associate($tree)->save();

        return redirect()->route('tree.show',[$tree])->with('succes','Risk successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\risk  $risk  risk Model
     * @return \Illuminate\Http\Response
     */
    public function show($tree, $risk)
    {
        return view('risk.view')->with('risk',$risk);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\risk  $risk  risk Model
     * @return \Illuminate\Http\Response
     */
    public function edit($tree, $risk)
    {
        $this->authorize('edit', $risk);

        $risk->lock();

        $risk->save();

        JavaScript::put([
            'model' => [
                'type' => (new \ReflectionClass($risk))->getShortName(),
                'id' => $risk->id
                ]
            ]);

        return view('risk.edit')->with('risk',$risk);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Requests\riskRequest  $request
     * @param  \App\riske  $risk  risk Model
     * @return \Illuminate\Http\Response
     */
    public function update(RiskRequest $request, $tree, $risk)
    {        
        $this->authorize('update', $risk);

        $risk->unlock();

        $risk->update($request->all());

        return redirect()->route('tree.show', [$tree])->with('success','Risk successfully edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Requests\Request  $request
     * @param  \App\risk $risk risk Model
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $risk)
    {        
        $this->authorize('destroy', $risk);

        $risk->delete();

        return redirect()->route('tree.show',[$risk->tree])->with('success','Risk successfully deleted');
    }

}
