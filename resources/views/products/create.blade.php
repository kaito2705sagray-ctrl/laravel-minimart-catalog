@extends('layouts.app')

@section('title', 'Create Products')

@section('content')
    <div class="w-50 mx-auto">
        <h1>New Product</h1>
        <form action="{{ route('product.store')}}" method="post">
            @csrf

            <div class="row mb-2">
                <div class="col">
                    <label for="name" class="form-label fw-bold">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name')}}" required >
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <label for="description" class="form-label fw-bold">Description</label>
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control" value="{{ old('description')}}" required></textarea>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <label for="name" class="form-label fw-bold">Price</label>

                    <div class="input-group">
                        <span class="input-group-text bg-secondary-subtle">$</span>
                        <input type="number" name="price" id="price" class="form-control " value="{{ old('price')}}" step="0.01" required >
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" name="quantity"  class="form-control" required>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <label for="section" class="form-label fw-bold">Section</label>
                    @if($all_sections->isNotEmpty())
                        <select name="section" id="section" class="form-control">
                            <option value="none" hidden>Select Section</option>
                            @foreach($all_sections as $section)
                                <option value="{{ $section->id }}">{{ $section->name }} </option>
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
                    <a href="{{ route('index')}}" class="btn text-success border border-2 border-success  fw-bold">Cancel</a>
                    <button type="submit" class="btn btn-success text-white px-5"><i class="fa-solid fa-plus"></i>Add</a>
                </div>
            </div>
        </form>
    </div>
@endsection
