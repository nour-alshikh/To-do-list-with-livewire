<?php

namespace App\Livewire;

use App\Models\Todo;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class TodoList extends Component
{

    use WithPagination;

    #[Rule('required|min:3|max:50')]
    public $name;

    public $search;

    public $editingId;

    #[Rule('required|min:3|max:50')]
    public $editingName;

    public function create()
    {
        // validate input
        $validated = $this->validateOnly('name');

        // create Todo
        Todo::create($validated);

        // reset input
        $this->reset('name');

        // success message
        session()->flash('success', 'Todo created successfully');

        // reset page to go to the first page
        $this->resetPage();
    }

    public function toggleCompleted($todoId)
    {
        $todo =  Todo::findOrFail($todoId);
        $todo->completed = !$todo->completed;
        $todo->save();
    }

    public function edit($todoId)
    {
        $this->editingId = $todoId;
        $this->editingName = Todo::findOrFail($todoId)->name;
    }

    public function cancelEdit()
    {
        $this->reset('editingId', 'editingName');
    }

    public function update()
    {
        // validate input
        $validated = $this->validateOnly('editingName');

        // create Todo
        Todo::findOrFail($this->editingId)->update([
            'name' => $validated['editingName']
        ]);

        // cancel edit
        $this->cancelEdit();

        // success message
        // session()->flash('success_update', 'Todo updated successfully');
    }

    public function delete($todoId)
    {
        try {
            Todo::findOrFail($todoId)->delete();
        } catch (\Exception $e) {
            session()->flash('error', 'Can not delete Todo');
            return;
        }
    }

    public function render()
    {
        return view('livewire.todo-list', [
            'todos' => Todo::latest()->where("name", 'like', "%{$this->search}%")->paginate(5)
        ]);
    }
}
