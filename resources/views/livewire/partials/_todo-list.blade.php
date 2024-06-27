 <div id="todos-list">

     @foreach ($todos as $todo)
         @include('livewire.partials._todo-card')
     @endforeach

     <div class="my-2">
         {{ $todos->links(data: ['scrollTo' => '#search-box']) }}
     </div>
 </div>
