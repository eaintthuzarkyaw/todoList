@extends('layouts.master')

@section('content')
    <div class="container mt-2">
        <div class="row">
            <div class="col-2 offset-5">
                <button class="btn btn-sm btn-outline-primary">စုစုပေါင်းအရေအတွက် : {{ $posts->total() }}</button>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-sm-12 col-md-5 col-lg-5 bg-white">
                <div class="p-3">
                    @if (session('insertSuccess'))
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <strong>{{session('insertSuccess')}}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    {{-- @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <ul>
                                    <li>{{ $error }}</li>
                                </ul>
                            @endforeach
                        </div>
                    @endif --}}

                    @if (session('updateSuccess'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>{{ session('updateSuccess')}}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('post#create')}}" method="POST">
                        @csrf
                        <div class="group-text">
                            <label for="" class="pb-1">ခေါင်းစဉ်</label>
                            <input type="text" value="{{ old('title') }}" name="title"
                            class="form-control @error('title')
                                is-invalid
                            @enderror"
                            placeholder="ခေါင်းစဉ်ဖြည့်သွင်းပါ ။">
                            @error('title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="group-text mb-3 mt-4">
                            <label for="" class="pb-1">အကြောင်းအရာ</label>
                            <textarea name="description" value="{{ old('description')}}"
                            class="form-control @error('description')
                                is-invalid
                            @enderror"
                            placeholder="အကြောင်းအရာဖြည့်သွင်းပါ ။" cols="30" rows="10"></textarea>
                            @error('description')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary">ဖန်တီးပါ</button>
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
                    <a href="{{ route('post#read',$p['id'])}}">
                        <button class="btn btn-sm btn-primary" title="see more"><i class="fa-solid fa-circle-info me-2"></i>အပြည့်စုံဖတ်ရန်</button>
                    </a>
                    <a href="{{ route('postDelete',$p['id'])}}">
                        <button class="btn btn-sm btn-danger" title="delete"><i class="fa-solid fa-trash me-2"></i>ဖျတ်ရန်</button>
                    </a>
                </div>
            </div>
            @endforeach

            <div class="mt-3">
                {{ $posts->links() }}
            </div>
            </div>
        </div>
    </div>
@endsection
