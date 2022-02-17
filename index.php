<?php session_start(); ?>

<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
	<style>
		.container .footer {
			text-align: center;
			font: 12px "Microsoft YaHei";
		}
	</style>
	<script>
		function resizeIframe(obj) {
			obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
		}
	</script>
</head>

<body id="top">
	<div class="wrapper row0">
		<div id="topbar" class="hoc clear">
			<table id="table">
				<tr>
					<div class="divTable minimalistBlack">
						<div class="divTableBody">
							<td><a href="http://www.umac.mo/" target="_blank"><img src="./layout/um_logo_selected_1.png" style="width:1250px;height:110px;margin-right:10px" align="left" /></a>
							</td>
						</div>
					</div>
				</tr>
			</table>
		</div>
	</div>
	<div class="wrapper row1">
		<header id="header" class="hoc clear">
			<hr>
			<nav id="mainav" class="fl_left">
				<ul class="clear">
					<li class><a href="home.php" target="myiframe">Home</a></li>
					<li><a class="drop" href="#">Services Request</a>
						<ul>
							<li><a href="hiseq_reagent.php" target="myiframe">Reagent Request</a></li>
							<li><a href="bioanalyzer.php" target="myiframe">Bioanalyzer</a></li>
							<li><a href="c1.php" target="myiframe">C1</a></li>
							<li><a href="chromium10x.php" target="myiframe">Chromium 10x Genomics</a></li>
							<li><a href="cytation.php" target="myiframe">Cytation</a></li>
							<li><a href="cytof.php" target="myiframe">CyTOF</a></li>
							<li><a href="dropletpcr.php" target="myiframe">Droplet Digital PCR</a></li>
							<li><a href="freeze_drier.php" target="myiframe">Freeze-drier</a></li>
							<li><a href="hyperion.php" target="myiframe">Hyperion</a></li>
							<li><a class="drop" href="ngs_choose_service.php" target="myiframe">Next Gen Sequencing</a>
								<ul>
									<li><a href="hiseq.php" target="myiframe">FHS Illumina Sequencing Service</a></li>
									<li><a href="novogene_hiseq.php" target="myiframe">Novogene Sequencing Service</a></li>
								</ul>
							</li>
							<li><a href="sangerseq.php" target="myiframe">Sanger Sequencing</a></li>
							<li><a href="microarray.php" target="myiframe">Microarray (not in service)</a></li>
							<li><a href="under-construction.php" target="myiframe">Bioinformatics Request</a></li>
						</ul>
					</li>
					<li><a class="drop" href="#">Equipment overview</a>
						<ul>
							<li><a href="bioanalyzer_sample_preparation.php" target="myiframe" style="width:210px">Bioanalyzer</a></li>
							<li><a href="c1_sample_preparation.php" target="myiframe" style="width:210px">C1</a></li>
							<li><a href="chef_mapper.php" target="myiframe" style="width:210px">CHEF Mapper</a></li>
							<li><a href="Chromium_10x_Genomics_sample_preparation.php" target="myiframe" style="width:210px">Chromium 10x Genomics</a></li>
							<li><a href="cytof_sample_preparation.php" target="myiframe" style="width:210px">CyTOF</a></li>
							<li><a href="ddpcr.php" target="myiframe" style="width:210px">Droplet Digital PCR</a></li>
							<li><a href="nadia.php" target="myiframe" style="width:210px">NADIA</a></li>
							<li><a href="ngs_sample_preparation.php" target="myiframe" style="width:210px">NGS</a></li>
							<li><a href="qiacube.php" target="myiframe" style="width:210px">QIAcube</a></li>
							<li><a href="sanger_sample_preparation.php" target="myiframe" style="width:210px">Sanger</a></li>
							<li><a href="microarray_sample_preparation.php" target="myiframe" style="width:210px">Microarray</a></li>
							<li><a href="freezedrier_introduction.php" target="myiframe" style="width:210px">Freeze-drier</a></li>
						</ul>
					</li>
					<li><a class="drop" href="#">Help</a>
						<ul>
							<li><a href="under-construction.php" target="myiframe">Bioinformatics</a></li>
							<li><a href="change_password.php" target="myiframe">Change Password</a></li>
						</ul>
					</li>
					<li><a href="administration.php" target="myiframe">Administration</a></li>
					<li><a href="contactus.php" target="myiframe">Contact Us</a></li>
					<li><a href="publication.php" target="myiframe">Publications</a></li>
					<li><a href="login.php" target="myiframe">Login</a></li>
				</ul>
			</nav>
			<hr>
		</header>

	</div>
	<div class="container">
		<iframe align="right" src="./home.php" name="myiframe" width="100%" height="100" marginwidth="0" margin="0" frameborder="0" scrolling="yes" onload="resizeIframe(this)" />
		</iframe>

		<p class="footer"> &copy; 2021 Faculty of Health Sciences (FHS). All rights reserved.<br>
			Tech Support: yb77630@connect.umac.mo
		</p>
	</div>
</body>

</html>