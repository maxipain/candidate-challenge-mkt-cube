<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Archived postcards') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="bg-gray-200 bg-opacity-25 p-6">
                    <table id="example" class="table table-striped" style="width:100%">
                        @include('includes.messages')
                        <a href="{{ route('dashboard') }}" class="btn btn-warning mb-4 ml-3">Active postcards</a>

                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Postcard title</th>
                            <th>Price</th>
                            <th>Draft</th>
                            <th>Online at</th>
                            <th>Offline at</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($postcards as $postcard)
                            <tr>
                                <td>{{ $postcard->id }}</td>
                                <td>{{ $postcard->title }}</td>
                                <td>{{ $postcard->price }}</td>
                                <td>
                                    {{--                                        @if($postcard->is_draft==0)--}}
                                    {{--                                            No--}}
                                    {{--                                        @else--}}
                                    {{--                                            Yes--}}
                                    {{--                                        @endif--}}
                                    {{$postcard->is_draft}}
                                </td>
                                <td>{{ date($postcard->online_at) }}</td>
                                <td>{{ date($postcard->offline_at) }}</td>
                                <td>
                                    <form action="/postcards-management/{{ $postcard->id }}/restore" method="post">
                                        @csrf
                                        <button class="btn btn-link">Restore</button>
                                    </form>
                                    <form action="/postcards-management/{{ $postcard->id }}/delete" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-link">Delete</button>
                                    </form>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @section('custom_script')
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
        <script>
            $(document).ready(function () {
                $('#example').DataTable();
            });
        </script>
    @endsection
</x-app-layout>
