<x-app-layout>
    <div class="w-3/4 shadow-lg rounded mx-auto mt-4 bg-white px-4 py-12">
        <form action="{{route('tasks.store')}}" method="post" >
            @csrf
            <div class="mt-12 mb-8">
                <label class="inline-block w-1/4">title:</label>
                <input  value="{{old('title')}}" name="title" class="inline-block w-1/2 py-2 h-8 rounded outline-none border">
                @error('title') <div class="my-2 text-red-500 ">{{$message}}</div> @enderror
            </div>
            <div class="my-8">
                <label class="inline-block w-1/4">description: </label>
                <textarea name="description"
                          class="inline-block w-1/2 py-2 h-16 align-middle  rounded outline-none border">{{old('description')}}</textarea>
                @error('description') <div class="my-2 text-red-500 ">{{$message}}</div> @enderror
            </div>
            <div class="my-8">
                <label class="inline-block  w-1/4">deadline</label>
                <input type="datetime-local" name="deadline" class="inline-block w-1/5 py-2 h-8 rounded outline-none border">
                @error('deadline') <div class="my-2 text-red-500 ">{{$message}}</div> @enderror

            </div>
            <div class="my-16">
                <label class="w-1/4 inline-block my-3">assign to:</label>
                <select name="assigned">
                    @foreach($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
                @error('assigned') <div class="my-2 text-red-500">{{$message}}</div> @enderror
            </div>
            <button type="submit" class="mt-16 bg-gray-600 text-white py-4 px-12 text-center mx-auto block">submit</button>
        </form>
    </div>
</x-app-layout>
