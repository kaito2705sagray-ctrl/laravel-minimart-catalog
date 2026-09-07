@extends('layouts.app')

@section('title', 'Index Products')

@section('content')
    <div class="w-100 mx-auto">
        <div class="row mb-3">
            <div class="col">
                <h1 class="float-start">Products</h1>
            </div>
            <div class="col">
                <a href="{{ route('product.create')}}" class="float-end text-decoration-none p-1 text-white rounded btn btn-success ">
                    <i class="fa-solid fa-circle-plus "></i>New Product
                </a>
            </div>
        </div>
        <div class="row border-bottom border-3 border-black bg-success-subtle">
            <div class="col-1 text-uppercase">id</div>
            <div class="col text-uppercase">name</div>
            <div class="col text-uppercase">description</div>
            <div class="col text-uppercase">price</div>
            <div class="col text-uppercase">quantity</div>
            <div class="col text-uppercase">section</div>
            <div class="col-1"></div>
            <div class="col-1 "></div>
            <div class="col-1 "></div>
        </div>
        @foreach($all_products as $product)
            <div class="row border-bottom py-2 align-items-center">
                <div class="col-1">{{ $product->id }}</div>
                <div class="col">{{ $product->name }}</div>
                <div class="col">{{ $product->description }}</div>
                <div class="col">{{ $product->price}}</div>
                <div class="col">{{ $product->quantity }}</div>
                <div class="col">{{ $product->section->name }}</div>
                <div class="col-1">
                    <button type="button" class="btn text-warning text-decoration-none" data-bs-toggle="modal" data-bs-target="#buyProductModal{{ $product->id }}">
                        <i class="fa-solid fa-bag-shopping"></i>
                    </button>
                </div>
                <div class="col-1">
                    <a href="{{ route('product.edit', $product)}}">
                        <i class="fa-solid fa-pencil"></i>
                    </a>
                </div>
                <div class="col-1">
                    <button type="button" class="border-0 bg-white" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $product->id}}">
                        <i class="fa-solid fa-trash-can text-danger"></i>
                    </button>
                </div>
            </div>

            {{-- modal for buy product --}}
            <div class="modal fade" id="buyProductModal{{ $product->id }}" tabindex="-1" aria-labelledby="buyProductModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title" id="buyProductModalLabel">Buy Product</h1>

                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form action="{{ route('product.buy', $product->id )}}" method="post">
                            @csrf
                            @method('PATCH')
                            <div class="modal-body">
                                <h3>{{ $product->name }}</h3>
                                <p>Section: {{ $product->section->name }}</p>
                                <p>Price: {{ $product->price }}</p>
                                <p>Quantity In Stock: {{ $product->quantity }}
                                </p>
                                <p>Description: {{ $product->description }}</p>
                                <label for="quantity" class="form-label">Buy Qunatity:</label>
                                <input type="number" class="form-control" name="quantity" min="1" required>
                            </div>


                            <div class="modal-footer">
                                <button type="button" class="btn border-black border-2" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-warning"><i class="fa-solid fa-sack-dollar"></i>Buy</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- modal for delete --}}
            <div class="modal fade" id="exampleModal{{ $product->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title" id="exampleModalLabel">Delete Product</h1>

                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>


                        <div class="modal-body">
                            <h3>{{ $product->name }}</h3>
                            <p>Section: {{ $product->section->name }}</p>
                            <p>Price: {{ $product->price }}</p>
                            <p>Description: {{ $product->description }}</p>
                            <p>Quantity: {{ $product->quantity }}</p>
                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn text-danger border-danger border-2" data-bs-dismiss="modal">Cancel</button>
                            <form action="{{ route('product.delete', $product->id )}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="fa-solid fa-triangle-exclamation me-1"></i>Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        @if (session('buy_product'))
            <div class="alert alert-success alert-dismissible fade show mt-5" role="alert">
                {{ session('buy_product') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

    </div>
@endsection
