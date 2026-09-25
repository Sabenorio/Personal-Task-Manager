<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Task Details | TaskFlow</title>

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

        .card {
            max-width: 750px;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .task-title {
            font-size: 26px;
            margin-bottom: 12px;
        }

        .description {
            color: #777;
            line-height: 1.6;
            margin-bottom: 25px;
        }

        .info {
            border-top: 1px solid #eee;
            padding-top: 20px;
        }

        .info-row {
            margin-bottom: 18px;
        }

        .label {
            display: block;
            color: #888;
            font-size: 13px;
            margin-bottom: 5px;
        }

        .value {
            font-weight: bold;
        }

        .status {
            display: inline-block;
            padding: 7px 13px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
        }

        .pending {
            background: #fff3cd;
            color: #856404;
        }

        .completed {
            background: #d1fae5;
            color: #166534;
        }

        .actions {
            margin-top: 25px;
        }

        .edit {
            display: inline-block;
            background: #2563eb;
            color: white;
            text-decoration: none;
            padding: 12px 18px;
            border-radius: 8px;
            font-weight: bold;
        }

        .delete {
            margin-left: 10px;
            background: #dc2626;
            color: white;
            border: none;
            padding: 12px 18px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
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

        <a href="/tasks" class="menu active">
            Dashboard
        </a>

        <a href="/tasks/create" class="menu">
            Add Task
        </a>

    </aside>

    <main class="main">

        <a href="/tasks" class="back">
            ← Back to Dashboard
        </a>

        <div class="title">

            <h1>Task Details</h1>

        </div>

        <div class="card">

            <h2 class="task-title">
                {{ $task->task_name }}
            </h2>

            <p class="description">
                {{ $task->description ?? 'No description provided.' }}
            </p>

            <div class="info">

                <div class="info-row">

                    <span class="label">
                        Status
                    </span>

                    @if ($task->status == 'Completed')

                        <span class="status completed">
                            Completed
                        </span>

                    @else

                        <span class="status pending">
                            Pending
                        </span>

                    @endif

                </div>

                <div class="info-row">

                    <span class="label">
                        Due Date
                    </span>

                    <span class="value">
                        {{ $task->due_date ?? 'No due date' }}
                    </span>

                </div>

            </div>

            <div class="actions">

                <a href="/tasks/{{ $task->id }}/edit" class="edit">
                    Edit Task
                </a>

                <form
                    action="/tasks/{{ $task->id }}"
                    method="POST"
                    style="display:inline;"
                >

                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="delete"
                        onclick="return confirm('Delete this task?')"
                    >
                        Delete
                    </button>

                </form>

            </div>

        </div>

    </main>

</body>

</html>