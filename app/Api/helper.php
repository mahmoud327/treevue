<?php

function get_tree($select=null,$dep_hid=null){
    $departmets=\App\Department::selectRaw('name as name')
    ->selectRaw('id as id')->selectRaw('parent as parent')->get(['name','id','parent']);
    $dep_arr=[];
    foreach($departmets as $department){

        $list_arr=[];
        $list_arr  = ['li_attr '];
        $list_arr=['icon'];
        $list_arr=['a_attr'];
        $list_arr['clildreen']=[];
        if($select !=null and $select==$department->id)
        {
       
            $list_arr['state']=[
                'opened'=>true,
                'selected'=>true,
                'disabled'=>true
            ];
        }
        if($dep_hid !=null and $dep_hid==$department->id)
        {
       
            $list_arr['state']=[
                'opened'=>false,
                'selected'=>false,
                'disabled'=>true,
                'hidden'=>true
            ];
        }
        $list_arr['id']=$department->id;
        $list_arr['parent']=$department->parent > 0 ?$department->parent:'#';
        $list_arr['text']=$department->name;
        array_push($dep_arr,$list_arr);

    }
    return json_encode($dep_arr,JSON_UNESCAPED_UNICODE);

}


?>
