<?php

namespace App\Http\Controllers;

use App\Template;
use App\Form;
use Illuminate\Http\Request;

class LeadformController extends Controller
{
	public function index(Request $request)
	{
		$model=Template::find($request->id);
        //return dd($model);
        $viewData=[];
        $viewData['templateId']=$request->id;
        $viewData['title']=$model->formheader;
        $viewData['formheader']=$model->formheader;        
        $viewData['elements']=json_decode($model->elements);
        return view('forms.default',$viewData);
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $method = $request->method();
        if (!$request->isMethod('post')) {
            return 'disallowed!';
        }
        //return dd($request->input());
        $model = new Form();
        $model->templateid = $request->input('templateid');
        $model->formheader = $request->input('formheader');
        $model->elements = $request->input('elements');
        $model->save();
        //return dd($request->input());
        return redirect()->route('leadformthanks');
    }

    public function thanks()
    {
    	return view('leadforms.thanks',[]);
    }

}
