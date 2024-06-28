<div class="p-4 lg:px-6 mt-2">
    <h1 class="text-2xl font-bold">{{$title}}</h1>
</div>
@if(session('msg'))
    <div class="p-4 m-3 lg:mx-4 bg-green-300 rounded-md">
        {{session('msg')}}
    </div>
@elseif(session('error'))
    <div class="p-4 m-3 lg:mx-4 bg-red-300 rounded-md">
        {{session('error')}}
    </div>
@endif