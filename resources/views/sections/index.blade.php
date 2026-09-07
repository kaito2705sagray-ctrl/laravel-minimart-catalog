@extends('layouts.app')

@section('title', 'Section Index')

@section('content')
    <div class="mx-auto w-50">
        <h2>Sections</h2>
        <form action="{{ route('section.store')}}" method="post" class="mb-2">
            @csrf

            <div class="row">
                <div class="col-8">
                    <input type="text" name="name" class="form-control" placeholder="Add new section here...">
                </div>
                <div class="col-4">
                    <button type="submit" class="btn btn-info btm-sm text-black fw-bold">
                        <i class="fa-solid fa-plus"></i>Add
                    </button>
                </div>
            </div>
        </form>
        @if($all_sections->isNotEmpty())
            <div class="row bg-info fw-bold border-bottom border-black border-3 py-1">
                <div class="col">ID</div>
                <div class="col">NAME</div>
                <div class="col"></div>
            </div>

            @foreach($all_sections as $section)
                <div class="row py-1 border-bottom border-1 fs-5">
                    <div class="col">{{ $section->id }}</div>
                    <div class="col">{{ $section->name }}</div>
                    <div class="col">
                            <button type="button" name="section_delete" class="btn btn-white btn-sm" data-bs-toggle="modal" data-bs-target="#destroyModal{{ $section->id }}">
                                <i class="fa-solid fa-trash-can text-danger fs-5"></i>
                            </button>
                            <a href="{{ route('section.edit', $section->id ) }}" class="btn text-success fs-5 text-decoration-none">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </a>
                    </div>

                            <div class="modal fade" id="destroyModal{{ $section->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title" id="exampleModalLabel">Delete Section</h1>

                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>


                                        <div class="modal-body">
                                            <h3>{{ $section->name }}</h3>
                                        </div>


                                        <div class="modal-footer">
                                            <button type="button" class="btn text-danger border-danger border-2" data-bs-dismiss="modal">Cancel</button>
                                            <form action="{{ route('section.delete', $section->id )}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" ><i class="fa-solid fa-triangle-exclamation me-1"></i>Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                </div>
            @endforeach

            @error('section_delete')
                    <p class="text-danger">{{ $message }}</p>
             @enderror
             
        @endif
    </div>
@endsection

