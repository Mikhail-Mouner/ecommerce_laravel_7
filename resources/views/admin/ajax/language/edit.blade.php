
<form action="{{ route('admin.language.update', $language->id) }}" novalidate method="POST">
    @csrf
    @method('PUT')
    <div class="modal-body row">
        
        <div class="col-12 col-md-6">
            <label class="text-capitalize" for="name">name:</label>
            <div class="form-group">
                <input required type="text" autocomplete="off" id="name" name="name" class="form-control always-show-maxlength" maxlength="25" value="{{ $language->name }}" />
            </div>
        </div>
        
        <div class="col-12 col-md-6">
            <label class="text-capitalize" for="abbr">abbr:</label>
            <div class="form-group">
                <input required type="text" autocomplete="off" id="abbr" name="abbr" class="form-control always-show-maxlength" maxlength="10"  value="{{ $language->abbr }}" />
            </div>
        </div>
        
        <div class="col-12 col-md-6">
            <label class="text-capitalize" for="local">local:</label>
            <div class="form-group">
                <input required type="text" autocomplete="off" id="local" name="local" class="form-control always-show-maxlength" maxlength="25" value="{{ $language->local }}" />
            </div>
        </div>
        
        <div class="col-12 col-md-6">
            <label class="text-capitalize" for="direction">direction: </label>
            <div class="form-group">
                <select required class="form-control" id="direction" name="direction">
                    <option value="ltr" {{ ($language->direction == 'ltr')?'selected':'' }}>Left To Right</option>
                    <option value="rtl" {{ ($language->direction == 'rtl')?'selected':'' }}>Right To Left</option>
                </select>
            </div>
        </div>
        
        <div class="col-12 col-md-6">
            <label class="text-capitalize">active: </label>
            <div class="form-group">
                <input type="radio" id="active" name="active" value="1"  class="switchBootstrap" {{ ($language->active == 'Active')?'checked':'' }}/>
                <label class="text-capitalize" for="active">active</label>
                &nbsp;
                <input type="radio" id="not-active" name="active" value="0"  class="switchBootstrap" {{ ($language->active == 'Not Active')?'checked':'' }}/>
                <label class="text-capitalize" for="not-active">not active</label>
            </div>
        </div>
    
    </div>
    <div class="modal-footer">
        <input type="reset" class="btn btn-outline-secondary" data-dismiss="modal" value="Close">
        <input type="submit" class="btn btn-primary" value="Submit">
    </div>
    </form>