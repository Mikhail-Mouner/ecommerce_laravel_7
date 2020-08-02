@extends('layouts.admin')

@section('title') All Vendors @endsection

@section('content')

<!-- Column controlled child rows -->
<section id="child-rows">
    <div class="row">
    <div class="col-12">
    </div>
    <div class="col-12">
      <div class="card border-left-warning">
        <div class="card-header p-1">
          <h4 class="card-title">
            <a class="btn btn-outline-blue blue btn-round btn-float btn-float-xs"
            data-toggle="modal" data-target="#zoomInDown" title="add">
            <i class="ft-plus"></i>
          </a> 
          Vendors
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
                            <h4 class="modal-title" id="myModalLabel70">Add New Vendor</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <form action="{{ route('admin.vendors.store') }}" novalidate method="POST" enctype="multipart/form-data">
                              @csrf
                              <div class="modal-body row">
                                
                                <div class="col-12 col-md-6">
                                  <label class="text-capitalize" for="name">name:</label>
                                  <div class="form-group">
                                    <input required type="text" autocomplete="off" id="name" name="name" class="form-control always-show-maxlength" maxlength="25" />
                                  </div>
                                </div>
                                
                                <div class="col-12 col-md-6">
                                  <label class="text-capitalize" for="mobile">mobile:</label>
                                  <div class="form-group">
                                    <input required type="number" autocomplete="off" id="mobile" name="mobile" class="form-control" data-validation-containsnumber-regex="\+?([0-9]{2})-?([0-9]{3})-?([0-9]{6,7})"
                                    data-validation-containsnumber-message="No Characters Allowed, Only Numbers" />
                                  </div>
                                </div>
                                                              
                                <div class="col-12 col-md-6">
                                  <label class="text-capitalize" for="email">email:</label>
                                  <div class="form-group">
                                    <input required type="text" autocomplete="off" id="email" name="email" class="form-control" />
                                  </div>
                                </div>
                                                              
                                <div class="col-12 col-md-6">
                                  <label class="text-capitalize" for="password">password:</label>
                                  <div class="form-group">
                                    <input required type="password" autocomplete="off" id="password" name="password" class="form-control" />
                                  </div>
                                </div>
                                
                                <div class="col-12 col-md-6">
                                  <label class="text-capitalize" for="category_id">main category:</label>
                                  <div class="form-group">
                                    <select required id="category_id" name="category_id" class="form-control">
                                      @foreach ($maincategories as $maincategory)
                                        <option value="{{ $maincategory->id}}">{{ $maincategory->name }}</option> 
                                      @endforeach
                                    </select>
                                  </div>
                                </div>
                                
                                <div class="col-12 col-md-6">
                                  <label class="text-capitalize" for="photo">photo:</label>
                                  <div class="form-group">
                                    <input required type="file" id="photo" name="photo" class="form-control" />
                                  </div>
                                </div>

                                <div class="col-12 col-md-12">
                                  <label class="text-capitalize" for="pac-input">address:</label>
                                  <div class="form-group">
                                    <input required type="text" autocomplete="off" id="pac-input" name="address" class="form-control" readonly />
                                  </div>
                                </div>
                                  
                                <div id="map" style="height: 350px;width: 100%"></div>    
                  
                                <input id="latitude" type="hidden" name="lat">
                                <input id="longitude" type="hidden" name="long">
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
                                <h4 class="modal-title" id="test">Edit Vendor</h4>
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
                            <th>name</th>
                            <th>photo</th>
                            <th>mobile</th>
                            <th>main category</th>
                            <th>status</th>
                            <th>control</th>
                          </tr>
                        </thead>
                        
                        <tbody>
                          @forelse ($vendors as $vendor)
                            <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{ $vendor->name }}</td>
                              <td>
                                <img src="{{ asset('storage/images/'.$vendor->photo) }}" alt="{{ $vendor->name }}" class="avatar avatar-online height-75 width-100" />
                              </td>
                              <td>{{ $vendor->mobile }}</td>
                              <td>{{ $vendor->mainCategory->name }}</td>
                              <td>
                                <input type="checkbox" class="switchBootstrap" id="switchBootstrap8" data-on-text="Active"
                                data-off-text="Not Active" {{ ($vendor->active == 'Active')?'checked':'' }} readonly/>
                              </td>
                              <td>
                                <button data-toggle="modal" data-target="#model2" title="edit"
                                data-id="{{$vendor->id}}" data-href="{{ route('admin.vendors.edit',$vendor->id) }}" class="btn-edit btn btn-float btn-round btn-float-xs btn-success"><i class="la la-edit"></i></button>
                                <button title="delete" data-id="{{$vendor->id}}" data-href="{{ route( 'admin.vendors.destroy' , $vendor->id ) }}" class="btn-destroy btn btn-float btn-round btn-float-xs btn-danger"><i class="la la-trash"></i></button>
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
              
              let lat  = $('#latitude-edit').val();
              let lng = $('#longitude-edit').val();
              $('#pac-input-edit').val();
              if($('#latitude-edit').val() !== "" && $('#longitude-edit').val() !== ""){
                  prevlat = lat;
                  prevLng = lng;
              }else{
                  prevlat =30.1194563;
                  prevLng =31.3427256;
              }

              initAutocompleteEdit();
              // This example adds a search box to a map, using the Google Place Autocomplete
              // feature. People can enter geographical searches. The search box will return a
              // pick list containing a mix of places and predicted search terms.
              // This example requires the Places library. Include the libraries=places
              // parameter when you first load the API. For example:
              // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
                function initAutocompleteEdit() {
                  var map = new google.maps.Map(document.getElementById('map-edit'), {
                      center: {lat:   parseFloat(prevlat) ,  lng: parseFloat(prevLng) },
                      zoom: 13,
                      mapTypeId: 'roadmap'
                  });
                  // move pin and current location
                  infoWindow = new google.maps.InfoWindow;
                  geocoder = new google.maps.Geocoder();
                  var geocoder = new google.maps.Geocoder();
                  google.maps.event.addListener(map, 'click', function(event) {
                      SelectedLatLng = event.latLng;
                      geocoder.geocode({
                          'latLng': event.latLng
                      }, function(results, status) {
                          if (status == google.maps.GeocoderStatus.OK) {
                              if (results[0]) {
                                  deleteMarkers();
                                  addMarkerRunTime(event.latLng);
                                  SelectedLocation = results[0].formatted_address;
                                  console.log( results[0].formatted_address);
                                  splitLatLngEdit(String(event.latLng));
                                  $("#pac-input-edit").val(results[0].formatted_address);
                              }
                          }
                      });
                  });
                  function geocodeLatLng(geocoder, map, infowindow,markerCurrent) {
                      var latlng = {lat: markerCurrent.position.lat(), lng: markerCurrent.position.lng()};
                      /* $('#branch-latLng').val("("+markerCurrent.position.lat() +","+markerCurrent.position.lng()+")");*/
                      $('#latitude-edit').val(markerCurrent.position.lat());
                      $('#longitude-edit').val(markerCurrent.position.lng());
                      geocoder.geocode({'location': latlng}, function(results, status) {
                          if (status === 'OK') {
                              if (results[0]) {
                                  map.setZoom(8);
                                  var marker = new google.maps.Marker({
                                      position: latlng,
                                      map: map
                                  });
                                  markers.push(marker);
                                  infowindow.setContent(results[0].formatted_address);
                                  SelectedLocation = results[0].formatted_address;
                                  $("#pac-input-edit").val(results[0].formatted_address);
                                  infowindow.open(map, marker);
                              } else {
                                  window.alert('No results found');
                              }
                          } else {
                              window.alert('Geocoder failed due to: ' + status);
                          }
                      });
                      SelectedLatLng =(markerCurrent.position.lat(),markerCurrent.position.lng());
                  }
                  function addMarkerRunTime(location) {
                      var marker = new google.maps.Marker({
                          position: location,
                          map: map
                      });
                      markers.push(marker);
                  }
                  function setMapOnAll(map) {
                      for (var i = 0; i < markers.length; i++) {
                          markers[i].setMap(map);
                      }
                  }
                  function clearMarkers() {
                      setMapOnAll(null);
                  }
                  function deleteMarkers() {
                      clearMarkers();
                      markers = [];
                  }
                  // Create the search box and link it to the UI element.
                  var input = document.getElementById('pac-input-edit');
                  $("#pac-input-edit").val("أبحث هنا ");
                  var searchBox = new google.maps.places.SearchBox(input);
                  map.controls[google.maps.ControlPosition.TOP_RIGHT].push(input);
                  // Bias the SearchBox results towards current map's viewport.
                  map.addListener('bounds_changed', function() {
                      searchBox.setBounds(map.getBounds());
                  });
                  var markers = [];
                  // Listen for the event fired when the user selects a prediction and retrieve
                  // more details for that place.
                  searchBox.addListener('places_changed', function() {
                      var places = searchBox.getPlaces();
                      if (places.length == 0) {
                          return;
                      }
                      // Clear out the old markers.
                      markers.forEach(function(marker) {
                          marker.setMap(null);
                      });
                      markers = [];
                      // For each place, get the icon, name and location.
                      var bounds = new google.maps.LatLngBounds();
                      places.forEach(function(place) {
                          if (!place.geometry) {
                              console.log("Returned place contains no geometry");
                              return;
                          }
                          var icon = {
                              url: place.icon,
                              size: new google.maps.Size(100, 100),
                              origin: new google.maps.Point(0, 0),
                              anchor: new google.maps.Point(17, 34),
                              scaledSize: new google.maps.Size(25, 25)
                          };
                          // Create a marker for each place.
                          markers.push(new google.maps.Marker({
                              map: map,
                              icon: icon,
                              title: place.name,
                              position: place.geometry.location
                          }));
                          $('#latitude-edit').val(place.geometry.location.lat());
                          $('#longitude-edit').val(place.geometry.location.lng());
                          if (place.geometry.viewport) {
                              // Only geocodes have viewport.
                              bounds.union(place.geometry.viewport);
                          } else {
                              bounds.extend(place.geometry.location);
                          }
                      });
                      map.fitBounds(bounds);
                  });
              }
              function handleLocationErrorEdit(browserHasGeolocation, infoWindow, pos) {
                  infoWindow.setPosition(pos);
                  infoWindow.setContent(browserHasGeolocation ?
                      'Error: The Geolocation service failed.' :
                      'Error: Your browser doesn\'t support geolocation.');
                  infoWindow.open(map);
              }
              function splitLatLngEdit(latLng){
                  var newString = latLng.substring(0, latLng.length-1);
                  var newString2 = newString.substring(1);
                  var trainindIdArray = newString2.split(',');
                  var lat = trainindIdArray[0];
                  var Lng  = trainindIdArray[1];
                  $("#latitude-edit").val(lat);
                  $("#longitude-edit").val(Lng);
              }

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
  <script>
      $("#pac-input").focusin(function() {
          $(this).val('');
      });
      $('#latitude').val('');
      $('#longitude').val('');
      // This example adds a search box to a map, using the Google Place Autocomplete
      // feature. People can enter geographical searches. The search box will return a
      // pick list containing a mix of places and predicted search terms.
      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
      function initAutocomplete() {
          var map = new google.maps.Map(document.getElementById('map'), {
              center: {lat: 30.1194563, lng: 31.3427256 },
              zoom: 13,
              mapTypeId: 'roadmap'
          });
          // move pin and current location
          infoWindow = new google.maps.InfoWindow;
          geocoder = new google.maps.Geocoder();
          if (navigator.geolocation) {
              navigator.geolocation.getCurrentPosition(function(position) {
                  var pos = {
                      lat: position.coords.latitude,
                      lng: position.coords.longitude
                  };
                  map.setCenter(pos);
                  var marker = new google.maps.Marker({
                      position: new google.maps.LatLng(pos),
                      map: map,
                      title: 'موقعك الحالي'
                  });
                  markers.push(marker);
                  marker.addListener('click', function() {
                      geocodeLatLng(geocoder, map, infoWindow,marker);
                  });
                  // to get current position address on load
                  google.maps.event.trigger(marker, 'click');
              }, function() {
                  handleLocationError(true, infoWindow, map.getCenter());
              });
          } else {
              // Browser doesn't support Geolocation
              handleLocationError(false, infoWindow, map.getCenter());
          }
          var geocoder = new google.maps.Geocoder();
          google.maps.event.addListener(map, 'click', function(event) {
              SelectedLatLng = event.latLng;
              geocoder.geocode({
                  'latLng': event.latLng
              }, function(results, status) {
                  if (status == google.maps.GeocoderStatus.OK) {
                      if (results[0]) {
                          deleteMarkers();
                          addMarkerRunTime(event.latLng);
                          SelectedLocation = results[0].formatted_address;
                          console.log( results[0].formatted_address);
                          splitLatLng(String(event.latLng));
                          $("#pac-input").val(results[0].formatted_address);
                      }
                  }
              });
          });
          function geocodeLatLng(geocoder, map, infowindow,markerCurrent) {
              var latlng = {lat: markerCurrent.position.lat(), lng: markerCurrent.position.lng()};
              /* $('#branch-latLng').val("("+markerCurrent.position.lat() +","+markerCurrent.position.lng()+")");*/
              $('#latitude').val(markerCurrent.position.lat());
              $('#longitude').val(markerCurrent.position.lng());
              geocoder.geocode({'location': latlng}, function(results, status) {
                  if (status === 'OK') {
                      if (results[0]) {
                          map.setZoom(8);
                          var marker = new google.maps.Marker({
                              position: latlng,
                              map: map
                          });
                          markers.push(marker);
                          infowindow.setContent(results[0].formatted_address);
                          SelectedLocation = results[0].formatted_address;
                          $("#pac-input").val(results[0].formatted_address);
                          infowindow.open(map, marker);
                      } else {
                          window.alert('No results found');
                      }
                  } else {
                      window.alert('Geocoder failed due to: ' + status);
                  }
              });
              SelectedLatLng =(markerCurrent.position.lat(),markerCurrent.position.lng());
          }
          function addMarkerRunTime(location) {
              var marker = new google.maps.Marker({
                  position: location,
                  map: map
              });
              markers.push(marker);
          }
          function setMapOnAll(map) {
              for (var i = 0; i < markers.length; i++) {
                  markers[i].setMap(map);
              }
          }
          function clearMarkers() {
              setMapOnAll(null);
          }
          function deleteMarkers() {
              clearMarkers();
              markers = [];
          }
          // Create the search box and link it to the UI element.
          var input = document.getElementById('pac-input');
          $("#pac-input").val("أبحث هنا ");
          var searchBox = new google.maps.places.SearchBox(input);
          map.controls[google.maps.ControlPosition.TOP_RIGHT].push(input);
          // Bias the SearchBox results towards current map's viewport.
          map.addListener('bounds_changed', function() {
              searchBox.setBounds(map.getBounds());
          });
          var markers = [];
          // Listen for the event fired when the user selects a prediction and retrieve
          // more details for that place.
          searchBox.addListener('places_changed', function() {
              var places = searchBox.getPlaces();
              if (places.length == 0) {
                  return;
              }
              // Clear out the old markers.
              markers.forEach(function(marker) {
                  marker.setMap(null);
              });
              markers = [];
              // For each place, get the icon, name and location.
              var bounds = new google.maps.LatLngBounds();
              places.forEach(function(place) {
                  if (!place.geometry) {
                      console.log("Returned place contains no geometry");
                      return;
                  }
                  var icon = {
                      url: place.icon,
                      size: new google.maps.Size(100, 100),
                      origin: new google.maps.Point(0, 0),
                      anchor: new google.maps.Point(17, 34),
                      scaledSize: new google.maps.Size(25, 25)
                  };
                  // Create a marker for each place.
                  markers.push(new google.maps.Marker({
                      map: map,
                      icon: icon,
                      title: place.name,
                      position: place.geometry.location
                  }));
                  $('#latitude').val(place.geometry.location.lat());
                  $('#longitude').val(place.geometry.location.lng());
                  if (place.geometry.viewport) {
                      // Only geocodes have viewport.
                      bounds.union(place.geometry.viewport);
                  } else {
                      bounds.extend(place.geometry.location);
                  }
              });
              map.fitBounds(bounds);
          });
      }
      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
          infoWindow.setPosition(pos);
          infoWindow.setContent(browserHasGeolocation ?
              'Error: The Geolocation service failed.' :
              'Error: Your browser doesn\'t support geolocation.');
          infoWindow.open(map);
      }
      function splitLatLng(latLng){
          var newString = latLng.substring(0, latLng.length-1);
          var newString2 = newString.substring(1);
          var trainindIdArray = newString2.split(',');
          var lat = trainindIdArray[0];
          var Lng  = trainindIdArray[1];
          $("#latitude").val(lat);
          $("#longitude").val(Lng);
      }
      /*AIzaSyDKZAuxH9xTzD2DLY2nKSPKrgRi2_y0ejs*//*course*/
      /*AIzaSyC7E7aFNl7n47GARLP_JVUaVwaQ9w_Pbys*//*mi5a*/
  </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDKZAuxH9xTzD2DLY2nKSPKrgRi2_y0ejs&libraries=places&callback=initAutocomplete&language=en&region=EG
         async defer"></script>
         
  <!-- END PAGE LEVEL JS-->
    @endsection