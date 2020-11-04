@extends('layouts.admin')
@push('scripts')
<div id="delete_bootstrap_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">delete</h4>
      </div>
      {!! Form::open(['url'=>'','method'=>'delete','id'=>'form_Delete_department']) !!}
      <div class="modal-body">
        <h4>
        </h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">close</button>
      </div>
      {!! Form::close() !!}
    </div>
<script>

$(document).ready(function () {

    $('#jstree').jstree({
  "core" : {
    'data' : {!! get_tree() !!},
    "themes" : {
      "variant" : "large"
    }

  },
  "checkbox" : {
    "keep_selected_style" : false
  },
  "plugins" : [ "wholerow" ]
});
});
$('#jstree')
  // listen for event
  .on('changed.jstree', function (e, data) {
    var i, j, r = [];
    for(i = 0, j = data.selected.length; i < j; i++) {
      r.push(data.instance.get_node(data.selected[i]).id);
    }
    $('#form_Delete_department').attr('action','{{ url('departments') }}/'+r.join(', '));

    $('.parent_id').val(r.join(', '));
    if(r.join(', ') != ''){
    $('.showbtn_control').removeClass('hidden');
    $('.edit_dep').attr('href','{{url('departments/')}}/'+r.join(', ')+'/edit');
    $('#form_del').attr('action','{{ url('departments') }}/'+r.join(', '));



  }
  else{
    $('.showbtn_control').addclass('hidden');
  }
  });






</script>

@endpush

@section('content')





<section class="content" >
@include('flash::message')          

<div class="card">

<div class="box-body" style="margin-right:80px;padding-top:50px" >

<a href="" class="btn btn-inf edit_dep showbtn_control hidden"><i class="fa fa-edit">edit</i></a>

<form action="" id="form_del" method="POST">
                    
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                      
                    <button style="margin-right:60px; position:relative;bottom:40px; width:35px; height:40px; type="submit" class="btn btn-danger  del_dep showbtn_control hidden " >
                    <i class="fa fa-trash"></i>
                    </button>
                  </form>


    
<div id="jstree"></div>
<input type="hidden" class="parent_id" value=""  placeholder="  "name="parent" >

</div>
<!-- /.card -->
</div>

</section>

<!-- /.content -->

@endsection
