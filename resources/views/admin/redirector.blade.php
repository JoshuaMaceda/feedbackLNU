<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Select Role</title>
    <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 400px;
            margin: 80px auto;
            padding: 30px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
        }
        form button {
            display: block;
            width: 100%;
            margin: 10px 0;
            padding: 12px;
            border: none;
            background: #4a90e2;
            color: white;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }
        form button.logout {
            background-color: #e74c3c;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Select Dashboard</h2>

        <form method="POST" action="{{ route('admin.redirector') }}">
            @csrf
            <input type="hidden" name="role" value="student">
            <button type="submit">Student Dashboard</button>
        </form>

        <form method="POST" action="{{ route('admin.redirector') }}">
            @csrf
            <input type="hidden" name="role" value="teacher">
            <button type="submit">Teacher Dashboard</button>
        </form>

        <form method="POST" action="{{ route('admin.redirector') }}">
            @csrf
            <input type="hidden" name="role" value="supervisor">
            <button type="submit">Supervisor Dashboard</button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout">Log Out</button>
        </form>
    </div>
</body>
</html>
