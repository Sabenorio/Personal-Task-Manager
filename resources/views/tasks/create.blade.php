<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Task | TaskFlow</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f4f6f8;
            color: #222;
        }

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 230px;
            height: 100vh;
            background: #1f2937;
            padding: 30px 20px;
            color: white;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 40px;
        }

        .menu {
            display: block;
            text-decoration: none;
            color: #d1d5db;
            padding: 13px 15px;
            margin-bottom: 8px;
            border-radius: 8px;
        }

        .menu:hover,
        .menu.active {
            background: #374151;
            color: white;
        }

        .main {
            margin-left: 230px;
            padding: 50px;
        }

        .back {
            text-decoration: none;
            color: #2563eb;
        }

        .title {
            margin: 25px 0;
        }

        .title h1 {
            font-size: 30px;
        }

        .title p {
            color: #777;
            margin-top: 6px;
        }

        .form-card {
            background: white;
            max-width: 700px;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .field {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 13px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 15px;
        }

        textarea {
            height: 130px;
            resize: vertical;
        }

        .buttons {
            margin-top: 25px;
        }

        .save {
            border: none;
            background: #2563eb;
            color: white;
            padding: 13px 22px;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
        }

        .cancel {
            margin-left: 15px;
            color: #777;
            text-decoration: none;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        @media (max-width: 700px) {
            .sidebar {
                display: none;
            }

            .main {
                margin-left: 0;
                padding: 25px;
            }
        }
    </style>
</head>

<body>

    <aside class="sidebar">

        <div class="logo">
            TaskFlow
        </div>

        <a href="/tasks" class="menu">
            Dashboard
        </a>

        <a href="/tasks/create" class="menu active">
            Add Task
        </a>

    </aside>

    <main class="main">

        <a href="/tasks" class="back">
            ← Back to Dashboard
        </a>

        <div class="title">

            <h1>Create a Task</h1>

            <p>
                Add a new task to your task list.
            </p>

        </div>

        <div class="form-card">

            @if ($errors->any())

                <div class="error">

                    Please check the information you entered.

                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>

                </div>

            @endif

            <form action="/tasks" method="POST">

                @csrf

                <div class="field">

                    <label for="task_name">
                        Task Name
                    </label>

                    <input
                        type="text"
                        id="task_name"
                        name="task_name"
                        value="{{ old('task_name') }}"
                        placeholder="Enter task name"
                        required
                    >

                </div>

                <div class="field">

                    <label for="description">
                        Description
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        placeholder="Describe your task..."
                    >{{ old('description') }}</textarea>

                </div>

                <div class="field">

                    <label for="status">
                        Status
                    </label>

                    <select id="status" name="status">

                        <option value="Pending">
                            Pending
                        </option>

                        <option value="Completed">
                            Completed
                        </option>

                    </select>

                </div>

                <div class="field">

                    <label for="due_date">
                        Due Date
                    </label>

                    <input
                        type="date"
                        id="due_date"
                        name="due_date"
                        value="{{ old('due_date') }}"
                    >

                </div>

                <div class="buttons">

                    <button type="submit" class="save">
                        Save Task
                    </button>

                    <a href="/tasks" class="cancel">
                        Cancel
                    </a>

                </div>

            </form>

        </div>

    </main>

</body>

</html>