@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <form action="{{ route('post#update',$post['id'])}}" method="post">
                @csrf
                <div class="col-md-6 offset-3 mt-5">
                    <div class="mt-3 mb-4">
                        <a href="{{ route('post#read',$post['id'])}}">
                            <i class="fa-solid fa-circle-chevron-left fs-5 text-dark"></i>
                        </a>
                    </div>
                    <div class="mb-3">
                        <label class="pb-2">Title</label>
                        <input type="text" name="title" class="form-control" value="{{ $post['title']}}" required>
                    </div>
                    <div class="mb-2">
                        <label class="pb-2">Description</label>
                        <textarea name="description" id="" cols="30" rows="10" class="form-control" required>{{ $post['description']}}</textarea>
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary float-end">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
