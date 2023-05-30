@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            @foreach ($post_data as $d)
            <div class="col-6 offset-3">
                <div class="mt-3 mb-4">
                    <a href="{{ route('post#home')}}">
                        <i class="fa-solid fa-circle-chevron-left fs-5 text-dark"></i>
                    </a>
                </div>
                <div class="mb-3">
                    <label class="pb-2">Title</label>
                    <input type="text" disabled name="title" class="form-control text-muted" value="{{ $d['title']}}" required>
                </div>
                <div class="mb-2">
                    <label class="pb-2">Description</label>
                    <textarea name="description" disabled id="" cols="30" rows="10" class="form-control text-muted" required>{{ $d['description']}}</textarea>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row mt-2">
            <div class="col-2 offset-8">
                <a href="{{ route('post#edit',$d['id'])}}">
                    <button type="submit" class="btn bg-dark text-white">Edit</button>
                </a>
            </div>
        </div>
    </div>
@endsection
