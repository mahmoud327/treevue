<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Offer;
class OffertemporyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $records=Offer::where('sort','temporary')->paginate(2);
        return view ('admin.offer.tempory',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $model=Offer::findorfail($id);
        return view('admin.offer.edittempory',compact('model'));
  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $model=Offer::findorfail($id);
        $model->update($request->all());
        $model->save();
        return  redirect(route('offertempory.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $record=Offer::findorfail($id);
        $record->delete();
        return  redirect(route('offertempory.index'));

    }

public function search(Request $request)
{
    
    $query = $request->input('query');

    // $products = Product::where('name', 'like', "%$query%")
    //                    ->orWhere('details', 'like', "%$query%")
    //                    ->orWhere('description', 'like', "%$query%")
    //                    ->paginate(10);

    $records = Offer::where('sort','temporary')->search($query)->paginate(10);

    return view('admin.offer.temp_search-results',compact('records'));
}

}