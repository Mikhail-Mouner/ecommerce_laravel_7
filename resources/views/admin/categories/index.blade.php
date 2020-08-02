@extends('layouts.admin')

@section('title') All Main Categories @endsection

@section('content')

<!-- Column controlled child rows -->
<section id="child-rows">
    <div class="row">
    <div class="col-12">
        <div class="card border-left-warning">
            <div class="card-header p-1">
                <h4 class="card-title">
                  <a class="btn btn-outline-blue blue btn-round btn-float btn-float-xs"
                    data-toggle="modal" data-target="#zoomInDown" title="add">
                    <i class="ft-plus"></i>
                  </a> 
                  Main Categories
                </h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                      <li><a data-action="collapse" title="collapse"><i class="ft-minus"></i></a></li>
                      <li><a data-action="expand" title="expand"><i class="ft-maximize"></i></a></li>
                      <li><a data-action="close" title="close"><i class="ft-x"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <!-- Modal -->
                    <div class="modal animated zoomInDown text-left" id="zoomInDown" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel70" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel70">Add New Main Categories</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('admin.main.categories.store') }}" novalidate method="POST" enctype="multipart/form-data">
                              @csrf
                              <div class="modal-body row">
                                
                                @foreach (get_languages() as $index => $lang)
                                  
                                  <div class="col-12 col-md-6">
                                    <label class="text-capitalize" for="name">name ({{ $lang->abbr }}) :</label>
                                    <div class="form-group">
                                      <input required type="text" autocomplete="off" id="name" name="cat[{{ $index }}][name]" class="form-control always-show-maxlength" maxlength="25" />
                                    </div>
                                  </div>
                                  
                                  <div class="col-12 col-md-6" hidden>
                                    <label class="text-capitalize" for="translation_lang">translation lang:</label>
                                    <div class="form-group">
                                    <input required  type="text" autocomplete="off" id="translation_lang" name="cat[{{ $index }}][translation_lang]" value="{{ $lang->abbr }}" class="form-control" />
                                    </div>
                                  </div>

                                @endforeach
                                
                                <div class="col-12 col-md-12">
                                  <label class="text-capitalize" for="photo">photo:</label>
                                  <div class="form-group">
                                    <input required type="file" id="photo" name="photo" class="form-control" />
                                  </div>
                                </div>
                              
                              </div>
                              <div class="modal-footer">
                                  <input type="reset" class="btn btn-outline-secondary" data-dismiss="modal" value="Close">
                                  <input type="submit" class="btn btn-primary" value="Submit">
                              </div>
                            </form>
                        </div>
                      </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal animated zoomInDown text-left" id="model2" tabindex="-1" role="dialog"
                    aria-labelledby="test" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="test">Edit Main Categories</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div id="modal-body"></div>
                        </div>
                      </div>
                    </div>
                    

                    <table class="table table-striped table-bordered  responsive dataex-res-controlled ">
                        <thead>
                          <tr class="text-capitalize text-center">
                            <th>#</th>
                            <th>language</th>
                            <th>photo</th>
                            <th>name</th>
                            <th>status</th>
                            <th>control</th>
                          </tr>
                        </thead>
                        
                        <tbody>
                          @forelse ($mainCategories as $mainCategory)
                            <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{ $mainCategory->translation_lang }}</td>
                              <td>
                                <img src="{{ asset('storage/images/'.$mainCategory->photo) }}" alt="{{ $mainCategory->name }}" class="avatar avatar-online height-75 width-100" />
                              </td>
                              <td>{{ $mainCategory->name }}</td>
                              <td>
                                <input type="checkbox" class="switchBootstrap" id="switchBootstrap8" data-on-text="Active"
                                data-off-text="Not Active" {{boolval($mainCategory->activeValue())?'checked':'' }} readonly/>
                              </td>
                              <td>
                                <button data-toggle="modal" data-target="#model2" title="edit"
                                data-id="{{$mainCategory->id}}" data-href="{{ route('admin.main.categories.edit',$mainCategory->id) }}" class="btn-edit btn btn-float btn-round btn-float-xs btn-success"><i class="la la-edit"></i></button>
                                
                                <button title="delete" data-id="{{$mainCategory->id}}" data-href="{{ route( 'admin.main.categories.destroy' , $mainCategory->id ) }}" class="btn-destroy btn btn-float btn-round btn-float-xs btn-danger"><i class="la la-trash"></i></button>
                              </td>
                            </tr>
                          @empty
                          <tr>
                            <td colspan="5" class="text-center">Empty</td>
                          </tr>                              
                          @endforelse
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<!--/ Column controlled child rows -->
@endsection
@section('script')
  <!-- BEGIN PAGE LEVEL JS-->
  <script>
  
    $(function($) {
      //edit
      $('.btn-edit').on('click', function() {
        $.ajax({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            type: "GET",
            dataType: 'json',
            async: true,
            url: $(this).data('href'),
            beforeSend: function() {
                $('#modal-body').html('<h4 class="text-center text-warning p-2"><i class="la la-spinner spinner"></i> Loading</h4>');
            },
            success: function (data) {
              console.log(data);
              $('#modal-body').html(data.html);
            }
        });
      });
      //delete
      $('.btn-destroy').on('click', function() {
        $.ajax({
            type: "POST",
            dataType: 'html',
            data: '_method=DELETE&_token={{ csrf_token() }}',
            async: true,
            url: $(this).data('href')
        });

        $(this).parents('tr').html('<td colspan="5" class="text-center text-danger"><i class="la la-trash"></i> Deleted</td>');
      });
    
    });
  </script>
  <!-- END PAGE LEVEL JS-->
@endsection