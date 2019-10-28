<!DOCTYPE html>
<html>
	<head>
		<meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
		<title>[+interface.store_name+]</title>
		<link rel="stylesheet" type="text/css" href="media/style/[+manager_theme+]/style.css"> 
		<link rel="stylesheet" type="text/css" href="[+site_url+]/assets/modules/contentEditor/css/main.css"> 
		<script type="text/javascript" src="media/script/mootools/mootools.js" ></script>
		<script type="text/javascript" src="media/script/mootools/moodx.js"></script>
		<script type="text/javascript" src="media/script/tabpane.js"></script>
		<script>
		function postForm(){
			document.frm.submit();
		}
		</script>
	</head>
	<body>
		<h1>[+interface.store_name+]</h1>
		<div id="actions">
			<div class="btn-group">		
				<a href="index.php?a=112&id=[+moduleId+]" class="btn btn-success " id="save" onclick="postForm();return false;">[+interface.save+]</a>
				<a class="btn btn-secondary " href="index.php?a=112&id=[+moduleId+]">[+interface.close+]</a>
			
			</div>
		</div>	
		<div class="sectionBody">
			<div class="tab-pane" id="cePanel">
				<script type="text/javascript">
					mypanel = new WebFXTabPane(document.getElementById("cePanel"), true );
				</script>
				<div class="tab-page" id="startTab">
					<h2 class="tab">[+interface.tab1_header+]</h2>
					<script type="text/javascript">mypanel.addTabPage(document.getElementById("startTab"));</script>
					<div>
						<form name="frm" class="content" method="post" enctype="multipart/form-data">
							<table class="grid">
								<tbody>
									[+work+]									
								</tbody>
							</table>
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>