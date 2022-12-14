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

    </div>
</x-app-layout>
