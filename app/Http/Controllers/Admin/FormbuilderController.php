<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\Tag;
use App\Page;
use App\Form;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Shortcode;

class FormbuilderController extends Controller
{

    public function index()
    {   
       

         $formshortcode = Form::where('formname', 'Home_Page')->first();
        if($formshortcode != "")
        {
        } 
        else
        {
        if($formshortcode['formname'] != 'Home_Page')
        {
            $formshortcode = new Form();
            $formshortcode->formname = "Home_Page";
            $formshortcode->shortcode = "-";
            $formshortcode->save();
        }
        }

         $formshortcode = Form::where('formname', 'Front_Page')->first();
        if($formshortcode != "")
        {
        } 
        else
        {
        if($formshortcode['formname'] != 'Front_Page')
        {
            $formshortcode = new Form();
            $formshortcode->formname = "Front_Page";
            $formshortcode->shortcode = "frontpage";
            $formshortcode->save();
        }
        }
        $forms = Form::withTrashed()->latest()->paginate(50);
        return view('admin.formbuilder.index',compact('forms'));
    }
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('admin.formbuilder.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
        

    //     $this->validate($request,[

    //             'tag' => 'required'


    //     ]);

    //     $tag = new Tag;
    //     $tag->tag = $request->tag;
    //     $tag->save();
    //     Session::flash('success', 'You succesfully created a tag.');
    //     return redirect()->route('admin.tags');


    // }

     public function fsave(Request $request)
    {
         $pwd = bin2hex(openssl_random_pseudo_bytes(4));
        $form = new Form;
        $form->formname = $request->formname;
        $form->htmlcontent = $request->htmlcontent;
        $form->shortcode = $pwd;
        $form->save();
        //Session::flash('success','Form saved successfully');
        return "success";
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
        $form = Form::find($id);
        return view('admin.formbuilder.edit')->with('form', $form);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function preview($id)
    {
        Shortcode::enable();
        $shortcode = App('Shortcode');
        $form = Form::find($id);
        return view('admin.formbuilder.preview')->with('form', $form)->withShortcodes();
    }

    public function snippets()
    {
        
        return view('admin.formbuilder.snippets');
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
        $this->validate($request, [

            'formname' => 'required'

        ]);
        $form = Form::find($id);
        $form->formname = $request->formname;
        $form->htmlcontent = $request->htmlcontent;
        $form->save();
        
        return "success";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $form = Form::withTrashed()->where('id', $id)->first();
         
          
            if($form->trashed()){
               $form->forceDelete();
                Session::flash('success', 'Form deleted permanently');
                return redirect()->back();
            } 
            else
            {    
                $form->delete();
                Session::flash('success', 'Form deleted');
                return redirect()->back();
            }
         

        
    }
     public function restore($id)
    {
        $form = Form::withTrashed()->where('id',$id)->first();
        if($form->trashed()){
            $form->restore();
        }
        Session::flash('success', 'You succesfully restored a form.');
         return redirect()->back();
    }



}
