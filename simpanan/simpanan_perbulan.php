<form name="formInquiry">
	<select name="bulan" id="bulan_simpanan">
		<option value="05">Mei</option>
		<option value="06">Juni</option>
		<option value="07">Juli</option>
		<option value="08">Agustus</option>
		<option value="09">September</option>
		<option value="10">Oktober</option>
		<option value="11">September</option>
		<option value="12">Desember</option>
	</select>
	<select name="tahun" id="tahun_simpanan">
		<option value="2016">2016</option>
		<option value="2015">2015</option>
	</select>
	<input type="submit" value="submit" id="data_perbulan">
</form>

<div id="result"></div>

<style>
tbody tr:nth-child(odd) {
   background-color: #eed;
}

tr {
/*width: 100%;
display: inline-table;*/
height:20px;
/*table-layout: fixed;  */
}

table{
 height:100%; 
 margin: auto;
 display: -moz-groupbox;
}

tbody{
  overflow-y: scroll;
  height: 500px;
  width: 110%;
  position: absolute;
	-ms-overflow-style: none;
}	

tbody::-webkit-scrollbar {
	display:none;
}
</style>