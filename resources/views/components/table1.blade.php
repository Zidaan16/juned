<div class="bg-white mt-3 lg:mt-4 shadow-sm shadow-gray-200 p-2 mx-2 lg:mx-3 rounded-md">
    <div class="overflow-scroll rounded-sm">
        <table class="border-collapse rounded-full overflow-x-scroll lg:w-full" width="225%">
            <colgroup>
                <col width="5%">
                <col width="25%">
                <col width="30%">
                <col width="15%">
                <col width="20%">
                <col width="12%">
                <col width="20%">
            </colgroup>
            <tr class="bg-gray-200 text-left">
                <th class="px-2 py-2">No</th>
                <th class="px-2">Email</th>
                <th class="px-2">Name</th>
                <th class="px-2">Classroom</th>
                <th class="px-2">Created at</th>
                <th class="px-2">Status</th>
                <th class="px-2">Options</th>
            </tr>
            @foreach ($item as $user)
                <tr>
                    <td class="text-center">{{ $loop->iteration + ($item->currentPage() - 1) * $item->perPage() }}
                    </td>
                    <td class="px-2 py-3 whitespace-nowrap">{{$user['email']}}</td>
                    <td class="px-2 py-3 whitespace-nowrap">{{$user['name']}}</td>
                    <td class="px-2 py-3 whitespace-nowrap">{{$user->classroom->name}}</td>
                    <td class="px-2 py-3 whitespace-nowrap">{{$user['created_at']}}</td>
                    <td class="px-2 py-3 whitespace-nowrap">
                        @if ($user['status'])
                            <span class="text-green-600">Active</span>
                        @else
                            <span class="text-red-600">Pending</span>
                        @endif
                    </td>
                    <td class="px-2 py-3">
                        <div class="flex items-center justify-center space-x-2">
                            @if ($user['status'])
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
                            <form method="POST" action="/admin/classroom/{{$user['id']}}/delete">
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