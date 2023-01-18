@extends('dashboard')
@section('title', 'All Tags')
@section('content')
    @include('bloglayout.crudmessage')
    <div class="container text-center mt-5">
        <h3>Tags</h3>
        <table class="table container text-center w-50">
            {{-- <table class="table container table-bordered w-75 text-center" style="table-layout: fixed"> --}}
            <thead class="thead-dark">
                <tr>
                    <th scope="col" width="10%">SN</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tags as $tag)
                    <tr>
                        <td style="text-align:center">{{ $tags->firstItem() + $loop->index }}</td>
                        <td>{{ ucfirst($tag->title) }}</td>
                        <td>{{ ucfirst(Str::limit($tag->description, 10)) }}</td>
                        <td>
                            <form action="{{ route('tag.delete', $tag) }}" method="POST">
                                <a href="{{ route('tag.show', $tag) }}" class="btn btn-primary btn-sm">Show</a>
                                <a href="{{ route('tag.edit', $tag) }}" class="btn btn-secondary btn-sm">Edit</a>
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
            {!! $tags->links('pagination::bootstrap-4') !!}
        </ul>
    </div>
@endsection
