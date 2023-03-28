<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All category </b>

        </h2>
    </x-slot>

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="card">

                    <div class="card-header"> All Category


                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">category_name</th>
                                    <th scope="col">user</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @php($i = 1)
                                @foreach ($categories as $category)
                                    <tr>
                                        <th scope="row">{{ $i++ }}</th>
                                        <td>{{ $category->category_name }}</td>
                                        <td>{{ $category->user->name }}</td>
                                        <td>
                                            @if ($category->created_at == null)
                                                <span class="text-danger">No data set</span>
                                            @else
                                                {{ $category->created_at->diffForHumans() }}
                                            @endif

                                        </td>
                                        <td>
                                            <a href="{{ url('category/edit/'. $category->id) }}"
                                                class="btn btn-info">Edit</a>
                                            <a href="{{ url('category/softDelete/'.$category->id) }}" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach




                            </tbody>
                        </table>
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Add Category</div>
                    <div class="card-body">
                        <form action="{{ route('store.category') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label"> category Name</label>
                                <input type="text" name="category_name" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp">
                                <div id="emailHelp" class="form-text"></div>
                                @error('category_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Add category</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Trashed --}}
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="card">

                    <div class="card-header"> All Category


                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">category_name</th>
                                    <th scope="col">user</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @php($i = 1)
                                @foreach ($trashed as $category)
                                    <tr>
                                        <th scope="row">{{ $i++ }}</th>
                                        <td>{{ $category->category_name }}</td>
                                        <td>{{ $category->user->name }}</td>
                                        <td>
                                            @if ($category->created_at == null)
                                                <span class="text-danger">No data set</span>
                                            @else
                                                {{ $category->created_at->diffForHumans() }}
                                            @endif

                                        </td>
                                        <td>
                                            <a href="{{ url('category/restore/'. $category->id) }}"
                                                class="btn btn-info">Restore</a>
                                            <a href="{{ url('category/delete/'. $category->id) }}" class="btn btn-danger">Force Delete</a>
                                        </td>
                                    </tr>
                                @endforeach




                            </tbody>
                        </table>
                        {{ $trashed->links() }}
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    {{-- end trashed --}}
</x-app-layout>
