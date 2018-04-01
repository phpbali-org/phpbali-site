@extends('layouts.verifiedemail')

@section('additional-styles')
<style type="text/css">
	body{
		background-color: #f7f7f7;
	}

	.lead
	{
		margin-bottom: .75em;
	    font-size: 1.2em;
	    font-weight: 300;
	    line-height: 1.4;
	}

	.title
	{
		margin-bottom: 15px;
	}

	.section.organizers
	{
		background-color: white;
	    border-bottom: 1px solid #eee;
	    border-top: 1px solid #eee;
	    margin-bottom: -1px;
	    margin-top: -1px;
    	padding-top: 2em;
    	padding-bottom: 1em;
	}

	.section
	{
		background: none;
	}

	.about-organizers .img-wrapper
	{
		width: 50px;
	    height: 50px;
	    float: left;
	    overflow: hidden;
	    margin-bottom: 1rem;
	    margin-right: .625rem;
	}

	.about-organizers .img-wrapper img
	{
		display: block;
	    max-width: 100%;
	    height: auto;
	    border: .1rem solid #2e99e5;
	    padding: .125rem;
	}

	.about-organizers .name, .about-organizers .title
	{
		margin: 0;
	}

	@media(min-width: 768px)
	{
		.lead
		{
			font-size: 1.5em;
		}
	}
</style>
@endsection

@section('content')
	<div class="section">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<h1 class="title">About</h1>
					<p class="lead">Every 3rd Wednesday of the month you'll find us talking about what we're doing and what's happening around us in the world of PHP.</p>
					<p class="lead">PHPBali wouldn't be possible without our organisers:</p>
				</div>
			</div>
		</div>
	</div>
	<div class="section organizers">
		<div class="container">
			<div class="row about-organizers ml-auto">
				<div class="col-sm-4">
					<div class="organizer">
						<a href="#">
							<div class="img-wrapper">
								<img src="https://avatars3.githubusercontent.com/u/73311?v=4&s=400" alt="adi-setiawan" class="rounded-circle">
							</div>
						</a>
						<h4 class="name">Adi Setiawan</h4>
						<p class="name">Coordinator</p>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="organizer">
						<a href="#">
							<div class="img-wrapper">
								<img src="https://avatars3.githubusercontent.com/u/73311?v=4&s=400" alt="adi-setiawan" class="rounded-circle">
							</div>
						</a>
						<h4 class="name">Adi Setiawan</h4>
						<p class="name">Coordinator</p>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="organizer">
						<a href="#">
							<div class="img-wrapper">
								<img src="https://avatars3.githubusercontent.com/u/73311?v=4&s=400" alt="adi-setiawan" class="rounded-circle">
							</div>
						</a>
						<h4 class="name">Adi Setiawan</h4>
						<p class="name">Coordinator</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="section">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2>Code of Conduct</h2>
					<h5><b>We choose to share PHP's good parts; and we choose to share our own.</b></h5>
					<p>The PHP Bali community is full of wonderful people from a diverse range of backgrounds, and we want to ensure it remains a welcoming and safe environment to all who wish to be a part of it.</p>
					<p>Whenever we come together as a community, our shared spaces are opportunities to showcase the best of what we can be. We are there to support our peers - to build each other up, to accept each other for who they are, and to encourage each other to become the people they want to be.</p>
					<p>With that in mind, if you are present at any PHPBali event, whether as an attendee, organiser, sponsor, or speaker, we take it as given that you agree to follow this code of conduct:</p>
					<p>The PHPBali community is dedicated to providing harassment-free experiences at events and conferences for everyone regardless of who they are or what they believe. We do not tolerate harassment in any form.</p>
					<p>All communication should be appropriate for a professional audience including people of many different backgrounds.</p>
					<p>Be kind and respectful towards others. Remember that harassment and exclusionary jokes are not appropriate for events supported by PHPBali.</p>
					<p>Anyone violating these rules at events may be asked to leave the event without a refund at the sole discretion of the organisers.</p>
					<p>If you or someone else is subject to harassment, or you have a concern, please contact the event organisers (who will introduce themselves at the beginning of the event).</p>
					<p>The PHPBali community is a welcoming and friendly place – thank you for being a part of it.</p>
					<p>If you believe in building people, communities, and software, then you are a part of us.</p>
					<hr style="margin-top: 3em; margin-bottom: 3em;">
					<h5><b>Thank you</b></h5>
					<p>This Code of Conduct has learned and borrowed much from others - especially <a href="http://ruby.org.au/code-of-conduct.html">rubyaustralia</a>, <a href="http://jsconf.com/codeofconduct.html">JSConf</a>, and <a href="https://gist.github.com/jcasimir/6992184">Jeff Casimir</a>. Thank you to all who provided inspiration and feedback.</p>
				</div>
			</div>
		</div>
	</div>
@endsection