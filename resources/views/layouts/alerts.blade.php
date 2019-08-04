<div class="container">
    <div class="row">
        <div class="col-md-12">
                    
            @if($errors->any() || Session::has('error'))
                <div class="alert alert-danger">
                    @if ($errors->any())
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @elseif(Session::has('error'))
                        <p>{{ Session::get('error') }}</p>
                    @endif
                </div>
            @endif

        </div>
    </div>
</div>