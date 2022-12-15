<x-app-layout>
    <div class="w-3/4 shadow-lg rounded mx-auto mt-4 bg-white px-4 py-12">
        <form action="{{route('tasks.update',['task'=>$task->id])}}" method="post" >
            @csrf
            @method('PUT')
            <div class="mt-12 mb-8">
                <label class="inline-block w-1/4">title:</label>
                <input  value="{{$task->title}}" name="title" class="inline-block w-1/2 py-2 h-8 rounded outline-none border">
                @error('title') <div class="my-2 text-red-500 ">{{$message}}</div> @enderror
            </div>
            <div class="my-8">
                <label class="inline-block w-1/4">description: </label>
                <textarea name="description"
                          class="inline-block w-1/2 py-2 h-16 align-middle  rounded outline-none border">{{$task->description}}</textarea>
                @error('description') <div class="my-2 text-red-500 ">{{$message}}</div> @enderror
            </div>
            <div class="my-8">
                <label class="inline-block  w-1/4">deadline</label>
                <input name="deadline" value="{{$task->deadline}}" class="inline-block w-1/5 py-2 h-8 rounded outline-none border">
                @error('deadline') <div class="my-2 text-red-500 ">{{$message}}</div> @enderror
            </div>

            <div class="my-8">
                <span class="w-1/4 inline-block">This task assigned to: </span>
                <span>{{$task->ownerUser->name}}</span>
            </div>
            @if($task->isPending())
            <button type="submit" class="mt-16 bg-blue-700 text-white py-4 px-12 text-center mx-auto block">Edit </button>
            @endif
        </form>
        @if($task->isPending())
        <form action="{{route('tasks.destroy',['task'=>$task->id])}}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="mt-16 bg-red-700 text-white py-4 px-12 text-center mx-auto block">Delete</button>
        </form>
        @endif
    </div>
</x-app-layout>
