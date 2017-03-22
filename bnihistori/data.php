<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>BNI History</title>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="title" content="Samples" />
	<meta name="keywords" content="" />
	<meta name="description" content="" />	
	
	<link rel="icon" href="../common/favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" href="../common/favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" href="../../dhtmlx/dhtmlxGrid/samples/common/css/style.css" type="text/css" media="screen" />
	
	<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
	
	<link rel="stylesheet" type="text/css" href="../../dhtmlx/dhtmlxGrid/codebase/dhtmlxgrid.css">
	<link rel="stylesheet" type="text/css" href="../../dhtmlx/dhtmlxGrid/codebase/skins/dhtmlxgrid_dhx_skyblue.css">
	
	<script src="../../dhtmlx/dhtmlxGrid/codebase/dhtmlxcommon.js"></script>
	<script src="../../dhtmlx/dhtmlxGrid/codebase/dhtmlxgrid.js"></script>
	<script src="../../dhtmlx/dhtmlxGrid/codebase/dhtmlxgridcell.js"></script>
	
	<script src="../../dhtmlx/dhtmlxGrid/codebase/ext/dhtmlxgrid_filter.js"></script>  <!-- filter kolom -->
	<script src="../../dhtmlx/dhtmlxConnector/codebase/connector.js"></script>
	
	<!--<script src="../../dhtmlx/dhtmlxDataProcessor/codebase/dhtmlxdataprocessor.js"></script>	 untuk crud otomatis -->	
	<!--<script src="../dhtmlx/dhtmlxDataProcessor/codebase/dhtmlxdataprocessor_debug.js"></script>
	
    <link rel="stylesheet" href="../css/menu_ujian.css" type="text/css" media="screen" />-->
</head>

<body>

	<?#include("menu_tes.html")?>

	<div id="gridbox" style="height:100%"></div>
	
	<script>

		//---grid initialization
		mygrid = new dhtmlXGridObject("gridbox");
		mygrid.setImagePath("../../dhtmlx/dhtmlxGrid/codebase/imgs/");
		mygrid.setHeader("id, post_date, value_date, branch, journal_no, description, debit, credit, norek, nama, bulan, tahun");
		//mygrid.setInitWidths("0, 70, 70, 30, 30, 170, 50, 50, 70, 80, 20, 20");
		mygrid.setInitWidths("0, 80, 80, 50, 50, *, 70, 70, 70, 150, 50, 50");
		<?#include("ruang.js");?>	
		
		mygrid.setColTypes("co,co,co,co,co,co,ed,ed,co,ed,co,co");
		mygrid.attachHeader("#connector_text_filter,#connector_text_filter,#connector_text_filter,#connector_text_filter,#connector_text_filter,#connector_text_filter,#connector_text_filter,#connector_text_filter,#connector_text_filter,#connector_text_filter,#connector_text_filter,#connector_text_filter");
		mygrid.setColSorting("connector,connector,connector,connector,connector,connector,connector,connector,connector,connector,connector,connector");
		mygrid.setSkin("dhx_skyblue");
		mygrid.init();
		mygrid.loadXML("get_data.php");
		
		//---dataProcessor initialization
		//var dp = new dataProcessor("crud/update.php");	
		
		//dp.init(mygrid);
		
		//dp.sendData();
		
	</script>