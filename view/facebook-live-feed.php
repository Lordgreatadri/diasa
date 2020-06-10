<?php
include "controllers/db-config.php";
// session_start();
// if (!isset($_SESSION['gbmbUserLoggedIn'])) {
// 	echo "<script>window.location.href = 'index.php';</script>";
// }

$current_vid_id = "USpOqBa-kMY";
$query = mysqli_query($database,"SELECT `video_id`  FROM live_stream LIMIT 1");
while($row = mysqli_fetch_assoc($query)){
	$current_vid_id = $row['video_id'];
}

include 'includes/header.php';
?>	
<style>
	body {
		background-image: url('assets/img/live_feed_bg.jpeg');
		background-attachment: fixed;
	}

	.video-div {
		margin-top: 40vh;
		box-shadow: 3px 5px 7px rgba(0, 0, 0, 0.8);
		margin-left: 0px;
		margin-left: 0px;
		padding: 0px;
	}
</style>

	<!-- Load Facebook SDK for JavaScript -->
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6 col-sm-12 col-xs-12">
				<div id="fb-root"></div>
				<script>(function(d, s, id) {
					var js, fjs = d.getElementsByTagName(s)[0];
					if (d.getElementById(id)) return;
						js = d.createElement(s); js.id = id;
						js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6";
						fjs.parentNode.insertBefore(js, fjs);
					}(document, 'script', 'facebook-jssdk'));
				</script>

				<!-- Your embedded video player code -->
				<div class="fb-video video-div" data-href="<?php echo $current_vid_id; ?>" data-width="500" data-show-text="false">
					<div class="fb-xfbml-parse-ignore">
						<blockquote cite="<?php echo $current_vid_id; ?>">
							<a href="<?php echo $current_vid_id; ?>">How to Share With Just Friends</a>
							<p>How to share with just friends.</p>
							Posted by <a href="https://www.facebook.com/facebook/">Facebook</a> on Friday, December 5, 2014
						</blockquote>
					</div>
				</div><br><br>

				<a href="<?php echo $current_vid_id; ?>" class="btn btn-lg btn-block btn-primary">Go To Facebook</a>

			</div>
			<div class="col-md-3"></div>
		</div>
	</div>
<?php include 'includes/footer.php'; ?>