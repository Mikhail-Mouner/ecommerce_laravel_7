
<form action="{{ route('admin.main.categories.update', $categ->id) }}" novalidate method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <input required type="hidden" name="id" value="{{ $categ->id }}" />
    <input required type="hidden" name="cat[0][translation_lang]" value="{{ $categ->translation_lang }}" />
    <div class="modal-body row">
        

        <div class="col-12 col-md-6">
            <label class="text-capitalize" for="photo">old photo:</label>
            <div class="form-group">
              <img src="{{ asset('storage/images/'.$categ->photo) }}" alt="{{ $categ->name }}" class="avatar avatar-online height-75 width-100" />
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
            <label class="text-capitalize" for="name">name ({{ $categ->translation_lang }}) :</label>
            <div class="form-group">
                <input required type="text" autocomplete="off" id="name" name="cat[0][name]" class="form-control always-show-maxlength" maxlength="25" value="{{ $categ->name }}" />
            </div>
        </div>
        <div class="col-12 col-md-6">
            <label class="text-capitalize mb-1">active ({{ $categ->translation_lang }}) : </label>
            <div class="form-group">
                <input type="radio" id="active" name="cat[0][active]" value="1"  class="switchBootstrap" {{ ($categ->active == 'Active')?'checked':'' }}/>
                <label class="text-capitalize" for="active">active</label>
                &nbsp;
                <input type="radio" id="not-active" name="cat[0][active]" value="0"  class="switchBootstrap" {{ ($categ->active == 'Not Active')?'checked':'' }}/>
                <label class="text-capitalize" for="not-active">not active</label>
            </div>
        </div>

        @forelse ($categ->categories as $category)
            <input required type="hidden" name="cat[{{ $loop->iteration }}][translation_lang]" value="{{ $category->translation_lang }}" />
            <hr class="col-10 m-auto pt-1 text-primary" />
            <div class="col-12 col-md-6">
                <label class="text-capitalize" for="name">name ({{ $category->translation_lang }}) :</label>
                <div class="form-group">
                    <input required type="text" autocomplete="off" id="name" name="cat[{{ $loop->iteration }}][name]" class="form-control always-show-maxlength" maxlength="25" value="{{ $category->name }}" />
                </div>
            </div>
            

            <div class="col-12 col-md-6">
                <label class="text-capitalize mb-1">active ({{ $category->translation_lang }}) : </label>
                <div class="form-group">
                    <input type="radio" id="active" name="cat[{{ $loop->iteration }}][active]" value="1"  class="switchBootstrap" {{ ($category->active == 'Active')?'checked':'' }}/>
                    <label class="text-capitalize" for="active">active</label>
                    &nbsp;
                    <input type="radio" id="not-active" name="cat[{{ $loop->iteration }}][active]" value="0"  class="switchBootstrap" {{ ($category->active == 'Not Active')?'checked':'' }}/>
                    <label class="text-capitalize" for="not-active">not active</label>
                </div>
            </div> 
        @empty
                
        @endforelse
    
    </div>
    <div class="modal-footer">
        <input type="reset" class="btn btn-outline-secondary" data-dismiss="modal" value="Close">
        <input type="submit" class="btn btn-primary" value="Submit">
    </div>
    </form>