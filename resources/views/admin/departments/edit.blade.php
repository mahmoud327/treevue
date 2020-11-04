@extends('layouts.admin')

@push('scripts')
<script>


$(document).ready(function () {
  $('#jstree').jstree({
  "core" : {
    'data' : {!! get_tree($model->parent,$model->id) !!},
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
    $('.parent_id').val(r.join(', '));
  })

   

</script>

@endpush
@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url(route('departments.index'))}}">الرئيسية </a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{url(route('departments.index'))}}"> الاقسام  </a>
                                </li>
                                <li class="breadcrumb-item active">تعديل قسم 
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
            
      @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form"> تعديل قسم  </h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                @include('admin.includes.alerts.success')
                                @include('admin.includes.alerts.errors')
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                    {!! Form::open(['url'=>url('departments/'.$model->id),'method'=>'put','files'=>true]) !!}

                                            @csrf
                                            <input name="id" value="{{$model -> id}}" type="hidden">

                                            <div class="form-body">

                                                <h4 class="form-section"><i class="ft-home"></i> بيانات القسم </h4>

                                      
                                                   <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="projectinput1"> اسم القسم - </label>
                                                                    <input type="text" value="{{$model->name}}" id="name"
                                                                           class="form-control"
                                                                           placeholder="  "
                                                                           name="name">
                                                                    @error("category.name")
                                                                    <span class="text-danger"> هذا الحقل مطلوب</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            
                                            </div>
                                            
                                            <div id="jstree"></div>
                                            <input type="hidden" class="parent_id" value="{{$model->parent}}" 
                                                                           placeholder=""
                                                                         name="parent" >

                                                          



                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1"
                                                        onclick="history.back();">
                                                    <i class="ft-x"></i> تراجع
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> حفظ
                                                </button>
                                            </div>
                                            {!! Form::close() !!}

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>

@endsection
