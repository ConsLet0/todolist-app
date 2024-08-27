@extends('layouts.app')
@section('content')
<section class="vh-10">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col">
                <div class="card" id="list1" style="border-radius: .75rem; background-color: #eff1f2;">
                    <div class="card-body py-4 px-4 px-md-5">
                        <div class="pb-2">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-row align-items-center">
                                        <form method="POST" action="{{ route('categories.store') }}">
                                            @csrf
                                            <input type="text" id="name" name="name" class="d-flex card-body form-control form-control-lg" placeholder="Add New Categories">
                                            <br>
                                            <div>
                                                <button type="submit" class="btn btn-primary">Add Category</button>
                                            </div>
                                        </form>
                                    </div>
                                    <br>
                                    @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                    @elseif (session('warning'))
                                    <div class="alert alert-warning">
                                        {{ session('warning') }}
                                    </div>
                                    @elseif (session('danger'))
                                    <div class="alert alert-danger">
                                        {{ session('danger') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@foreach($categories as $category)
<section class="vh-10">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col">
                <div class="card" id="list1" style="border-radius: .75rem; background-color: #eff1f2;">
                    <div class="card-body py-4 px-4 px-md-5">
                        <p class="h1 text-center mt-3 mb-4 pb-3 text-primary">
                            <i class="fas fa-check-square me-1"></i>
                            <u id="categoryName">{{ $category->name }}</u>
                        <div class="text-end text-muted">
                            <a class="text-muted" data-mdb-toggle="tooltip">
                                <p class="small mb-0">
                                    <i class="fas fa-info-circle me-2" title="Created date"></i>
                                    {{ $category->created_at->format('jS M Y') }}
                                </p>
                            </a>
                        </div>
                        <form id="editForm-{{ $category->id }}" action="{{ route('categories.update', $category->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin memperbarui kategori ini?') ? true : false;">
                            @csrf
                            @method('PUT')
                            <input type="text" name="name" id="categoryInput-{{ $category->id }}" value="{{ $category->name }}" style="display:none;" required>

                            <button type="button" class="text-primary" data-mdb-toggle="tooltip" style="background:none; border:none; padding:0;" onclick="editCategory(`{{ $category->id }}`)">
                                Edit Categories
                                <i class="fas fa-pencil-alt" style="width: 30px;"></i>
                            </button>

                            <button type="submit" id="saveButton-{{ $category->id }}" class="text-success" data-mdb-toggle="tooltip" style="background:none; border:none; padding:0; display:none;">Save
                                <i class="fas fa-save" style="width: 30px;"></i>
                            </button>
                        </form>

                        <form action="{{ route('categories.delete', $category->id) }}" method="POST" style="display:inline;" onsubmit="return confirmDelete();">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-danger" data-mdb-toggle="tooltip" style="background:none; border:none; padding:0;">
                                Delete Categories
                                <i class="fas fa-trash-alt" style="width: 30px;"></i>
                            </button>
                        </form>


                        <form action="{{ route('todos.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="categories_id" value="{{ $category->id }}">

                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Add new task" required>
                            </div>
                            <div class="mb-3">
                                <label for="due_date" class="form-label">Due Time (Waktu 24 Jam)</label>
                                <input type="text" class="form-control" id="due_date" name="due_date" placeholder="HH:MM" required pattern="([01][0-9]|2[0-3]):[0-5][0-9]">
                                <small class="form-text text-muted">Format: HH:MM (contoh: 14:30)</small>
                                <div id="validation-message" class="text-danger"></div>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Task</button>
                        </form>
                        @if (session('successTodos'))
                        <div class="alert alert-success">
                            {{ session('successTodos') }}
                        </div>
                        @endif
                        @foreach ($category->todos as $todo)
                        <hr class="my-4">
                        <ul class="list-group list-group-horizontal rounded-0 bg-transparent">
                            <li class="list-group-item d-flex align-items-center ps-0 pe-3 py-1 rounded-0 border-0 bg-transparent">
                                <div class="form-check">
                                    <input
                                        class="form-check-input me-0"
                                        type="checkbox"
                                        id="todo_{{ $todo->id }}"
                                        value="1"
                                        {{ $todo->is_finished ? 'checked' : '' }}
                                        onchange="toggleTodo('{{ $todo->id }}', this.checked)">
                                </div>
                            </li>
                            <li class="list-group-item px-3 py-1 d-flex align-items-center flex-grow-1 border-0 bg-transparent">
                                <p class="lead fw-normal mb-0 {{ $todo->is_finished ? 'text-decoration-line-through' : '' }}" id="todoTitle_{{ $todo->id }}">
                                    {{ $todo->title }}
                                </p>
                                <input type="text" id="todoTitleInput_{{ $todo->id }}" value="{{ $todo->title }}" class="form-control d-none" />
                            </li>
                            <li class="list-group-item px-3 py-1 d-flex align-items-center border-0 bg-transparent">
                                <div class="py-2 px-3 me-2 border border-warning rounded-3 d-flex align-items-center bg-light">
                                    <p class="small mb-0">
                                        <a data-mdb-toggle="tooltip" title="Due on time">
                                            <i class="fas fa-hourglass-half me-2 text-warning"></i>
                                        </a>
                                        <span id="todoDueDate_{{ $todo->id }}">{{ \Carbon\Carbon::createFromFormat('H:i:s', $todo->due_date)->format('H:i') }}</span>
                                        <input type="time" id="todoDueDateInput_{{ $todo->id }}" value="{{ \Carbon\Carbon::createFromFormat('H:i:s', $todo->due_date)->format('H:i') }}" class="form-control d-none" />
                                    </p>
                                </div>
                            </li>
                            <li class="list-group-item ps-3 pe-0 py-1 rounded-0 border-0 bg-transparent">
                                <div class="d-flex flex-row justify-content-end mb-1">
                                    <a class="text-info {{ $todo->is_finished ? 'disabled' : '' }}" data-mdb-toggle="tooltip" title="Edit todo" onclick="editTodo('{{ $todo->id }}')">
                                        <i class="fas fa-pencil-alt me-3"></i>
                                    </a>
                                    <form action="{{ route('todos.delete', $todo->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirmDelete()">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link text-danger p-0 m-0" data-mdb-toggle="tooltip" title="Delete todo">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                                <div class="text-end text-muted">
                                    <a class="text-muted" data-mdb-toggle="tooltip" title="Created date">
                                        <p class="small mb-0"><i class="fas fa-info-circle me-2"></i>{{ \Carbon\Carbon::parse($todo->created_at)->format('d M Y') }}</p>
                                    </a>
                                </div>
                                <button class="btn btn-success d-none" id="saveBtn_{{ $todo->id }}" onclick="saveTodo('{{ $todo->id }}')">Save</button>
                            </li>
                        </ul>
                        <hr class="my-4">
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endforeach
@endsection