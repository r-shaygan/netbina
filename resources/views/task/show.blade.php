<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ "Task: $task->title"  }}
        </h2>
    </x-slot>

    <div class="w-3/4 mx-auto rounded shadow mt-8 p-8 bg-white">
        <div class="mt-8">
            <span class="w-1/4 text-blue-900 font-bold">title:</span>
            <span>{{$task->title}}</span>
        </div>
        <div class="mt-8">
            <span class="w-1/4 text-blue-900 font-bold">deadline:</span>
            <span>{{$task->deadline}}</span>
        </div>
        <div class="mt-8">
            <span class="w-1/4 text-blue-900 font-bold">description:</span>
            <span>{{$task->description}}</span>
        </div>
        <div class="mt-8">
            <span class="w-1/4 text-blue-900 font-bold">assigner:</span>
            <span>{{$task->assignerUser->name}}</span>
        </div>
        <div class="mt-8">
            <span class="w-1/4 text-blue-900 font-bold">Created by:</span>
            <span>{{$task->ownerUser->name}}</span>
        </div>

        @php
            /**
           * @var $task \App\Models\Task
           * @var $user \App\Models\User
            */
        @endphp

        @if($task->isPending())

            <a href="{{route('tasks.accept',[$task->id])}}"
               class="text-white inline-block mt-16 text-lg px-8 py-2 bg-green-700 rounded">confirm</a>

            <div class="my-8 text-2xl font-bold">OR</div>

            <form action="{{route('tasks.assign',[$task->id])}}" method="post">
                @csrf
                <label class="text-lg align-middle">assign to:</label>
                <select class="ml-4 rounded"  name="assigned">
                    @foreach($users as $user)
                        @continue($user==auth()->user())
                        <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
                <button type="submit" class="bg-cyan-600 text-white py-2 px-4 rounded">submit</button>
            </form>
        @endif
    </div>
</x-app-layout>
