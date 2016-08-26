<style>
	body {
		padding: 0px;
		margin: 0px;
		font: normal normal 400 14px/170% Arial;
		color: #333333;
		text-align: justify;
	}
	* {
		padding: 0px;
		margin: 0px;
	}
	#opanda-preview {
		position:relative;
		padding: 40px 0;
		border: 5px solid #f6f6f6;
		box-shadow: inset 0 0 10px rgba(0,0,0,0.2);
		background: #fbfbfb url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQAQMAAAAlPW0iAAAABlBMVEX4+Pj09PQf/c7fAAAAGUlEQVR4XnXIMQ0AAACDMPyb3gxA0qswVX1+vw/xW46qyAAAAABJRU5ErkJggg==') repeat;
		overflow: hidden;
	}
	#opanda-preview .onp-preview-loader {
		position: absolute;
		top:0; left:0; right:0; bottom:0;
		background: rgba(255, 255, 255, 0.9) url('../../assets/ebcf69fe/img/large-loader.gif') center center no-repeat;
		z-index: 999;
	}
	p {
		margin: 0px;
	}
	p + p {
		margin-top: 8px;
	}
	.content-to-lock a {
		color: #3185AB;
	}
	.content-to-lock {
		text-shadow: 1px 1px 1px #fff;
		padding: 20px 40px;
	}
	.content-to-lock .header {
		margin-bottom: 20px;
	}
	.content-to-lock .header strong {
		font-size: 16px;
		text-transform: capitalize;
	}
	.content-to-lock .image {
		text-align: center;
		background-color: #f9f9f9;
		border-bottom: 3px solid #f1f1f1;
		margin: auto;
		padding: 30px 20px 20px 20px;
	}
	.content-to-lock .image img {
		display: block;
		margin: auto;
		margin-bottom: 15px;
		max-width: 460px;
		max-height: 276px;
		height: 100%;
		width: 100%;
	}
	.content-to-lock .footer {
		margin-top: 20px;
	}
</style>
<div id="opanda-preview" style="text-align: center; margin: 0 0 30px 0;">
	<div class="content-to-lock" style="text-align: center; margin: 0 auto; max-width: 700px;">

		<div class="header">
			<p><strong>Lorem ipsum dolor sit amet, consectetur adipiscing</strong></p>
			<p>
				Maecenas sed consectetur tortor. Morbi non vestibulum eros, at posuere nisi praesent consequat.
			</p>
		</div>
		<div class="image">
			<img src="https://sociallocker.ru/wp-content/themes/sociallocker/assets/img/droodfilder.jpg" alt="Preview image" />
			<i>Aenean vel sodales sem. Morbi et felis eget felis vulputate placerat.</i>
		</div>
		<div class="footer">
			<p>Curabitur a rutrum enim, sit amet ultrices quam.
				Morbi dui leo, euismod a diam vitae, hendrerit ultricies arcu.
				Suspendisse tempor ultrices urna ut auctor.</p>
		</div>
	</div>
	<div class="onp-preview-loader"></div>
</div>
<div style="clear: both;"></div>