<?php

/**
 *
 * Use cmd+f to replace 'Model__' with the correct model's name.
 *
 */

namespace App\Http\Controllers;

use App\Models\.$Model__;
use Illuminate\Http\Request;

class $Model__.Controller extends Controller
{

    public $model_class = Model__::class;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $table_fields = $this->model_class::$table_fields;
        $table_name = app($this->model_class)->getTable();
        return view((app($this->model_class)->getTable().'.'.__FUNCTION__), compact('table_fields','table_name'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //if it has no custom values in form.
        $preform_title = 'Nuovo '.app($this->model_class)->getTable();
        $table_name = app($this->model_class)->getTable();
        return view('preform',compact('table_name','preform_title'));

        //else
        // $table_fields = $this->model_class::$table_fields;
        // $table_name = app($this->model_class)->getTable();
        // return view((app($this->model_class)->getTable().'.'.__FUNCTION__), compact('table_fields','table_name'));
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(Model__ $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Model__ $item)
    {
        return view((app($this->model_class)->getTable().'.'.__FUNCTION__),compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Model__ $item)
    {
        $item->update($request->all());
        return redirect()->route($this->slug)->with('success','');
    }

    public function ajaxLoadList(Request $request){
        $_draw = !empty($request->input('draw')) ? $request->input('draw') : 1;
        $_start = !empty($request->input('start')) ? $request->input('start') : 0;
        $_length = !empty($request->input('length')) ? $request->input('length') : 10;

        $_sortColumnIndex = !empty($request->input('order')[0]['column']) ? $request->input('order')[0]['column'] : 1;
        $_sortDir = !empty($request->input('order')[0]['dir']) ? $request->input('order')[0]['dir'] : 'asc';
        $_query = !empty($request->input('search')['value']) ? $request->input('search')['value'] : '';

        //ADD HERE COLUMNS.
        $_sortColumnArr = ['id'];
        $_sortColumn = !empty($_sortColumnArr[$_sortColumnIndex]) ? $_sortColumnArr[$_sortColumnIndex] : 'id';

        $model = Model__::query();

            if(!empty($request['search']['value'])){
                $model->whereLike([''/*add here columns you want to search through*/],$request['search']['value']);
            }

        $_count = $model->count();
        $_find = $model->orderBy($_sortColumn, $_sortDir)->skip($_start)->take($_length)->get();

        $_results = [];
        if (!empty($_find)) {
            foreach ($_find as $_u) {

                $_buttons = '<a href="'.route(app($this->model_class)->getTable().'.edit', $_u->id).'" class="btn-action btn btn-outline-dark me-2" data-bs-toggle="tooltip" title="Modifica" data-bs-original-title="Modifica">
                      <i class="las la-pen"></i>
                  </a>';

                $_buttons .= '<a href="javascript:;" class="btn-action btn btn-outline-dark itemDelete m-0" data-id="' . $_u->id . '" data-bs-toggle="tooltip" title="Elimina" data-bs-original-title="Elimina">
                      <i class="las la-trash-alt"></i>
                  </a>';

                $_results[] = array(
                    $_u->id,
                    //ADD HERE LOADLIST RESULTS
                    $_buttons
                );
            }
        }

        return response()->json([
                    'draw' => $_draw,
                    'recordsTotal' => $_count,
                    'recordsFiltered' => $_count,
                    'data' => $_results
        ]);

    }

    public function ajaxDelete(Request $request){
        Model__::find($request->id)->delete();
        $_ret['success'] = true;
        return response()->json($_ret);
    }

    public function ajaxSave(Request $request){
        Model__::create($request->all());
        $_ret['success'] = true;
        return response()->json($_ret);
    }

}
