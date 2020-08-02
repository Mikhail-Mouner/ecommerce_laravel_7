@extends('layouts.admin')

@section('title') All Languages @endsection

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
                  Language
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
                                <h4 class="modal-title" id="myModalLabel70">Add New Language</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('admin.language.store') }}" novalidate method="POST">
                              @csrf
                              <div class="modal-body row">
                                
                                <div class="col-12 col-md-6">
                                  <label class="text-capitalize" for="name">name:</label>
                                  <div class="form-group">
                                    <input required type="text" autocomplete="off" id="name" name="name" class="form-control always-show-maxlength" maxlength="25" />
                                  </div>
                                </div>
                                
                                <div class="col-12 col-md-6">
                                  <label class="text-capitalize" for="abbr">abbr:</label>
                                  <div class="form-group">
                                    <input required type="text" autocomplete="off" id="abbr" name="abbr" class="form-control always-show-maxlength" maxlength="10" />
                                  </div>
                                </div>
                                
                                <div class="col-12 col-md-6">
                                  <label class="text-capitalize" for="local">local:</label>
                                  <div class="form-group">
                                    <input required type="text" autocomplete="off" id="local" name="local" class="form-control always-show-maxlength" maxlength="25" />
                                  </div>
                                </div>
                                
                                <div class="col-12 col-md-6">
                                  <label class="text-capitalize" for="direction">direction: </label>
                                  <div class="form-group">
                                    <select required class="form-control" id="direction" name="direction">
                                      <option value="ltr">Left To Right</option>
                                      <option value="rtl">Right To Left</option>
                                    </select>
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
                                <h4 class="modal-title" id="test">Edit Language</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div id="modal-body"></div>
                        </div>
                      </div>
                    </div>
                    

                    <table class="table table-striped table-bordered  responsive dataex-res-controlled">
                        <thead>
                          <tr class="text-capitalize text-center">
                            <th>#</th>
                            <th>name</th>
                            <th>abbr</th>
                            <th>local</th>
                            <th>direction</th>
                            <th>status</th>
                            <th>control</th>
                          </tr>
                        </thead>
                        
                        <tbody>
                          @forelse ($languages as $language)
                            <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{ $language->name }}</td>
                              <td>{{ $language->abbr }}</td>
                              <td>{{ $language->local }}</td>
                              <td>{{ $language->direction }}</td>
                              <td>
                                <input type="checkbox" class="switchBootstrap" id="switchBootstrap8" data-on-text="Active"
                                data-off-text="Not Active" {{ ($language->active == 'Active')?'checked':'' }} readonly/>
                              </td>
                              <td>
                                <button data-toggle="modal" data-target="#model2" title="edit"
                                data-id="{{$language->id}}" data-href="{{ route('admin.language.edit',$language->id) }}" class="btn-edit btn btn-float btn-round btn-float-xs btn-success"><i class="la la-edit"></i></button>
                                
                                <button title="delete" data-id="{{$language->id}}" data-href="{{ route( 'admin.language.destroy' , $language->id ) }}" class="btn-destroy btn btn-float btn-round btn-float-xs btn-danger"><i class="la la-trash"></i></button>
                              </td>
                            </tr>
                          @empty
                          <tr>
                            <td colspan="7" class="text-center">Empty</td>
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

        $(this).parents('tr').html('<td colspan="7" class="text-center text-danger"><i class="la la-trash"></i> Deleted</td>');
      });
    
    });
  </script>
  <!-- END PAGE LEVEL JS-->
@endsection