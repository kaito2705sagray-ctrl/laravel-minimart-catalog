@extends('layouts.app')

@section('title', 'Edit Products')

@section('content')
    <div class="w-50 mx-auto">
        <h1>Edit Product</h1>
        <form action="{{ route('product.update', $product->id)}}" method="post">
            @csrf
            @method('PATCH')

            <div class="row mb-2">
                <div class="col">
                    <label for="name" class="form-label fw-bold">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name',$product->name) }}" required >
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <label for="description" class="form-label fw-bold">Description</label>
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control"  required>{{ old('description',$product->description) }}</textarea>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <label for="name" class="form-label fw-bold">Price</label>

                    <div class="input-group">
                        <span class="input-group-text bg-secondary-subtle">$</span>
                        <input type="number" name="price" id="price" class="form-control " value="{{ old('price', $product->price)}}" step="0.01" required >
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" name="quantity"  class="form-control" value="{{ old('quantity', $product->qunatity)}}" required>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <label for="section" class="form-label fw-bold">Section</label>
                    @if($all_sections->isNotEmpty())
                        <select name="section" id="section" class="form-control">
                            <option value="none" hidden>Select Section</option>
                            @foreach($all_sections as $section)
                                @if($product->section->id == $section->id)
                                    <option value="{{ $section->id }}" selected>{{ $section->name }}</option>
                                @else
                                    <option value="{{ $section->id }}">{{ $section->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    @else
                        <select name="section" id="section" class="form-control">
                            <option value="none" hidden>Select Section</option>
                        </select>

                        <a href="{{ route('section.index')}}" class="text-decration-none">Add a new section</a>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <a href="{{ route('index')}}" class="btn text-secondary-subtle border border-2 border-success-subtle  fw-bold">Cancel</a>
                    <button type="submit" class="btn btn-secondary text-white px-5"><i class="fa-solid fa-check"></i>Save changes</a>
                </div>
            </div>
        </form>
    </div>
@endsection
