@extends('layouts.master')
@section('title', 'Home')

<main class="container">
		<div class="row my-3">
				<h1 class="display-4 text-center fst-italic">Php wikipedia scraper</h1>
		</div>

		<div class="row justify-content-center">
				<div class="col-11 col-lg-8">
						<form action="{{ route('crawler') }}" method="POST">
								<div class="input-group mb-3">
										<input type="text" class="form-control" placeholder="Search Wikipedia" name="input">
										<button type="submit" class="btn btn-success" name="submit-btn">
												search
										</button>
								</div>
						</form>
				</div>
		</div>

		<div class="row my-4">

		</div>

</main>
