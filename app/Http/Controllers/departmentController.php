<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Department;


class departmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        return view ('admin.departments.index');
    }
    public function create()
    {
        //
        return view('admin.departments.create');
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
     
        $rules=[
          
           
            'name'=>'required|unique:departments',
            
         

  
        ];
        $message=[
            'name.required'=>'الاسم يكون مطلوب',
            'name.unique'=>'هذا القسم موجودة بالفعل لا يمكن انشاءها مرة أخرى',
         

        ];
        $this->validate($request,$rules,$message);
        $model=Department::create($request->all());
        flash()->success("تم إضافة قسم بنجاح");

  
        
        return  redirect(route('departments.index'));
  
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

        $model=Department::findorfail($id);
        return view('admin.departments.edit',compact('model'));
  
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
          $rules=[
              
              
            'name'=>'required|unique:departments,name,'.$id,
        


        ];
        $message=[
            'name.required'=>'الاسم يكون مطلوب',
            'name.unique'=>'هذه الاسم موجودة بالفعل لا يمكن انشاءها مرة أخرى',
        

        ];
        $this->validate($request,$rules,$message);
        $model=Department::findorfail($id);

        
        $model->update($request->all());
        $model->save();
        flash()->success("تم التعديل بنجاح");

        return  redirect(route('departments.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public static function delete_parent($id) {
		$department_parent = Department::where('parent', $id)->get();
		foreach ($department_parent as $sub) {
			self::delete_parent($sub->id);
		
			$subdepartment = Department::find($sub->id);
			if (!empty($subdepartment)) {
				$subdepartment->delete();
			}
		}
		$dep = Department::find($id);

		if (!empty($dep->icon)) {
			Storage::has($dep->icon)?Storage::delete($dep->icon):'';
		}
		$dep->delete();
	}
	public function destroy($id) {
		self::delete_parent($id);
        flash()->success('تم حذف بنجاح');
		return redirect(url('departments'));
	}
   
}


