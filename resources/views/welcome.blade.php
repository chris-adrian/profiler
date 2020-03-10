
@extends('layouts.app')

@section('content')
<div>
	<div class="responsive-wrapper">
		<!-- <iframe class="responsive-content" src="video-cover.mp4" style="pointer-events: none;" controls="0" loop autoplay="autoplay" frameborder="0"></iframe> -->
		<video class="responsive-content" loop autoplay muted>
		  <source src="video-cover.mp4" type="video/mp4">
		  Your browser does not support the video tag.
		</video>
		<div class="responsive-content layer">
			<table>
				<tbody>
					<tr>
						<td>
							<h1><b>PRO.</b><small>filer</small></h1>
							<p>A test project made with laravel and react</p>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection

