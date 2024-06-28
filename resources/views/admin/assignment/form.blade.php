@extends('admin.index')
@section('title', 'Elearning | Create new assignment')
@section('body-content')
@include('components.header1')
<form action="/admin/assignment" method="POST">
    @csrf
    <input type="hidden" name="classroom_id" value="{{$item['classroom_id']}}">
    <div class="bg-white p-4 lg:px-6 shadow-sm shadow-gray-200">
        <input type="text" name="title" id="title" value="{{$item['title']}}" class="py-1 text-xl">
        <div class="mt-5">
            <label for="expired_at">Expired at: </label>
            <input type="datetime-local" name="expired_at" id="expired_at" value="{{$item['expired']}}">
        </div>
        <h4>Number of question: {{$item['numberOfQuestion']}}</h4>
        <div class="mt-3">
            <button type="submit"
                class="px-3 py-1 text-white bg-blue-500 hover:bg-blue-600 rounded-sm duration-150">Submit</button>
        </div>
    </div>
    @for ($i = 0; $i < $item['numberOfQuestion']; $i++)
        <div class="bg-white my-3 lg:mt-4 shadow-sm shadow-gray-200 p-2 mx-2 lg:mx-3 rounded-md">
            <div class="relative p-1">
                <span>
                    {{($i + 1)}} / {{$item['numberOfQuestion']}}
                </span>
                <div class="absolute right-1 top-1">
                    <label for="point" class="text-gray-600">Point</label>
                    <input type="text" name="point[]" id="point" value="5" class="text-center w-8 border-b border-black">
                </div>
            </div>
            <div class="mt-3 mb-8">
                <textarea name="question[]" id="question" rows="8"
                    class="w-full focus:outline-none focus:border-black border border-gray-400 rounded-sm px-2 py-1"
                    required></textarea>
            </div>
            <div class="mb-2">
                <select name="type[]" id="{{$i}}_type" onChange="changeType({{$i}})"
                    class="border border-gray-400 w-full lg:w-2/12 px-2 py-1 bg-transparent rounded-sm">
                    <option value="mcq" selected>Multiple-choice</option>
                    <option value="essay">Essay</option>
                </select>
            </div>
            <div class="grid grid-rows-4 gap-y-2">
                <div>
                    <input type="text" name="options1[]" id="{{$i}}_option1"
                        class="w-full focus:outline-none focus:border-black border border-gray-400 rounded-sm px-2 py-1 duration-150">
                </div>
                <div>
                    <input type="text" name="options2[]" id="{{$i}}_option2"
                        class="w-full focus:outline-none focus:border-black border border-gray-400 rounded-sm px-2 py-1 duration-150">
                </div>
                <div>
                    <input type="text" name="options3[]" id="{{$i}}_option3"
                        class="w-full focus:outline-none focus:border-black border border-gray-400 rounded-sm px-2 py-1 duration-150">
                </div>
                <div>
                    <input type="text" name="correctAnswer[]" id="{{$i}}_correctAnswer"
                        class="w-full focus:outline-none focus:border-black border border-gray-400 rounded-sm px-2 py-1 duration-150"
                        placeholder="Correct Answer">
                </div>
            </div>
        </div>
    @endfor

</form>
<script src="/assets/js/formCreateAssignment.js"></script>
@endsection