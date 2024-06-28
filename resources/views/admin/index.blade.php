@extends('master')
@section('title', 'Elearning | Admin')
@section('content')
<div class="flex">
    <div class="z-10 fixed lg:relative flex-none w-3/4 lg:w-1/5">
        <div class="hidden lg:block relative h-screen px-5 py-2 bg-slate-800 text-slate-200" id="sidebar">
            <div class="relative flex items-center lg:mx-3 py-5">
                <div class="lg:hidden absolute right-0">
                    <i class="fa-solid fa-xmark text-3xl right-0 cursor-pointer" id="closeSidebarButton"></i>
                </div>
                <h1 class="text-2xl">Elearning.</h1>
            </div>
            <div class="mt-2">
                <ul class="flex flex-col">
                    <li>
                        <a href="/admin/" class="block p-3 hover:bg-slate-700 hover:text-slate-100 rounded-sm duration-150">
                            <i class="fa-solid fa-gauge mr-3"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="/admin/classroom" class="block p-3 hover:bg-slate-700 hover:text-slate-100 rounded-sm duration-150">
                            <i class="fa-solid fa-chair mr-3"></i>
                            Classroom
                        </a>
                    </li>
                    <li>
                        <a href="/admin/assignment" class="block p-3 hover:bg-slate-700 hover:text-slate-100 rounded-sm duration-150">
                            <i class="fa-solid fa-table-list mr-3"></i>
                            Assignments
                        </a>
                    </li>
                    <span class="relative block p-3 hover:bg-slate-700 hover:text-slate-100 rounded-sm duration-150 cursor-pointer"
                        id="dropdownToggleButton">
                            <i class="fa-solid fa-users mr-3"></i>
                            Students
                            <i class="fa-solid fa-caret-up absolute right-4 top-4" id="caret"></i>
                        </a>
                    </span>
                    <ul class="hidden" id="dropdownItems">
                        <li>
                            <a href="/admin/student/pending" class="block py-3 px-8 hover:bg-slate-700 hover:text-slate-100 rounded-sm duration-150">
                                <i class="fa-regular fa-clock mr-3"></i>
                                Pending
                            </a>
                        </li>
                        <li>
                            <a href="/admin/student" class="block py-3 px-8 hover:bg-slate-700 hover:text-slate-100 rounded-sm duration-150">
                                <i class="fa-solid fa-list mr-3"></i>
                                Active
                            </a>
                        </li>
                    </ul>
                </ul>
            </div>
        </div>
    </div>
    <div class="flex-auto h-screen overflow-y-scroll">
        <div class="flex px-2 py-1 bg-white text-slate-900 shadow-sm shadow-gray-200">
            <div class="w-full text-xl">
                <span class="float-left px-2 py-2 cursor-pointer lg:hidden" id="sidebarButton">
                    <i class="fa-solid fa-bars"></i>
                </span>
                <a href="/admin/logout" class="float-right px-2 py-2">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </a>
                <a href="/admin/profile" class="float-right px-2 py-2 mr-2">
                    <i class="fa-regular fa-user"></i>
                </a>
            </div>
        </div>
        @yield('body-content')
    </div>
</div>
@endsection