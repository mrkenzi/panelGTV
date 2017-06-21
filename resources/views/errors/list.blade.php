@if (count($errors) > 0)
	<div class="alert alert-danger">
	    <ul>
	    	@foreach ($errors->all() as $error)
        		<li>{{ $error }}</li>
    		@endforeach
	    </ul>
	</div>
@endif
@if (isset($error_message))
	<div class="alert alert-danger">
		<p>{{ $error_message }}</p>
	</div>
@endif
@if (isset($success_message))
	<div class="alert alert-success">
		<p>{{ $success_message }}</p>
	</div>
@endif