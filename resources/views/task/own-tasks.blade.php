<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ "Tasks"  }}
        </h2>
    </x-slot>

    <table class="w-2/3 border-collapse shadow-lg text-sm rounded-lg bg-white my-16 mx-auto ">
        <thead>
        <tr class="border-b-4">
            <th class="py-5 px-2 mb-4">#</th>
            <th class="py-5 px-2 mb-4">title</th>
            <th class="py-5 px-2 mb-4">description</th>
            <th class="py-5 px-2 mb-4">deadline</th>
            <th class="py-5 px-2 mb-4">detail</th>
            <th class="py-5 px-2 mb-4">status</th>
        </tr>
        </thead>
        <tbody class="py-8 mt-32">
        @php
            /**
             * @var $task \App\Models\Task
             *
             */
        @endphp
        @foreach($tasks as $key=>$task)
            <tr class="border-b text-center @if($task->isDelayed()) bg-red-200  border-red-600  @endif">
                <td class="py-4 px-2 text-gray-500">{{$key+1}}</td>
                <td class="py-4 px-2 text-gray-500">{{$task->title}}</td>
                <td class="py-4 px-2 text-gray-500">{{\Illuminate\Support\Str::limit($task->description,15)}}</td>
                <td class="py-4 px-2 text-gray-500">{{$task->deadline}}</td>
                <td class="py-4 px-2 text-cyan-900"><a href="{{route('tasks.edit',[$task->id])}}"><i class="material-icons text-cyan-400" style="font-size:18px;">mode_edit</i></a></td>
                @if($task->isPending())
                    <td class="text-orange-400 text-center">PENDING...</td>
                @elseif($task->isAccepted())
                    <td><i class="material-icons text-green-500" style="font-size:20px;">check_circle</i></td>
                @else
                    <td><i class="material-icons" style="font-size:20px;color:red">alarm_off</i></td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>

</x-app-layout>
