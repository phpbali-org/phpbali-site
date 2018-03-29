@extends('layouts.app')

@section('content')
	<div class="page-header page-header-small" filter-color="orange">
        <div class="page-header-image" data-parallax="true" style="background-image: url(&quot;../img/bg3.jpg&quot;); transform: translate3d(0px, 0px, 0px);">
        </div>
        <div class="content-center">
            <h3 class="title">Meet Other PHP Developer</h3>
            <hr class="text-white">
        </div>
    </div>
	<div class="main">
		<div class="section">
			<div class="container">
				<div class="row">
					@foreach ($member as $member)
						<div class="col-xs-2">
                            <div class="card card-profile card-plain">
                                <div class="card-avatar">
                                    <a href="{{ url('/member/'.$member->slug) }}">
                                        <img class="img img-raised" src="{{ $member->avatar() }}" data-toggle="tooltip" data-placement="top" title="{{ $member->name }}" data-container="body" data-animation="true" />
                                    </a>
                                </div>
                            </div>
                        </div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
@endsection