<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-4">
        <h1>All Users</h1>

        {{-- Search Form --}}
        <div class="mb-3">
            <form action="{{ route('users.index') }}" method="GET" class="form-inline">
                <div class="form-group mr-2">
                    <input type="text" name="search" class="form-control" placeholder="Search by name or email" value="{{ request('search') }}">
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>

        {{-- User Table --}}
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td class="d-flex justify-content-around">
                            <a href="{{ route('users.edit', $user) }}" class="btn btn-success px-3">Edit</a>
                            <form method="POST" action="{{ route('users.destroy', $user->id) }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">No users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="flaot-start">
            <a href="{{ route('export.users')}}" class="btn btn-success">Download as .xls format</a>
            <a href="{{ route('user.create')}}" class="btn btn-info">View</a>
        </div>

        <a href="{{ route('user.create')}}" class="btn btn-primary float-right mb-5">Add User</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
