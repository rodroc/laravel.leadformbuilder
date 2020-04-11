<?php

namespace App\Http\Controllers;

use App\Template;
use Illuminate\Http\Request;
// use Illuminate\Pagination\LengthAwarePaginator;
// use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class TemplateController extends Controller
{

    public function __construct(){

        $this->middleware('auth');

        if(!Auth::user()){
            return redirect()->route('login');
        }
    }

    public const fieldNames = ['label','text','texarea','emailtext'];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $templates=Template::paginate(5);
        return view('templates.index',[ 'templates'=> $templates ]);
        //View::('templates/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $method = $request->method();
        if ($request->isMethod('get')) {
            return view('templates.create',[]);
        }
        //return dd($request->input());
        //return view('templates.create',[ 'person'=> 'rod' ]);
        //foreach($request->input as $name => $value)
        //return dd($request->input());
        $model = new Template();
        $model->templatename = $request->input('templatename');
        $model->formheader = $request->input('formheader');
        // $elements=[];
        // foreach($request->input('items') as $key=>$value){
        //     if(in_array($key,self::fieldNames)){
        //         $elements[]=[
        //             $key=>$value
        //         ];
        //     }
        // }
        $model->elements = $request->input('elements');
        $model->save();
        //return dd($request->input());
        return redirect()->route('templatelist');
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
    }
}
