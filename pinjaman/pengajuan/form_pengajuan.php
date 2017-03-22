<script src="../bootstrap/js/bootstrap3-typeahead.min.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="../lib/jsdatepick/jsDatePick_ltr.min.css" />
<script type="text/javascript" src="../lib/jsdatepick/jsDatePick.min.1.3.js"></script>
<script type="text/javascript">


	//cari anggota
    $('#cari_anggota').typeahead({
    //alert('test');
        source: function(request, response) 
        {
            var search_key = $("#cari_anggota").val();
           
            $.ajax({
                url: "cari_anggota.php",
                type: "POST",
                dataType: "json",
                data:"search_key=" + search_key,
                /*data:{
                    search_key: query
                },*/
                success: function(data){                    
                    response( $.map( data, function(item)
                    {
                        return item.id_anggota +' - '+ item.nama;                   
                    }));
                }
            });
        },  

    });

	function format(number){ 
	    var num = number.replace(/./g, function(c, i, a) {
	            return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c;
	        });
	    return num;
	    //alert(num);
	}

	function jmlPinjaman(duit){
		var duit = duit.replace(/,/g, '');
		var jml_pinjaman = parseInt(duit);
		document.getElementById('v_jml_pinjaman').value = format(duit);
		$('#jml_pinjaman').val(jml_pinjaman);	
		var sisa_pinjaman = $('#sisa_pinjaman').val();
		sisa_pinjaman = sisa_pinjaman.replace(/,/g, '');
		sisa_pinjaman = parseInt(sisa_pinjaman);
		jml_pinjaman = parseInt(jml_pinjaman);		
		akumulasi = sisa_pinjaman + jml_pinjaman;
		$('#akumulasi_pinjaman').val(akumulasi);
		document.getElementById('v_akumulasi_pinjaman').value = format($('#akumulasi_pinjaman').val());

		//cicilan
		var lama_cicilan = parseInt($('#lama_cicilan').val());
		var cicilan_perbulan = akumulasi / lama_cicilan;
		$('#cicilan_perbulan').val(cicilan_perbulan);
		document.getElementById('v_cicilan_perbulan').value = format($('#cicilan_perbulan').val());

		//jasa
		var jasa = akumulasi * 0.01;
		$('#jasa').val(jasa);
		document.getElementById('v_jasa').value = format($('#jasa').val());
	}

	function lamaCicilan (n)
	{
		//cicilan per bulan
		var akumulasi = parseInt($('#akumulasi_pinjaman').val());
		var cicilan_perbulan = akumulasi / n;
		$('#cicilan_perbulan').val(cicilan_perbulan);
		document.getElementById('v_cicilan_perbulan').value = format($('#cicilan_perbulan').val());

		//jasa koperasi
		var jasa = cicilan_perbulan * 0.1;  //sebelumnya => akumulasi * 0.01
		$('#jasa').val(jasa);
		document.getElementById('v_jasa').value = format($('#jasa').val());
	}

	function tanggalan()
	{
		new JsDatePick({
			useMode:2,
			target:"tgl",
			dateFormat:"%Y-%m-%d"
			/*selectedDate:{				This is an example of what the full configuration offers.
				day:5,						For full documentation about these settings please see the full version of the code.
				month:9,
				year:2006
			},
			yearsRange:[1978,2020],
			limitToToday:false,
			cellColorScheme:"beige",
			dateFormat:"%m-%d-%Y",
			imgPath:"img/",
			weekStartDay:1*/
		});
	}
</script>

	<div class="row">
		<div class="col-md-offset-3 col-md-6">
			<!--<form name="fHasil" id="fHasil" method="post">-->
				<div style="margin-top:20px;">		
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title">Pengajuan Pinjaman Koperasi</h3>
						</div>
						<div class="panel-body">
											
								<input type="hidden" id="id_anggota" name="id_anggota"/>
								<div class="form-group">
									<label for="cari_anggota">Nama Anggota</label>
									<input type="text" id="cari_anggota" name="cari_anggota"  class="form-control" placeholder="cari berdasarkan penggalan nama" autocomplete="off"/>
								</div>
								<div class="form-group">
									<label for="tgl">Tanggal</label>
									<input type="text" id="tgl" name="tgl"  class="form-control" placeholder="tanggal" onclick="tanggalan()"/>
								</div>
								<div class="form-group">
									<label for="jml_pinjaman">Sisa Pinjaman Sebelumnya</label>
									<input type="hidden" class="form-control" id="sisa_pinjaman" placeholder="sisa jumlah pinjaman sebelumnya">
									<input type="text" class="form-control" id="v_sisa_pinjaman" placeholder="sisa jumlah pinjaman sebelumnya">
								</div>
								<div class="form-group">
									<label for="jml_pinjaman">Pengajuan Jumlah Pinjaman</label>
									<div class="row">
										<div class="col-md-4">
											<input type="text" class="form-control" id="v_jml_pinjaman" placeholder="jumlah pinjaman" onkeyup="jmlPinjaman(this.value)">
											<input type="hidden" class="form-control" id="jml_pinjaman">
										</div>
										<div class="col-md-4">
											<input type="text" class="form-control" id="v_akumulasi_pinjaman" placeholder="akumulasi pinjaman">
											<input type="hidden" class="form-control" id="akumulasi_pinjaman" placeholder="akumulasi pinjaman">
										</div>
									</div>
									
									
								</div>
								<div class="form-group">
									<label for="lama_cicilan">Lama Cicilan</label>
									<input type="text" class="form-control" id="lama_cicilan" placeholder="jumlah cicilan maksimal 10X" onkeyup="lamaCicilan(this.value)">
								</div>
								<div class="form-group">
									<label for="jml_cicilan">Cicilan Per Bulan</label>
									<input type="text" class="form-control" id="v_cicilan_perbulan" placeholder="cicilan per bulan">
									<input type="hidden" class="form-control" id="cicilan_perbulan">
								</div>
								<div class="form-group">
									<label for="jasa">Jasa Koperasi</label>
									<input type="text" class="form-control" id="v_jasa" placeholder="jasa koperasi">
									<input type="hidden" class="form-control" id="jasa">
								</div>
								<div class="form-group">
									<label for="keterangan">Keperluan</label>
									<input type="text" id="alasan" name="alasan"  class="form-control" placeholder="alasan pengajuan pinjaman" autocomplete="off"/>
								</div>
								<div style="padding:5px; text-align:right">
									<!--<input id="screen" name="submit" type="submit" value="screen" class="btn btn-primary btn-sm"/>-->
									<!-- Button trigger modal -->
									<button id="simpan_pengajuan" class="btn btn-primary btn-sm">simpan</button>
									<input type="reset" value="clear" name="reset" id="reset" class="btn btn-danger btn-sm" onclick="document.getElementById('id_anggota').focus();"/>
									<span id="warning-cari" class="btn btn-warning btn-sm" style="display:none">data yang dicari masih kosong..</span>
								</div>
						</div>
					</div>				
				</div>
			<!--</form>-->
		</div>
	</div>

	<div id="test_hasil"></div>