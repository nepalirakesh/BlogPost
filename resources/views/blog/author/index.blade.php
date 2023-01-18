@extends('dashboard')
@section('title', 'All Authors')
@section('content')
    @include('bloglayout.crudmessage')
    <div class="container text-center w-50 mt-5">
        <h3>Authors</h3>
        <table class="table container text-center">
            {{-- <table class="table container table-bordered w-75 text-center" style="table-layout: fixed"> --}}
            <thead class="thead-dark">
                <tr>
                    <th scope="col">SN</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Image</th>
                    <th scope="col">Description</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($authors as $author)
                    <tr>
                        <td>{{ $authors->firstItem() + $loop->index }}</td>
                        <td>{{ ucfirst($author->name) }}</td>
                        <td>{{ $author->email }}</td>
                        <td>
                            <img src="{{ asset("storage/images/$author->image") }}" alt="" width="50px"
                                height="50px">
                        </td>
                        <td>{!! ucfirst(Str::limit($author->description, 10)) !!}</td>
                        <td>
                            <form action="{{ route('author.delete', $author) }}" method="POST">
                                <a href="{{ route('author.edit', $author) }}" class="btn btn-secondary btn-sm">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <ul class="pagination justify-content-center">
            {!! $authors->links('pagination::bootstrap-4') !!}
        </ul>
    </div>
@endsection
