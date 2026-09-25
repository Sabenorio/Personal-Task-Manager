<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>TaskFlow</title>

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
            padding: 40px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 30px;
        }

        .header p {
            color: #777;
            margin-top: 6px;
        }

        .add-button {
            display: inline-block;
            text-decoration: none;
            background: #2563eb;
            color: white;
            padding: 13px 20px;
            border-radius: 8px;
            font-weight: bold;
        }

        .add-button:hover {
            background: #1d4ed8;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 22px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .stat-card p {
            color: #777;
            font-size: 14px;
        }

        .stat-card h2 {
            margin-top: 8px;
            font-size: 28px;
        }

        .task-list {
            display: grid;
            gap: 15px;
        }

        .task-card {
            background: white;
            padding: 22px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .task-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .task-title {
            font-size: 19px;
        }

        .description {
            color: #777;
            margin-top: 10px;
        }

        .status {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
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

        .due-date {
            color: #777;
            font-size: 13px;
            margin-top: 15px;
        }

        .actions {
            margin-top: 18px;
        }

        .actions a {
            text-decoration: none;
            margin-right: 15px;
            font-size: 14px;
            color: #2563eb;
        }

        .delete-button {
            border: none;
            background: none;
            color: #dc2626;
            cursor: pointer;
            font-size: 14px;
        }

        .empty {
            background: white;
            padding: 50px;
            text-align: center;
            border-radius: 12px;
            color: #777;
        }

        .empty h2 {
            color: #333;
            margin-bottom: 8px;
        }

        @media (max-width: 700px) {
            .sidebar {
                display: none;
            }

            .main {
                margin-left: 0;
                padding: 20px;
            }

            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 20px;
            }

            .stats {
                grid-template-columns: 1fr;
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

        <div class="header">

            <div>
                <h1>My Tasks</h1>

                <p>
                    Keep track of your tasks and deadlines.
                </p>
            </div>

            <a href="/tasks/create" class="add-button">
                + Add New Task
            </a>

        </div>

        <div class="stats">

            <div class="stat-card">
                <p>Total Tasks</p>

                <h2>
                    {{ $tasks->count() }}
                </h2>
            </div>

            <div class="stat-card">
                <p>Pending</p>

                <h2>
                    {{ $tasks->where('status', 'Pending')->count() }}
                </h2>
            </div>

            <div class="stat-card">
                <p>Completed</p>

                <h2>
                    {{ $tasks->where('status', 'Completed')->count() }}
                </h2>
            </div>

        </div>

        <div class="task-list">

            @forelse ($tasks as $task)

                <div class="task-card">

                    <div class="task-top">

                        <h3 class="task-title">
                            {{ $task->task_name }}
                        </h3>

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

                    <p class="description">
                        {{ $task->description ?? 'No description.' }}
                    </p>

                    @if ($task->due_date)

                        <p class="due-date">
                            Due date: {{ $task->due_date }}
                        </p>

                    @endif

                    <div class="actions">

                        <a href="/tasks/{{ $task->id }}">
                            View
                        </a>

                        <a href="/tasks/{{ $task->id }}/edit">
                            Edit
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
                                class="delete-button"
                                onclick="return confirm('Delete this task?')"
                            >
                                Delete
                            </button>

                        </form>

                    </div>

                </div>

            @empty

                <div class="empty">

                    <h2>No Tasks Yet</h2>

                    <p>
                        Click "Add New Task" to create your first task.
                    </p>

                </div>

            @endforelse

        </div>

    </main>

</body>

</html>