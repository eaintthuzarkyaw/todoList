@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">

            <form action="{{ route('post#update',$post['id'])}}" method="post">
                @csrf
                <div class="col-md-6 offset-3 mt-1">
                    <div class="mt-3 mb-4">
                        <a href="{{ route('post#read',$post['id'])}}">
                            <i class="fa-solid fa-circle-chevron-left fs-5 text-dark"></i>
                        </a>
                    </div>

                    <div class="mb-3">
                        <label class="pb-2">Title</label>
                        <input type="text" name="title"
                        class="form-control @error('title')
                            is-invalid
                        @enderror"
                         value="{{ old('title',$post['title']) }}">
                         @error('title')
                         <div class="invalid-feedback">
                            {{ $message }}
                         </div>
                         @enderror
                    </div>
                    <div class="mb-2">
                        <label class="pb-2">Description</label>
                        <textarea name="description" id="" cols="30" rows="10"
                        class="form-control @error('description')
                            is-invalid
                        @enderror"
                        >{{ old('desciption',$post['description']) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary float-end">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
