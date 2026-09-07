@extends('layouts.app')

@section('title', 'Edit Section')

@section('content')
    <div class="w-50 mx-auto">
        <h1>Section Edit</h1>
        <form action="{{ route('section.update', $section->id)}}" method="post">
            @csrf
            @method('PATCH')
            <div class="row">
                <div class="col mb-3">
                    <label for="name" class="form-label">Section Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $section->name)}}">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <button type="submit" class="btn btn-secondary">
                        <i class="fa-solid fa-check me-1"></i>Save
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
