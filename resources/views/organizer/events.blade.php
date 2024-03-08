
@extends('layouts.master')
@section('content')

        <h1 class="text-3xl text-black pb-6">Tabbed Events</h1>

        

        <div class="w-full mt-6" x-data="{ openTab: 1 }">
            <div>
                <ul class="flex border-b">
                    @foreach($events as $event)
                    <li class="-mb-px mr-1" @click="openTab = {{$event->id}}">
                        <a :class="openTab === {{$event->id}} ? 'border-l border-t border-r rounded-t text-blue-700 font-semibold' : 'text-blue-500 hover:text-blue-800'" class="bg-white inline-block py-2 px-4 font-semibold" href="#">{{$event->title}}</a>
                    </li>
                    @endforeach
                    <li class="mr-1">   
                          <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                            <i class="fas fa-plus mr-2"></i>
                            </button>
                    </li>
                </ul>
            </div>
            
            <div class="bg-white p-6">
                @foreach($events as $event)
                <div id="" class="" x-show="openTab === {{$event->id}}">
                    <a href="#" class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-full hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                        <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg" src="{{$event->getFirstMediaUrl('events')}}" alt="image">
                        <div class="flex flex-col justify-between p-4 leading-normal">
                            <h5 class="mb-1 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$event->title}}  {{$event->event_date}}</h5>
                            <p class="mb-3 flex flex-wrap flex-row font-medium text-gray-400 dark:text-gray-400">
                                <span class="mr-10">{{$event->category->name}}</span>
                                <span class="mr-1"><i class="fas fa-map-marker-alt mr-1"></i> {{$event->location}}</span>
                                {{-- <span class=""></span> --}}
                            </p>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{$event->description}}</p>
                            <p class="mb-3 flex flex-wrap flex-row font-medium text-gray-400 dark:text-gray-400">
                                <span class="mr-10">Total Tickets : {{$event->total_Tickets}}</span>
                                <span class="">available Tickets : {{$event->total_Tickets}}</span>
                            </p>
                            <p class="mb-3 flex flex-wrap flex-row font-medium text-gray-400 dark:text-gray-400">
                                {{$event->created_at}} 
                            </p>
                        </div>
                    </a>
                    <form class="" method="post" action="{{route('events.destroy',['event'=>$event])}}">
                        @csrf
                        @method('delete')
                        <button type="submit" class="text-red-500 hover:text-red-700">
                         <i class="fas fa-trash-alt"></i>
                       </button>
                     </form>

                     <button data-modal-target="update-modal" 
                            data-modal-toggle="update-modal" 
                            class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" 
                            type="button"
                            onclick="openUpdateModal({{ $event->id }}, '{{ $event->title }}', '{{ $event->event_date }}', '{{ $event->location }}', '{{ $event->total_Tickets }}', '{{ $event->category_id }}', '{{ $event->description }}')"
                    >
                        <i class="fas fa-edit"></i>
                    </button>
                </div>
                @endforeach
            </div>
            
        </div>




   <!-- Update Event Modal -->
   <div id="update-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <!-- Modal content -->
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Update Event
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="update-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form class="p-4 md:p-5" method="post" action="{{route('events.update',['event' => $event->id])}}" enctype="multipart/form-data">
                @csrf
                @method('put')
                <!-- Populate the form fields with event data here -->
                <input type="hidden" id="event-id" name="event_id">
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <!-- Populate form fields with event data using JavaScript -->
                </div>
                <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                    Update Event
                </button>
            </form>
        </div>
    </div>
</div> 
        


        {{-- modal add event --}}



  
  <!-- Main modal -->
  <div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
      <div class="relative p-4 w-full max-w-md max-h-full">
          <!-- Modal content -->
          <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
              <!-- Modal header -->
              <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                  <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                      Create New Product
                  </h3>
                  <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                      </svg>
                      <span class="sr-only">Close modal</span>
                  </button>
              </div>
              <!-- Modal body -->
              <form class="p-4 md:p-5" method="post" action="{{route('events.store')}}" enctype="multipart/form-data">
                @csrf
                @method('post')
                  <div class="grid gap-4 mb-4 grid-cols-2">
                      <div class="col-span-2">
                          <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                          <input type="text" name="title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type event title" required="">
                      </div>
                      <div class="col-span-2 sm:col-span-1">
                          <label for="event_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">event's date</label>
                          <input type="date" name="event_date" id="event_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                      </div>
                      <div class="col-span-2 sm:col-span-1">
                          <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                          <select name="category_id" id="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                              <option selected="">Select category</option>
                              @foreach($categories as $category)
                              <option value="{{$category->id}}">{{$category->name}}</option>
                              @endforeach
                          </select>
                      </div>
                      <div class="col-span-2 sm:col-span-1">
                        <label for="total_Tickets" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">total Tickets</label>
                        <input type="number" name="total_Tickets" id="total_Tickets" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="50 Tickets" required="">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="location" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Event's location</label>
                        <input type="text" name="location" id="location" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Write the location of the event" required="">
                    </div>
                    <div class="col-span-2 flex">
                        <div class="pr-2">
                            <input class="" name="automatique" type="checkbox" />
                          </div>
                          <p class="pt-1">I want to reserve automatique</p>
                        </div>
                        <div class="flex col-span-2 cursor-pointer">
                            <input class="" type="file" name="image" id="image" accept="image/*" multiple="false">
                        </div>
                    </div>
                      <div class="col-span-2">
                          <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Event Description</label>
                          <textarea name="description" id="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write event description here"></textarea>                    
                      </div>
                  </div>
                  <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                      <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                      Add new event
                  </button>
              </form>
          </div>
      </div>
  </div> 
  
  {{-- 'title',
        'description',
        'accepted',
        'location',
        'total_Tickets',
        
        'event_date',
        'category_id',
         --}}


         <script>
            function openUpdateModal(eventId, title, eventDate, location, totalTickets, categoryId, description) {
                document.getElementById('event-id').value = eventId;
                // Populate the form fields with event data
                document.getElementById('title').value = title;
                document.getElementById('event_date').value = eventDate;
                document.getElementById('location').value = location;
                document.getElementById('total_Tickets').value = totalTickets;
                document.getElementById('category').value = categoryId;
                document.getElementById('description').value = description;
    
                // Toggle the update modal
                document.querySelector('[data-modal-target="update-modal"]').click();
            }
        </script>
        
@endsection
 