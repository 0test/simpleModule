<!DOCTYPE html>
<html>
	<head>
		<meta content="text/html; charset=[+modx_charset+]" http-equiv="Content-Type">
		<title>[+interface.store_name+]</title>
		<link rel="stylesheet" type="text/css" href="[+manager_path+]/media/style/[+manager_theme+]/style.css"> 
		<link rel="stylesheet" type="text/css" href="[+base_url+]assets/modules/exampleModule/css/main.css"> 
		<script type="text/javascript" src="[+manager_path+]/media/script/mootools/mootools.js" ></script>
		<script type="text/javascript" src="[+manager_path+]/media/script/mootools/moodx.js"></script>
		<script type="text/javascript" src="[+manager_path+]/media/script/tabpane.js"></script>
	</head>
	<body>
		<h1>[+interface.store_name+]</h1>
		<div id="actions">
			<ul class="actionButtons">
				<li id="Button1">
					<a href="#" onclick="document.location.href=document.location.href;">[+interface.refresh+]</a>
				</li>
			</ul>
		</div>	
		<div class="sectionBody">
			<p>[+interface.module_description+]</p>
			<div class="tab-pane" id="tabPanel">
				<script type="text/javascript">
					mypanel = new WebFXTabPane(document.getElementById("tabPanel"), true);
				</script>
				<div class="tab-page" id="startTab">
					<h2 class="tab">[+interface.tab1_header+]</h2>
					<script type="text/javascript">mypanel.addTabPage(document.getElementById("startTab"));</script>
					<div>
						<table class="grid">
							<thead>
								<tr>
									<td  class="gridHeader">[+interface.table_id+]</td>
									<td  class="gridHeader">[+interface.table_header+]</td>
									<td  class="gridHeader">[+interface.table_header2+]</td>
									<td  class="gridHeader">[+interface.table_action+]</td>
								</tr>
							</thead>
							<tbody>
								[+work+]
							</tbody>
						</table>
					</div>
					<p>[+interface.tab1_description+]</p>
				</div>	
				<div class="tab-page" id="startTab2">
					<h2 class="tab">[+interface.tab2_header+]</h2>
					<script type="text/javascript">mypanel.addTabPage( document.getElementById("startTab2"));</script>
					<div>
						[+interface.tab1_text+]
					</div>
				</div>	
			</div>
		</div>
	</body>
</html>