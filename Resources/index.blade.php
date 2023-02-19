@extends('layouts.master')
@section('title', 'Home')

<main class="px-sm-0 container px-2">
		<div class="row my-3">
				<h1 class="display-3 fst-italic text-center">
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
										<ul class="list-unstyled m-0 p-0">
												@foreach ($errors as $error)
														<li class="text-danger">{{ $error }}</li>
												@endforeach
										</ul>
								</div>
						@endif
				</div>
		</div>

		<div class="row mt-5">
				@if (isset($title) && !is_null($title) && !empty($title))
						<h1 class="display-5 fst-italic">{{ $title }}</h1>
				@endif
		</div>

		<div class="row mt-3">
				@if (isset($pNodes) && !is_null($pNodes) && !empty($pNodes))
						@foreach ($pNodes as $key => $value)
								<p class="lead my-2 fw-normal">{{ $value[$key] }}</p>
						@endforeach
				@endif
		</div>
</main>
