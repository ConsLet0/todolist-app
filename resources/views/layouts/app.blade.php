<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Todo List App') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
    <!-- MDB -->
    <link rel="stylesheet" href="{{asset('css/bootstrap-to-do-list.min.css')}}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Todo List App') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <p class="small mb-0">
                    <i class="fas fa-info-circle me-2" title="Current Date and Time"></i>
                    {{ now()->timezone('Asia/Jakarta')->format('l, jS M Y, H:i') }}
                </p>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script>
        function updateTime() {
            const options = {
                weekday: 'long',
                year: 'numeric',
                month: 'short',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                hour12: false,
                timeZone: 'Asia/Jakarta'
            };
            const now = new Date().toLocaleString('en-US', options);
            document.getElementById('currentDateTime').textContent = now;
        }

        setInterval(updateTime, 1000); 
        updateTime();
    </script>
    <script>
        function confirmDelete() {
            return confirm('Apakah Anda yakin ingin menghapus kategori ini?');
        }

        function editCategory(id) {
            document.getElementById('categoryInput-' + id).style.display = 'inline';
            document.getElementById('saveButton-' + id).style.display = 'inline';
            document.getElementById('categoryName-' + id).style.display = 'none';

            const editButton = document.querySelector(`button[onclick="editCategory(${id})"]`);
            if (editButton) {
                editButton.style.display = 'none';
            }
        }

        function resetEditButton(id) {
            document.getElementById('categoryInput-' + id).style.display = 'none';
            document.getElementById('saveButton-' + id).style.display = 'none';
            document.getElementById('categoryName-' + id).style.display = 'inline';

            const editButton = document.querySelector(`button[onclick="editCategory(${id})"]`);
            if (editButton) {
                editButton.style.display = 'inline';
            }
        }

        document.getElementById('due_date').addEventListener('input', function(e) {
            let input = e.target.value;
            input = input.replace(/\D/g, '');

            if (input.length === 4) {
                let hours = input.substring(0, 2);
                let minutes = input.substring(2, 4);

                e.target.value = `${hours}:${minutes}`;
            }

            const messageElement = document.getElementById('validation-message');
            if (!/^(?:[01]\d|2[0-3]):[0-5]\d$/.test(e.target.value) && e.target.value.length > 0) {
                messageElement.textContent = 'Format waktu tidak valid! Harap masukkan dalam format HH:MM (contoh: 14:30)';
            } else {
                messageElement.textContent = '';
            }
        });

        function toggleTodo(todoId, isChecked) {
            const title = document.getElementById(`todoTitle_${todoId}`);
            const editButton = document.querySelector(`a[data-mdb-toggle="tooltip"][title="Edit todo"]`);

            if (isChecked) {
                title.style.textDecoration = "line-through";
                editButton.classList.add('disabled');
            } else {
                title.style.textDecoration = "none";
                editButton.classList.remove('disabled');
            }
        }

        function editTodo(todoId) {
            // Show input fields for title and due date
            document.getElementById(`todoTitle_${todoId}`).classList.add('d-none');
            document.getElementById(`todoTitleInput_${todoId}`).classList.remove('d-none');

            const dueDateSpan = document.getElementById(`todoDueDate_${todoId}`);
            dueDateSpan.classList.add('d-none');
            document.getElementById(`todoDueDateInput_${todoId}`).classList.remove('d-none');

            // Show save button
            document.getElementById(`saveBtn_${todoId}`).classList.remove('d-none');
        }

        function saveTodo(todoId) {
            const title = document.getElementById(`todoTitleInput_${todoId}`).value;
            const dueDate = document.getElementById(`todoDueDateInput_${todoId}`).value; 


            fetch(`/todos/${todoId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        title: title,
                        due_date: dueDate 
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById(`todoTitle_${todoId}`).innerText = title;
                        document.getElementById(`todoDueDate_${todoId}`).innerText = dueDate;

                        document.getElementById(`todoTitleInput_${todoId}`).classList.add('d-none');
                        document.getElementById(`todoDueDateInput_${todoId}`).classList.add('d-none');
                        document.getElementById(`todoTitle_${todoId}`).classList.remove('d-none');
                        document.getElementById(`todoDueDate_${todoId}`).classList.remove('d-none');

                        document.getElementById(`saveBtn_${todoId}`).classList.add('d-none');
                    } else {
                        alert('Failed to update todo!');
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        function confirmDelete() {
            return confirm('Apakah anda yakin ingin menghapus task ini ?');
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{asset('js/mdb.min.js')}}"></script>
    <!-- Custom scripts -->
    <script type="text/javascript"></script>
</body>

</html>