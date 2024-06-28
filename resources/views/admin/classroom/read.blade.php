@extends('admin.index')
@section('title', 'Elearning | Classroom')
@section('body-content')
@if(session('msg'))
    <div class="p-4 m-3 lg:mx-4 bg-green-300 rounded-md">
        {{session('msg')}}
    </div>
@elseif(session('error'))
    <div class="p-4 m-3 lg:mx-4 bg-red-300 rounded-md">
        {{session('error')}}
    </div>
@endif
<div class="bg-white p-4 lg:px-6 shadow-sm shadow-gray-200 mt-2">
    <h1 class="text-2xl">{{$data['name']}}</h1>
    <h4 class="text-gray-500">Created at {{$data['created_at']}}</h4>
    <div class="mt-3">
        <form action="/admin/classroom/{{$data['id']}}/delete" method="post">
            @method('DELETE')
            @csrf
            <button type="submit" class="text-sm text-gray-400 hover:text-red-500">
                Delete this item from database
            </button>
        </form>
    </div>
</div>
<div class="grid grid-rows-2 mx-2 lg:grid-cols-2 lg:grid-rows-1 lg:mx-3 lg:gap-x-2">
    <div class="bg-white mt-3 lg:mt-4 shadow-sm shadow-gray-200 p-4 rounded-md">
        <h4 class="text-xl mb-3">Create new assignment</h4>
        <form action="/admin/assignment/form" method="POST">
            @csrf
            <input type="hidden" name="classroom_id" value="{{$data['id']}}">
            <div class="grid grid-cols-2 gap-x-2 mt-5 mb-4">
                <div class=" overflow-hidden">
                    <label for="title" class="text-gray-600">Title</label><br>
                    <input type="text" name="title" id="title" class="border border-gray-300 focus:border-black focus:outline-none rounded-sm px-2 py-1 w-full mb-3"><br>
                    <label for="expired" class="text-gray-600">Will expire at</label><br>
                    <input type="datetime-local" name="expired" id="expired" class="border border-gray-300 focus:border-black focus:outline-none rounded-sm px-2 py-1 w-full">
                </div>
                <div class="overflow-hidden">
                    <label for="number" class="text-gray-600">Number of question</label><br>
                    <input type="number" name="numberOfQuestion" id="number" class="border border-gray-300 focus:outline-none focus:border-black rounded-sm px-2 py-1 w-full">
                </div>
            </div>
            <button type="submit" class="bg-blue-500 text-white hover:bg-blue-600 px-3 py-1 rounded-sm duration-150">Create</button>
        </form>
    </div>
    <div class="bg-white mt-3 lg:mt-4 shadow-sm shadow-gray-200 p-4 rounded-md">
    <h4 class="text-xl mb-4">Latest assignments</h4>
    @if ($assignment == false)
        <h4>No assignment on this classroom.</h4>
    @else
    <div class="grid grid-rows-3 mt-5 gap-y-2 w-full">
        @foreach ($assignment->sortByDesc('id')->take(3) as $list)
                <a href="#" class="block w-full overflow-hidden border border-gray-300 p-2 rounded-md shadow-sm shadow-gray-200 hover:border-blue-500 hover:shadow-blue-500 duration-150">
                    <h3 class="text-lg truncate">
                        {{$list['title']}}
                    </h3>
                </a>
                @endforeach
            </div>
    @endif
    </div>
</div>
@include('components.table1')

@endsection