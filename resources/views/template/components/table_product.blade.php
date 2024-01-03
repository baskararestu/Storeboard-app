<table id="example1" class="table table-striped table-bordered table-hover text-center"
    style="width: 100%">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama</th>
            <th>Category</th>
            <th>Supplier</th>
            <th>Stock</th>
            <th>Price</th>
            <th>Note</th>
            <th>User</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($product as $data)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data->name }}</td>
                <td>{{ $data->category }}</td>
                <td> {{ $data->supplier }}</td>
                <td>{{ $data->stock }}</td>
                <td>Rp. {{ number_format($data->price, 0) }}</td>
                <td>{{ $data->note }}</td>
                <td>{{$data->user->name}}</td>
                <td>
                    @if(auth()->id() === $data->user_id)
                        <form class="d-inline" action="/product/{{ $data->id_product }}/edit" method="GET">
                            <button type="submit" class="btn btn-success btn-sm mr-1">
                                <i class="fa-solid fa-pen"></i> Edit
                            </button>
                        </form>
                        <form class="d-inline" action="/product/{{ $data->id_product }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm" id="btn-delete">
                                <i class="fa-solid fa-trash-can"></i> Delete
                            </button>
                        </form>
                    @else
                        <button class="btn btn-secondary btn-sm" disabled>
                            Edit
                        </button>
                        <button class="btn btn-secondary btn-sm" disabled>
                            Delete
                        </button>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>