@if (session('success'))
<div class="container-fluid box-body">
    <div class="alert alert-success">
        <h4><i class="icon fa fa-check"></i>&nbsp;{{ session('success') }}</h4>
    </div>
</div>
@endif