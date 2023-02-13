@extends('layouts.master')
@section('title', 'Home')

<main class="px-sm-0 container px-2">
		<div class="row my-3">
				<h1 class="display-4 fst-italic text-center">
						<a href="{{ route('index') }}" class="text-decoration-none text-dark">
								Php wikipedia scraper
						</a>
				</h1>
		</div>

		<div class="row justify-content-center">
				<div class="col-11 col-lg-8">
						<form action="{{ route('crawler') }}" method="POST">
								<div class="input-group mb-3">
										<input type="text" class="form-control" placeholder="Search Wikipedia" name="input">
										<button type="submit" class="btn btn-success">
												search
										</button>
								</div>
						</form>
				</div>
		</div>

		<div class="row justify-content-center">
				<div class="col-11 col-lg-8">
						@if (isset($errors) && !is_null($errors) && !empty($errors))
								<div class="alert alert-danger">
										<ul class="m-0 p-0 list-unstyled">
												@foreach ($errors as $error)
														<li class="text-danger">{{ $error }}</li>
												@endforeach
										</ul>
								</div>
						@endif
				</div>
		</div>

</main>
