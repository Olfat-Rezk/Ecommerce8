<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All brand </b>

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

                    <div class="card-header"> All brand


                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">brand_name</th>
                                    <th scope="col">brand_image</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @php($i = 1)
                                @foreach ($brands as $brand)
                                    <tr>
                                        <th scope="row">{{ $i++ }}</th>
                                        <td>{{ $brand->brand_name }}</td>
                                        <td><img src="" alt=""></td>
                                        <td>
                                            @if ($brand->created_at == null)
                                                <span class="text-danger">No data set</span>
                                            @else
                                                {{ $brand->created_at->diffForHumans() }}
                                            @endif

                                        </td>
                                        <td>
                                            <a href="{{ url('brand/edit/' . $brand->id) }}" class="btn btn-info">Edit</a>
                                            <a href="{{ url('brand/softDelete/' . $brand->id) }}"
                                                class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach




                            </tbody>
                        </table>
                        {{ $brands->links() }}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Add brand</div>
                    <div class="card-body">
                        <form action="{{ route('store.brand') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label"> brand Name</label>
                                <input type="text" name="brand_name" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp">
                                <div id="emailHelp" class="form-text"></div>
                                @error('brand_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlFile1">Brand image</label>
                                <input type="file" name="brand_image" class="form-control-file"
                                    id="exampleFormControlFile1">
                                @error('brand_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <button type="submit" class="btn btn-primary">Add brand</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
