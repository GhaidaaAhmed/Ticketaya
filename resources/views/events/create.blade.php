@extends('layouts.app')
@section('content')
<section class="editing-forms">
    <div class="container">
        <div class="row mt-4 mb-2">
            <div class="col-md-12 text-center">
                <h2>Add Ticket for Sale</h2>
            </div>
        </div>
        <div class="row justify-content-md-center">
            <div class="col-md-6">
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form  method="post" action="/events/store" enctype="multipart/form-data">
                {{method_field('POST')}}
                {{csrf_field()}}
                <div class="row">
                    <div class="col-md-12">
                       <label >Event Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter Event Name">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                            <label >Event Start Date </label>
                            <input type="datetime-local" name="startdate" class="form-control"/>
                             </div>
                    <div class="col-md-6">
                            <label >Event End Date </label>
                            <input type="date" name="enddate" class="form-control"/>
                    </div>
                </div>
                <div class="row">
                        <div class="col-md-6">
                                <label >Event Tickets Quantity</label>
                                 <input type="number" name="avaliabletickets" class="form-control" placeholder="Quantity" min=0>
                        </div>
                    <div class="col-md-6">
                       <label >Event Category</label>
                        <select name="category" class="w-100">
                            @foreach($categories as $category)
                              <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                          </select>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6 " >
                        <label >City </label>
                        <select name="city" id="city" class="w-100">
                            @foreach(App\City::all() as $city)
                              <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 " id="toggleRegion" style="display: none;">
                        <label >Region </label>
                        <select name="region" id="region" class="w-100">
                        </select>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label >description</label>
                        <textarea name="description" class="form-control txt-area" placeholder="Please Add Event Description Here ..."></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="image">Event Image</label>
                        <input type="file" class="form-control-file ml-3 mt-2" name="photo"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <input type="submit" value="SUBMIT" class="btn btn-primary pl-5 pr-5">
                    </div>
                </div>

            </form>
            </div>
        </div>
    </div>
</section>
<script>
        $(document).ready( function(){
            $('#city').on('change',function(){
            var city_id = $(this).val();
            $('#region').empty();
            $.ajax({
                     url: '/cities/'+city_id,
                     type: 'GET' ,
                     data:{
                         '_token':'@csrf'
                     },
                success:function(response){
                    if(response.res == 'success'){
                        $.each(response.cityRegions, function(index,region){
                        var option=`<option value="`+region.id+`">`+region.name+`</option>`;
                        $('#region').append(option);
                    });
                    $('#toggleRegion').show();
                    }
                }
                 });
            });
            });
        </script>
@endsection
