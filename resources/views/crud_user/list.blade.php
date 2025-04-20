@extends('dashboard')

@section('content')
<div class="container my-5">

    <h4 class="text-center mb-3">Danh sách user</h4>

    <table class="table table-bordered table-striped text-center">
        <thead>
            <tr>
                <th>#</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $index => $user)
            <tr>
                <td>{{ $index =($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @foreach ($user->roles as $role)
                    <a href="{{ route('role', $role->id) }}">{{ $role->name }}</a>
                    @if (!$loop->last), @endif
                @endforeach
                   </td>
                <td>
                    <a href="{{ route('user.updateUser', ['id' => $user->id]) }}">Edit</a> |
                    <a href="{{ route('user.readUser', ['id' => $user->id]) }}">View</a> |
                    <form action="{{ route('user.deleteUser', ['id' => $user->id]) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline text-danger" onclick="return confirm('Bạn có chắc muốn xoá?')">Delete</button>
                    </form>

                </td>
            </tr>
            @endforeach

            @if ($users->isEmpty())
            <tr>
                <td colspan="4">Không có người dùng nào.</td>
            </tr>
            @endif
        </tbody>
    </table>
    {{ $users->links('pagination::bootstrap-4') }}


 
</div>
@endsection