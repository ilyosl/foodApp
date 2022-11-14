@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>
                        Edit Category
                        <a href="{{ url('admin/category')  }}" class="btn btn-primary btn-sm text-white float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ url('admin/category/'. $category->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="">Name</label>
                                <input type="text" name="name" value="{{ $category->name }}" class="form-control" />
                                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Status</label><br>
                                <input type="checkbox" {{ $category->status ? 'checked' : ''  }} name="status" />
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="">Description</label>
                                <textarea type="text" name="desc" class="form-control" rows="3">{{ $category->desc }}</textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Image</label>
                                <input type="file" name="image" class="form-control" />
                                <img src="{{ asset('uploads/category/'. $category->image)  }}" width="160px" />
                            </div>
                            <div class="col-md-12">
                                <h4>SEO Tags</h4>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="">Meta title</label>
                                <input type="text" name="meta_title" value="{{ $category->meta_title }}" class="form-control" />
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="">Meta Keyword</label>
                                <textarea type="text" name="meta_keywords" class="form-control" rows="3">{{ $category->meta_keywords }}</textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="">Meta Desc</label>
                                <textarea type="text" name="meta_desc" class="form-control" rows="3">{{ $category->meta_desc }}</textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                                <button type="submit" class="btn btn-primary text-white float-end">Save</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
