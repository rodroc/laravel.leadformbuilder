<?php

namespace App\Http\Controllers;

use App\Template;
use App\Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
        if(!Auth::user()){
            return redirect()->route('login');
        }

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $method = $request->method();
        if (!$request->isMethod('get')) {
            return 'disallowed!';
        }
    
        if(!$request->id){

            $forms=Form::paginate(5);
            return view('forms.index',[ 'forms'=> $forms ]);
        }
    
        $model=Template::find($request->id);
        //return dd($model);
        $viewData=[];
        $viewData['templateId']=$request->id;
        $viewData['title']=$model->formheader;
        $viewData['formheader']=$model->formheader;        
        $viewData['elements']=json_decode($model->elements);

        //$viewData['elements']=[

        //     (object) [
        //         'type'=>'label',
        //         'text'=>'Email Address'
        //     ],
        //                 (object) [
        //         'type'=>'emailtext',
        //         'text'=>'pls enter the email address here'
        //     ]            
        // ];
        //return dd($viewData);
        return view('forms.default',$viewData);
    }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create(Request $request)
    // {
    //     $method = $request->method();
    //     if (!$request->isMethod('post')) {
    //         return 'disallowed!';
    //     }
    //     //return dd($request->input());
    //     $model = new Form();
    //     $model->templateid = $request->input('templateid');
    //     $model->formheader = $request->input('formheader');
    //     $model->elements = $request->input('elements');
    //     $model->save();
    //     //return dd($request->input());
    //     return redirect()->route('formlist');
    // }

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
    public function show(Request $request)
    {
        if(!Auth::user()){
            return redirect()->route('login');
        }

        $method = $request->method();
        if (!$request->isMethod('get')) {
            return 'disallowed!';
        }
        if(!$request->id){
            // $forms=Form::paginate(2);
            // return view('forms.index',[ 'forms'=> $forms ]);
            return 'missing arg';
        }
        $model=Form::find($request->id);
        //return dd($model);
        $viewData=[];
        $viewData['created_at']=$model->created_at;
        $viewData['templateId']=null;
        $viewData['title']=$model->formheader;
        $viewData['formheader']=$model->formheader;        
        $viewData['elements']=json_decode($model->elements);
        return view('forms.default',$viewData);
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
