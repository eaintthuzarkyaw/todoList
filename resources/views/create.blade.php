@extends('layouts.master')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-12 col-md-5 col-lg-5 bg-white">
                <div class="p-3">
                    <form action="{{ route('post#create')}}" method="POST">
                        @csrf
                        <div class="group-text">
                            <label for="" class="pb-1">Post Title</label>
                            <input type="text" name="title" class="form-control" placeholder="Enter Post Title...">
                        </div>
                        <div class="group-text mb-3 mt-4">
                            <label for="" class="pb-1">Post Description</label>
                            <textarea name="description" class="form-control" placeholder="Enter Post Description..." cols="30" rows="10"></textarea>
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary">Create</button>
                    </form>
                </div>
            </div>
            <div class="col-md-7 col-lg-7 col-sm-12">

            @foreach ($posts as $p)
            <div class="post p-3 shadow-sm">
               <div class="d-flex justify-content-between">
                <h5>{{ $p['title']}}</h5>
                <small class="text-success">{{ date('d-m-Y', strtotime($p['created_at'])) }}</small>
               </div>
                {{-- <p>{{substr( $p['description'],0,1000)}}</p>  pure php --}}
                <p>{{ Str::words($p['description'],10,'...')}}</p>
                <div class="text-end">
                    <button class="btn btn-sm btn-primary" title="see more"><i class="fa-solid fa-circle-info me-2"></i>အပြည့်စုံဖတ်ရန်</button>
                    <a href="{{ route('postDelete',$p['id'])}}">
                        <button class="btn btn-sm btn-danger" title="delete"><i class="fa-solid fa-trash me-2"></i>ဖျတ်ရန်</button>
                    </a>
                </div>
            </div>
            @endforeach

            </div>
        </div>
    </div>
@endsection
