<?php require "MasterPage/header.php"; ?>

  <link rel="stylesheet" href="dgoguerra-bootstrap-menu-7d3b8f0/css/bootstrap.css">
  <script src="dgoguerra-bootstrap-menu-7d3b8f0/dist/BootstrapMenu.min.js"></script>
<style>
#demo1Box:active {
    background-color: #e8f0fe;
}
#demo1Box:focus {
    background-color: #e8f0fe;
}
</style>



<div class="row">
	<div class="col-auto mb-3" >
		<div id="demo1Box" style="padding: 3px 11px;border-radius: 6px;border: 1px solid #dadce0;width: 210px;transition: box-shadow 200ms cubic-bezier(0.4,0.0,0.2,1);"  draggable="true" ondragstart="drag(event)">
			<div class="row">
				<div class="col-4">
					<i class="fas fa-folder fa-3x" style="color: #8f8f8f"></i>					
				</div>					
				<div class="col-8" style=" display: flex;align-items: center;flex-wrap: wrap;">
					<?php
						$string="this is a test of folder";
					?>
					<p class="" title="<?= $string?>">
						<?php
							if (strlen($string) > 14)
							{						
								$string = substr($string,0,14)." ..";
							} 
							echo $string;
						?>
					</p>
				</div>
			</div>
		</div>
	</div>	
</div>

<script>
	function drag(ev) {
  ev.dataTransfer.setData("text", ev.target.id);
}
</script>

<script>        	
	var menu = new BootstrapMenu('#demo1Box', {
	actions: [{
	name: '<a style="color: #8f8f8f;" href="#"><i class="fas fa-folder-open"></i>&nbsp;&nbsp;&nbsp;Open</a>',
	onClick: function() {
	toastr.info("'Action' clicked!");
	}
	}, {
	name: '<a style="color: #8f8f8f;" href="#"><i class="fas fa-folder-minus"></i>&nbsp;&nbsp;&nbsp;Delete</a>',
	onClick: function() {
	toastr.info("'Another action' clicked!");
	}
	}, {
	name: '<a style="color: #8f8f8f;" href="#"><i class="fas fa-link"></i>&nbsp;&nbsp;&nbsp;Get url</a>',
	onClick: function() {
	toastr.info("'A third action' clicked!");
	}
	}]
	});
</script>

<?php require "MasterPage/footer.php"; ?>