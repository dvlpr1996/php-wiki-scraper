@extends('layouts.master')
@section('title', 'Home')

@section('content')
		<main class="px-sm-0 container px-2">
				<div class="row my-3">
						<h1 class="display-4 fst-italic text-center">
								<a href="{{ route('index') }}" class="text-decoration-none text-dark">
										Php wikipedia scraper (English Only)
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
								@if (isset($errors) && !empty($errors))
										<div class="alert alert-danger">
												<ul class="m-0 pl-2">
														@foreach ($errors as $error)
																<li class="text-danger">{{ $error }}</li>
														@endforeach
												</ul>
										</div>
								@endif
						</div>
				</div>

				<div class="row mt-5">
						@if (isset($hTitle) && !empty($hTitle))
								<h1 class="display-5 fst-italic">{{ plainText($hTitle) }}</h1>
						@endif
				</div>

				<div class="row mt-3">
						@if (isset($pNodes) && !empty($pNodes))
								@foreach ($pNodes as $key => $value)
										<p class="lead fw-normal my-2">{{ plainText($value[$key]) }}</p>
								@endforeach
						@endif
						@if (isset($pNodes) && empty($pNodes))
								<div class="alert alert-danger pb-0">
										<p class="text-danger fw-bolder text-center">
												No Content Found for {{ $hTitle ?? 'Your Desired Title' }}
										</p>
								</div>
						@endif
				</div>
		</main>
@endsection
