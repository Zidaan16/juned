@extends('admin.index')
@section('title', 'Elearning | Assignments')
@section('body-content')
    @include('components.header1')
    <div class="bg-white mt-3 lg:mt-4 shadow-sm shadow-gray-200 p-4 rounded-md">
        <h4 class="text-xl mb-3">Create new assignment</h4>
        <form action="/admin/assignment/form" method="POST">
            @csrf
            <div class="grid grid-cols-2 gap-x-2 mt-5 mb-4">
                <div class="overflow-hidden">
                    <label for="title" class="text-gray-600">Title</label><br>
                    <input type="text" name="title" id="title" class="border border-gray-300 focus:border-black focus:outline-none rounded-sm px-2 py-1 w-full mb-3"><br>
                    <label for="expired" class="text-gray-600">Will expire at</label><br>
                    <input type="datetime-local" name="expired" id="expired" class="border border-gray-300 focus:border-black focus:outline-none rounded-sm px-2 py-1 w-full">
                </div>
                <div class="overflow-hidden">
                    <label for="classroom_id" class="text-gray-600">Classroom</label><br>
                    <select name="classroom_id" id="classroom_id" class="bg-transparent border border-gray-300 focus:border-black focus:outline-none rounded-sm px-2 w-full mb-3" style="padding-top: 6px; padding-bottom: 6px;">
                        <option value="all">All</option>
                        @foreach ($classroom as $classlist)
                            <option value="{{$classlist['id']}}">{{$classlist['name']}}</option>
                        @endforeach
                    </select><br>
                    <label for="number" class="text-gray-600">Number of question</label><br>
                    <input type="number" name="numberOfQuestion" id="number" class="border border-gray-300 focus:outline-none focus:border-black rounded-sm px-2 py-1 w-full">
                </div>
            </div>
            <button type="submit" class="bg-blue-500 text-white hover:bg-blue-600 px-3 py-1 rounded-sm duration-150">Create</button>
        </form>
    </div>
    <div class="bg-white mt-3 lg:mt-4 shadow-sm shadow-gray-200 p-2 mx-2 lg:mx-3 rounded-md">
    <div class="overflow-scroll rounded-sm">
        <table class="border-collapse rounded-full overflow-x-scroll lg:w-full" width="300%">
            <colgroup>
                <col width="5%">
                <col width="25%">
                <col width="10%">
                <col width="18%">
                <col width="18%">
                <col width="18%">
                <col width="20%">
            </colgroup>
            <tr class="bg-gray-200 text-left">
                <th class="px-2 py-2">No</th>
                <th class="px-2">Classroom</th>
                <th class="px-2">Title</th>
                <th class="px-2">Question</th>
                <th class="px-2">Status</th>
                <th class="px-2">Expired at</th>
                <th class="px-2">Created at</th>
                <th class="px-2">Updated at</th>
                <th class="px-2">Options</th>
            </tr>
            @foreach ($item as $assignment)
                <tr>
                    <td class="text-center">
                        {{ $loop->iteration + ($item->currentPage() - 1) * $item->perPage() }}
                    </td>
                    <td class="px-2 py-3 whitespace-nowrap">{{$assignment->classroom->name}}</td>
                    <td class="px-2 py-3 whitespace-nowrap">{{$assignment['title']}}</td>
                    <td class="px-2 py-3 whitespace-nowrap">{{$assignment['number_of_question']}}</td>
                    <td class="px-2 py-3 whitespace-nowrap">
                        @if ($assignment['status'])
                        <span class="text-red-600">Expired</span>
                        @else
                        <span class="text-green-600">Active</span>
                        @endif
                    </td>
                    <td class="px-2 py-3 whitespace-nowrap">{{$assignment['expired_at']}}</td>
                    <td class="px-2 py-3 whitespace-nowrap">{{$assignment['created_at']}}</td>
                    <td class="px-2 py-3 whitespace-nowrap">{{$assignment['updated_at']}}</td>
                    <td class="px-2 py-3">
                        <div class="flex items-center justify-center space-x-2">
                            @if ($assignment['status'])
                                <a href="#"
                                    class="text-sm font-bold whitespace-nowrap bg-blue-500 hover:bg-blue-600 duration-100 text-white px-2 py-1 rounded-sm">
                                    <i class="fa-regular fa-clock mr-1"></i>
                                    Pending
                                </a>
                            @else
                                <a href="#"
                                    class="text-sm font-bold whitespace-nowrap bg-green-500 hover:bg-green-600 duration-100 text-white px-2 py-1 rounded-sm">
                                    <i class="fa-solid fa-check mr-1"></i>
                                    Accept
                                </a>
                            @endif
                            <a href=""
                                class="text-sm font-bold whitespace-nowrap bg-orange-500 hover:bg-orange-600 duration-100 text-white px-2 py-1 rounded-sm">
                                <i class="fa-solid fa-pen mr-1"></i>
                                Edit
                            </a>
                            <form method="POST" action="/admin/classroom/{{$assignment['id']}}/delete">
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
        @if ($item->onFirstPage())
            <span class="rounded-sm text-sm border border-gray-400 text-gray-400 bg-gray-200 px-2 py-1 duration-100"><i
                    class="fa-solid fa-arrow-left-long"></i></span>
        @else
            <a href="{{$item->previousPageUrl()}}"
                class="rounded-sm text-sm border border-black px-2 py-1 hover:bg-black hover:text-white duration-100"><i
                    class="fa-solid fa-arrow-left-long"></i></a>
        @endif
        @foreach ($item->getUrlRange(($item->currentPage()), ($item->currentPage() + 2)) as $page => $url)
            @if ($page <= $item->lastPage())
                @if ($page == $item->currentPage())
                    <a href="{{$url}}" class="rounded-sm border-black px-3 py-1 bg-black text-white duration-100">{{ $page }}</a>
                @else
                    <a href="{{$url}}"
                        class="rounded-sm border border-black px-3 py-1 hover:bg-black hover:text-white duration-100">{{ $page }}</a>
                @endif
            @endif
        @endforeach
        @if ($item->hasMorePages())

            <a href="{{$item->nextPageUrl()}}"
                class=" rounded-sm text-sm border border-black px-2 py-1 hover:bg-black hover:text-white duration-100">
                <i class="fa-solid fa-arrow-right-long"></i></a>
        @else
            <span class="rounded-sm text-sm border border-gray-400 text-gray-400 bg-gray-200 px-2 py-1 duration-100"><i
                    class="fa-solid fa-arrow-right-long"></i></span>
        @endif
    </div>
</div>
@endsection