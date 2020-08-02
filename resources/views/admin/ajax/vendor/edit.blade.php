
<form action="{{ route('admin.vendors.update', $vendor->id) }}" novalidate method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="modal-body row">
        <input type="hidden" name="id" value="{{ $vendor->id }}" />
        <div class="col-12 col-md-6">
            <label class="text-capitalize" for="photo">old photo:</label>
            <div class="form-group">
              <img src="{{ asset('storage/images/'.$vendor->photo) }}" alt="{{ $vendor->name }}" class="avatar avatar-online height-75 width-100" />
            </div>
        </div>    
        <div class="col-12 col-md-6">
            <label class="text-capitalize" for="photo">new photo:</label>
            <div class="form-group">
              <input type="file" id="photo" name="photo" class="form-control" />
            </div>
        </div>

        <hr class="col-10 m-auto pt-1" />

        <div class="col-12 col-md-6">
            <label class="text-capitalize" for="name">name:</label>
            <div class="form-group">
                <input required type="text" autocomplete="off" id="name" name="name" class="form-control always-show-maxlength" maxlength="25" value="{{ $vendor->name }}" />
            </div>
        </div>

        
        <div class="col-12 col-md-6">
            <label class="text-capitalize" for="mobile">mobile:</label>
            <div class="form-group">
              <input required type="number" autocomplete="off" id="mobile" name="mobile" class="form-control" data-validation-containsnumber-regex="\+?([0-9]{2})-?([0-9]{3})-?([0-9]{6,7})"
              data-validation-containsnumber-message="No Characters Allowed, Only Numbers" value="{{ $vendor->mobile }}"  />
            </div>
          </div>
                                        
          <div class="col-12 col-md-6">
            <label class="text-capitalize" for="email">email:</label>
            <div class="form-group">
              <input required type="text" autocomplete="off" id="email" name="email" class="form-control" value="{{ $vendor->email }}" />
            </div>
          </div>
                                        
          <div class="col-12 col-md-6">
            <label class="text-capitalize" for="password">new password:</label>
            <div class="form-group">
              <input type="text" autocomplete="off" id="password" name="password" class="form-control" />
            </div>
          </div>
          
          <div class="col-12 col-md-6">
            <label class="text-capitalize" for="category_id">main category:</label>
            <div class="form-group">
              <select required id="category_id" name="category_id" class="form-control">
                @foreach ($categories as $maincategory)
                  <option value="{{ $maincategory->id}}"
                    @if ($maincategory->id == $vendor->category_id) selected @endif >
                        {{ $maincategory->name }}
                    </option> 
                @endforeach
              </select>
            </div>
          </div>

          <div class="col-12 col-md-6">
              <label class="text-capitalize">active: </label>
              <div class="form-group">
                  <input type="radio" id="active" name="active" value="1"  class="switchBootstrap" {{ ($vendor->active == 'Active')?'checked':'' }}/>
                  <label class="text-capitalize" for="active">active</label>
                  &nbsp;
                  <input type="radio" id="not-active" name="active" value="0"  class="switchBootstrap" {{ ($vendor->active == 'Not Active')?'checked':'' }}/>
                  <label class="text-capitalize" for="not-active">not active</label>
              </div>
          </div>
          
          <div class="col-12 col-md-12">
            <label class="text-capitalize" for="pac-input">address:</label>
            <div class="form-group">
            <input required type="text" autocomplete="off" id="pac-input-edit" name="address" class="form-control" readonly value="{{ $vendor->address }}" />
            </div>
          </div>
          <div id="map-edit" style="height: 350px;width: 100%"></div>    
                  
          <input id="latitude-edit" type="hidden" name="lat" value="{{ $vendor->lat }}">
          <input id="longitude-edit" type="hidden" name="long" value="{{ $vendor->long }}">
    
    </div>
    <div class="modal-footer">
        <input type="reset" class="btn btn-outline-secondary" data-dismiss="modal" value="Close">
        <input type="submit" class="btn btn-primary" value="Submit">
    </div>
    </form>