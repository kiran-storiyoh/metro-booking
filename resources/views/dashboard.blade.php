<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <select class="" id="from_station" id="from_station">
                        <option value="">From</option>
                        @foreach($stations as $from)
                        <option value="{{$from->id}}">{{$from->station_name}}</option>
                        @endforeach
                    </select>
                    
                    <select class="" id="to_station" id="to_station">
                        <option value="">To</option>
                        @foreach($stations as $to)
                        <option value="{{$to->id}}">{{$to->station_name}}</option>
                        @endforeach
                    </select>

                    <input type="text" name="travel_date" id="travel_date" class="date" placeholder="Pick Date">

                    <button name="search_train" id="search_train" class="btn btn-primary">Search</button>

                </div>

                <div class="p-6 bg-white border-b border-gray-200" id="book_train" style="display:none;">
                    Choose a compartment from <span id="train_name"></span><br> 
                    @for($i=1;$i<=10;$i++)
                        <button name="boggie_{{$i}}" id="boggie_{{$i}}" class="btn btn-sm btn-primary" onclick="openSeats({{$i}})">{{$i}}</button>
                    @endfor                    
                </div>

                <div class="p-6 bg-white border-b border-gray-200" id="seats" style="display:none;">
                    Choose a seat from compartment <span id="selected_compartment_id"></span><br> 
                    @for($i=1;$i<=20;$i++)
                    <button name="boggie_{{$i}}" id="boggie_{{$i}}" class="btn btn-sm btn-outline-primary" onclick="bookTrain({{$i}})">{{$i}}</button>
                    @endfor                    
                </div>

                <input type="hidden" id="train_id" name="train_id">
                <input type="hidden" id="compartment_number" name="compartment_number">

            </div>
        </div>
    </div>
</x-app-layout>

<script type="text/javascript">

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    var date = new Date();
    date.setDate(date.getDate()+1);

    $("#travel_date").datepicker({  
        format: 'dd-mm-yyyy',
        startDate: date
     });   
     
    $("#search_train").click(function() {
        let from_station = $("#from_station").val();
        let to_station = $("#to_station").val();
        let sdate = $("#travel_date").val();

        if(from_station == to_station)
        {
            $("#to_station").val("");
            alert("Please select different station");
            return false;
        }

        if(from_station!=""&&to_station!=""&&sdate!="")
        {
            $.ajax({
                type:'POST',
                url:"{{ route('search-train') }}",
                data:{from_station:from_station,to_station:to_station,sdate:sdate},
                success:function(data){
                    if(data.result =='success')
                    {
                        $("#book_train").css('display','block');
                        $("#train_name").text(data.selected_train_name);
                        $("#train_id").val(data.selected_train_id);
                    } else {
                        alert("You've already booked on this slot!!");
                    }
                    
                }
            });
        } else 
        {
            alert("Please fill all the fileds");
            return false;
        }
    });

    function openSeats(compartment)
    {
        $("#selected_compartment_id").text(compartment);
        $("#compartment_number").val(compartment);
        $("#seats").css('display','block');
    }

    function bookTrain(seat)
    {
        let from_station = $("#from_station").val();
        let to_station = $("#to_station").val();
        let sdate = $("#travel_date").val(); 
        let compartment_id = $("#compartment_number").val();
        let train_id = $("#train_id").val();

        $.ajax({
                type:'POST',
                url:"{{ route('book-train') }}",
                data:{from_station:from_station,to_station:to_station,sdate:sdate,compartment_id:compartment_id,train_id:train_id,seat:seat},
                success:function(data){
                    if(data.status == 'true')
                    {
                        if(data.after_seat_status=='free'&&data.before_seat_status=='free')
                        {
                            $.ajax({
                                type:'POST',
                                url:"{{ route('save-booking') }}",
                                data:{from_station:from_station,to_station:to_station,sdate:sdate,compartment_id:compartment_id,train_id:train_id,seat:seat},
                                success:function(data){
                                    if(data.saved_status =='success')
                                    {
                                        $("#compartment_number").val("");
                                        $("#train_id").val("");
                                        $("#seats").css('display','none');
                                        $("#book_train").css('display','none');
                                        $("#from_station").val("");
                                        $("#to_station").val("");
                                        $("#travel_date").val("");
                                        alert("Booked!!");
                                    } else {
                                        alert("Something went wrong!!");
                                    }
                                    
                                }
                            });
                        } else {
                            alert("You cannot book that seat due to covid restriction. Plesae select another. Sorry for the inconvenience!!");
                        }
                    } else {
                        alert("Seat no."+seat+" already booked on this slot!!");
                    }
                    
                }
            });
    }
    
</script>  
