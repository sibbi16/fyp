@props(['maxWidth'=> '520px'])
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-10 col-lg-7" @if ($maxWidth) style="max-width: {{$maxWidth}}" @endif>
            <div class="d-flex justify-content-center mb-3">
                {{ $logo ?? ""}}
            </div>

            <div class="card shadow-sm px-3" style="background-color: #fcf5f8;">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
