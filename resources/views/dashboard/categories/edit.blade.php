<x-dashboard-layout>
    <x-slot name="pageTitle">
        Edit Category
    </x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('dashboard.category.index')}}">Categories</a></li>
        <li class="breadcrumb-item active">Edit</li>
    </x-slot>
    <div>
        <div class="row">
            <div class="col-lg-11 mx-auto">
                <div class="card">
                    <h2 class="px-3 pt-3">Category Information</h2>
                    <div class="card-body">
                        <form method="POST" action="{{route('dashboard.category.update', $category->slug)}}" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="name">Category Name</label>
                                            <input type="text" value="{{old('name', $category->name)}}" class="form-control"
                                                placeholder="First Name" name="name">
                                        </div>
                                    </div>
                                    @error('name')
                                    <div>
                                        <h6 class="text-danger">{{$message}}</h6>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-12">
                                    <div class="custom-file">
                                        <input type="file" name="image" multiple
                                            class="custom-file-input form-control @error('image') is-invalid @enderror"
                                            id="profileImage">
                                        <label class="custom-file-label" for="profileImage">Category Image</label>
                                    </div>
                                </div>
                                @error('image')
                                <div>
                                    <h6 class="text-danger">{{$message}}</h6>
                                </div>
                                @enderror
                                <script>
                                    const profileImage= document.getElementById('profileImage');
                                    profileImage.addEventListener('change', e => {
                                        if(profileImage.files.length > 0){
                                            document.querySelector('label[for="profileImage"]').innerHTML =  profileImage.files[0].name;
                                        }
                                    })
                                </script>
                            </div>

                            <div class="mb-0">
                                <div class="d-flex justify-content-between align-items-baseline">
                                    <x-button class="text-white">
                                        {{ __('Edit Category') }}
                                    </x-button>
                                </div>
                            </div>
                            @foreach ($errors->all() as $error)
                            {{ $error }}<br/>
                             @endforeach
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>

