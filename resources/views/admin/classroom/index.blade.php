@extends('admin.index')
@section('title', 'Elearning | Classroom')
@section('body-content')
<div class="p-4 lg:px-6 mt-2">
    <h1 class="text-2xl font-bold">Classroom</h1>
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
<div class="bg-white p-4 lg:px-6 shadow-sm shadow-gray-200">
    <h4 class="text-lg mb-2">Create new classroom</h4>
    <form action="/admin/classroom" method="post">
        @csrf
        <label for="name" class="text-sm">Name</label><br>
        <input type="text" name="name" id="name" class="border border-gray-300 w-full rounded-md py-1 px-2 mt-1"><br>
        <button type="submit"
            class="bg-blue-500 hover:bg-blue-600 duration-100 px-3 py-1 mt-5 rounded-sm text-white">Create</button>
    </form>
</div>
<div class="bg-white mt-3 lg:mt-4 shadow-sm shadow-gray-200 p-2 mx-2 lg:mx-3 rounded-md">
    @if ($data == null)
        <h4 class="text-center">No data records.</h4>
    @else
        <div class="overflow-scroll rounded-sm">
            <table class="w-full border-collapse rounded-full overflow-x-scroll">
                <tr class="bg-gray-200">
                    <th class="px-2 py-2">No</th>
                    <th>Name</th>
                    <th class="px-4">Created at</th>
                    <th class="">Option</th>
                </tr>
                @foreach ($data as $no => $classroom)
                    <tr>
                        <td class="text-center">{{ $loop->iteration + ($data->currentPage() - 1) * $data->perPage() }}</td>
                        <td class="px-2 py-3 whitespace-nowrap">{{$classroom['name']}}</td>
                        <td class="px-4 py-3 whitespace-nowrap text-center">{{$classroom['created_at']}}</td>
                        <td class="px-2 py-3">
                            <div class="flex items-center justify-center space-x-2">
                                <a href="/admin/classroom/{{$classroom['id']}}"
                                    class="text-sm font-bold whitespace-nowrap bg-blue-500 hover:bg-blue-600 duration-100 text-white px-2 py-1 rounded-sm">
                                    <i class="fa-solid fa-eye mr-1"></i>
                                    View
                                </a>
                                <a href=""
                                    class="text-sm font-bold whitespace-nowrap bg-orange-500 hover:bg-orange-600 duration-100 text-white px-2 py-1 rounded-sm">
                                    <i class="fa-solid fa-pen mr-1"></i>
                                    Edit
                                </a>
                                <form method="POST" action="/admin/classroom/{{$classroom['id']}}/delete">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit"
                                        class="text-sm font-bold whitespace-nowrap bg-red-500 hover:bg-red-600 duration-100 text-white px-2 py-1 rounded-sm">
                                        <i class="fa-solid fa-trash mr-1"></i>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="flex justify-center items-center space-x-2 mt-5">
            @if ($data->onFirstPage())
                <span class="rounded-sm text-sm border border-gray-400 text-gray-400 bg-gray-200 px-2 py-1 duration-100"><i
                        class="fa-solid fa-arrow-left-long"></i></span>
            @else
                <a href="{{$data->previousPageUrl()}}"
                    class="rounded-sm text-sm border border-black px-2 py-1 hover:bg-black hover:text-white duration-100"><i
                        class="fa-solid fa-arrow-left-long"></i></a>
            @endif
            @foreach ($data->getUrlRange(($data->currentPage()), ($data->currentPage() + 2)) as $page => $url)
                @if ($page <= $data->lastPage())
                    @if ($page == $data->currentPage())
                        <a href="{{$url}}" class="rounded-sm border-black px-3 py-1 bg-black text-white duration-100">{{ $page }}</a>
                    @else
                        <a href="{{$url}}"
                            class="rounded-sm border border-black px-3 py-1 hover:bg-black hover:text-white duration-100">{{ $page }}</a>
                    @endif
                @endif
            @endforeach
            @if ($data->hasMorePages())

                <a href="{{$data->nextPageUrl()}}"
                    class=" rounded-sm text-sm border border-black px-2 py-1 hover:bg-black hover:text-white duration-100"><i
                        class="fa-solid fa-arrow-right-long"></i></a>
            @else
                <span class="rounded-sm text-sm border border-gray-400 text-gray-400 bg-gray-200 px-2 py-1 duration-100"><i
                        class="fa-solid fa-arrow-right-long"></i></span>
            @endif
        </div>
    @endif
</div>
@endsection