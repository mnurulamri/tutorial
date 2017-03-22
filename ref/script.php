<script>
$(document).ready(function () {

$('#spinner').fadeOut();
$('.spinner').fadeOut();

/* Waktu */
$(".jam").clock({"format":"24","calendar":"false"});

/*--------------------------*/

/* ---------------------------------------  update per 16 Maret 2017 ----------------------------*/
//update cicilan koperasi 
$(document).on('focusin', '.cicilan_kop_ke, .cicilan_kop_jml', function(){
    var class_value = $(this).next().attr('class');
    $('.'+class_value).show();
    $(this).select();
});

$(document).on('click', '.batal_cicilan_kop_ke, .batal_cicilan_kop_jml', function(){
    var class_value = $(this).closest('div').attr('class');
    $('.'+class_value).hide();
}); 

   $(document).on('click', '.simpan_cicilan_kop_ke, .simpan_cicilan_kop_jml', function(){
        
        //manipulasi id
        var id_edit = $(this).closest('td').find('span').attr('id'); 
        var id_arr = id_edit.split("|");
        var field = id_arr[0];
        var id = id_arr[1];

        $('.wait_'+field+'_'+id).show();

        //simpan ke database
        var field_userid = id_edit;
        var value = $(this).closest('td').find('span').html();
       
        value = cleanHTML(value);

        var class_value = $(this).closest('div').attr('class');
        
        $.ajax({
            type: "POST",
            url: "potongan/update_counter_cicilan.php",
            data: {field:field,id:id,value:value},
            success: function(data){
                $('.'+class_value).hide();
                $('.wait_'+field+'_'+id).hide();
            }
        }); 
    });
/*--------------------------------------------------------------------------------------*/

$(document).on('click', '.cetak', function(){
    var id = $(this).attr('id');
    var parameter = 'id=' + id;
    window.location.assign("https://remunerasi.fisip.ui.ac.id/tcpdf/examples/tes_notadebet.php?" + parameter);
    //alert(parameter);
});

$(document).on('click', '.setor_simpanan, .bayar-cicilan', function(){
    $('.bayar').toggle();
});

//bayar cicilan
$(document).on('click', '.simpan', function(){
    var id_anggota = $('#data_peminjam').val();
    var tgl = $('#tgl').val();
    var pokok = $('#pokok').val();
    var jasa = $('#jasa').val();

    $.ajax({
        type: "POST",
        url: "pinjaman/add_cicilan.php",
        data: {id_anggota:id_anggota, tgl:tgl, pokok:pokok, jasa:jasa},
        success: function(data){
            $('#result').html(data);
        }
    }); 
    //alert(id_anggota+' '+ pokok +' '+jasa);
});

/*tambahan modul cicilan koperasi*/

$(document).on('keyup','#wajib, #sukarela, #pinjam, #pokok_cicilan, #jasa', function(){
    $(this).val(format($(this).val()));
})

$(document).on('click','#tambah_pinjaman', function(){
    //var text = $('#tgl_pot').val();
    if($('#pinjam').val() == '0'){
        alert('jumlah pinjaman masih 0');
    }

    var id_anggota = $('#data_anggota').val();
    var id_pinjam = $('#id_pinjam').val();
    var id_cicilan = $('#id_cicilan').val();
    var id_jasa = $('#id_jasa').val();
    var tgl = $('#tgl').val();
    var pinjam = $('#pinjam').val().replace(/,/g, '').replace('-', '');
    var pokok_cicilan = $('#pokok_cicilan').val().replace(/,/g, '').replace('-', '');
    var jasa = $('#jasa').val().replace(/,/g, '').replace('-', '');

    //alert(id_anggota +' '+tgl + ' ' + pinjam +' ' + pokok_cicilan +' ' + jasa);

    $.ajax({
        type: "POST",
        url: "pinjaman/update_pinjaman.php",
        data: {
            id_anggota:id_anggota, 
            id_pinjam:id_pinjam,
            id_cicilan:id_cicilan,
            id_jasa:id_jasa,
            tgl:tgl, 
            pinjam:pinjam, 
            pokok_cicilan:pokok_cicilan, 
            jasa:jasa, 
            crud:'2'},
        success: function(data){
            $('#view_pinjaman').html(data);
        }
    }); 
});

$(document).on('click','#bayar_cicilan', function(){
    if($('#pokok_cicilan').val() == '0' && $('#jasa').val() == '0'){
        alert('jumlah cicilan dan jasa koperasi masih 0');
    }
    var id_anggota = $('#data_anggota').val();
    var id_pinjam = $('#id_pinjam').val();
    var id_cicilan = $('#id_cicilan').val();
    var id_jasa = $('#id_jasa').val();
    var tgl = $('#tgl').val();
    var pinjam = $('#pinjam').val().replace(/,/g, '').replace('-', '');
    var pokok_cicilan = $('#pokok_cicilan').val().replace(/,/g, '').replace('-', '');
    var jasa = $('#jasa').val().replace(/,/g, '').replace('-', '');

    //alert(id_anggota +' '+tgl + ' ' + pinjam +' ' + pokok_cicilan +' ' + jasa);

    $.ajax({
        type: "POST",
        url: "pinjaman/update_pinjaman.php",
        data: {
            id_anggota:id_anggota, 
            id_pinjam:id_pinjam,
            id_cicilan:id_cicilan,
            id_jasa:id_jasa,
            tgl:tgl, 
            pinjam:pinjam, 
            pokok_cicilan:pokok_cicilan, 
            jasa:jasa, 
            crud:'1'},
        success: function(data){
            $('#view_pinjaman').html(data);
        }
    }); 
})   

$(document).on('click','#hapus_data', function(){
    if($($('#pinjam').val() == '0' && '#pokok_cicilan').val() == '0' && $('#jasa').val() == '0' ){
        alert('jumlah cicilan dan jasa koperasi masih 0');
    }
    var id_anggota = $('#data_anggota').val();
    var id_pinjam = $('#id_pinjam').val();
    var id_pokok_cicilan = $('#id_pokok_cicilan').val();
    var id_jasa = $('#id_jasa').val();
    var tgl = $('#tgl').val();
    var pinjam = $('#pinjam').val().replace(/,/g, '').replace('-', '');
    var pokok_cicilan = $('#pokok_cicilan').val().replace(/,/g, '').replace('-', '');
    var jasa = $('#jasa').val().replace(/,/g, '').replace('-', '');

    //alert(id_anggota +' '+tgl + ' ' + pinjam +' ' + pokok_cicilan +' ' + jasa +' ' + id_pokok_cicilan +' ' + id_jasa);

    $.ajax({
        type: "POST",
        url: "pinjaman/update_pinjaman.php",
        data: {
            id_anggota:id_anggota, 
            id_pinjam:id_pinjam,
            id_pokok_cicilan:id_pokok_cicilan,
            id_jasa:id_jasa,
            tgl:tgl, 
            pinjam:pinjam, 
            pokok_cicilan:pokok_cicilan, 
            jasa:jasa, 
            crud:'4'},
        success: function(data){
            $('#view_pinjaman').html(data);
        }
    }); 
})   

//setoran simpanan
/*$(document).on('click', '.simpan_setoran', function(){
    var id_anggota = $('#data_anggota').val();
    var tgl = $('#tgl').val();
    var wajib = $('#wajib').val();
    var sukarela = $('#sukarela').val();

    $.ajax({
        type: "POST",
        url: "simpanan/add_simpanan.php",
        data: {id_anggota:id_anggota, tgl:tgl, wajib:wajib, sukarela:sukarela},
        success: function(data){
            $('#result').html(data);
        }
    }); 
    //alert(id_anggota+' '+ pokok +' '+jasa);
});*/

    $( '#wrapper' ).on('click', '#simpanan, #simpanan_anggota, #simpanan_perbulan, #pinjaman,  #pinjaman_anggota, #pengajuan, #cicilan, #potongan, #form_edit_pot, #form_edit_realisasi, #data_pengajuan, #peminjam_bank, #bnihistori', function() { 
        //alert($(this).attr( 'rel' ));
        var judul = $(this).attr( 'id' ).toUpperCase();
        judul = judul.replace('_', ' ');
        $('#beranda-head').html(judul);
        $('.spinner').fadeIn();
        $.post($(this).attr( 'rel' ), function(data){
            $('#data').html(data);   
            $('.spinner').fadeOut();        
        } );
        // $('.spinner').hide();
        return false;
    }); 

    $(document).on('change','#cari_anggota', function(){
        //$('#id_anggota').val($('#cari_anggota').val());
        var text = $('#cari_anggota').val();
        text = text.split(' - ');
        id_anggota = text[0];
        $('#id_anggota').val(id_anggota);

        $.ajax({
            type: "POST",
            url: "pinjaman/sisa_pinjaman.php",
            data: {id_anggota:id_anggota},
            success: function(data){
                $('#sisa_pinjaman').val(data);
                var num = data.replace(/./g, function(c, i, a) {
                        return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c;
                    });
                
                $('#v_sisa_pinjaman').val(num);
            }
        });     
         
        return false;
    });

    $(document).on('click', '#simpan_pengajuan', function(){
        var text = $('#cari_anggota').val();
        text = text.split(' - ');
        var id_anggota = text[0];
        $('#id_anggota').val(id_anggota);
        var tgl = $('#tgl').val();
        var sisa_pinjaman = $('#sisa_pinjaman').val();
        var jml_pinjaman = $('#jml_pinjaman').val();
        var akumulasi_pinjaman = $('#akumulasi_pinjaman').val();
        var lama_cicilan = $('#lama_cicilan').val();
        var cicilan_perbulan = $('#cicilan_perbulan').val();
        var jasa = $('#jasa').val();
        var alasan = $('#alasan').val();
        alert(id_anggota+' ' +tgl + ' '+sisa_pinjaman +' ' +jml_pinjaman+' ' + akumulasi_pinjaman +' ' +cicilan_perbulan +' ' +jasa+ ' '+ alasan)
        $.ajax({
            type: "POST",
            url: "pinjaman/pengajuan/add_pengajuan.php",
            data: {
                    id_anggota:id_anggota, 
                    tgl:tgl, 
                    sisa_pinjaman:sisa_pinjaman, 
                    jml_pinjaman:jml_pinjaman, 
                    akumulasi_pinjaman:akumulasi_pinjaman, 
                    lama_cicilan:lama_cicilan, 
                    cicilan_perbulan:cicilan_perbulan,
                    jasa:jasa,
                    alasan:alasan
                },
            success: function(data){
                $('#test_hasil').html(data);
            }
        }); 
        //alert(id_anggota+' '+ pokok +' '+jasa);
    });

    //simpanan per bulan
    $(document).on('change', '#bulan_simpanan', function(){
        
        var bulan = $('#bulan_simpanan').val();
        var tahun = $('#tahun_simpanan').val();

        $.ajax({
            type: "POST",
            url: "simpanan/data_perbulan.php",
            data: {bulan:bulan, tahun:tahun},
            success: function(data){
                $('#result').html(data);
            }
        }); 
        //alert(bulan+' '+ tahun);
    });

    $(document).on('change', '#tahun_simpanan', function(){
        var bulan = $('#bulan_simpanan').val();
        var tahun = $('#tahun_simpanan').val();

        $.ajax({
            type: "POST",
            url: "simpanan/data_perbulan.php",
            data: {bulan:bulan, tahun:tahun},
            success: function(data){
                $('#result').html(data);
            }
        }); 
        //alert(bulan+' '+ tahun);
    });

    //proses crud simpanan
    $(document).on('click', '#tambah_simpanan', function(){
        //alert('test');
        var id_anggota = $('#data_anggota').val();
        var tgl = $('#tgl').val();
        var wajib = $('#wajib').val();
        var sukarela = $('#sukarela').val();
        
        $.ajax({
            type: "POST",
            url: "simpanan/update_simpanan.php",
            data: {id_anggota:id_anggota, tgl:tgl, wajib:wajib, sukarela:sukarela, crud:'1'},
            success: function(data){
                $('#view_simpanan').html(data);
            }
        }); 
    });
    
    $(document).on('click', '#edit_simpanan', function(){  
        $('#spinner').show();
        var id_wajib = $('#id_wajib').val();
        var id_sukarela = $('#id_sukarela').val(); 
        var id_anggota = $('#data_anggota').val();
        var tgl = $('#tgl').val();
        var wajib = $('#wajib').val();
        var sukarela = $('#sukarela').val();
        $.ajax({
            type: "POST",
            url: "simpanan/update_simpanan.php",
            data: {id_wajib:id_wajib, id_sukarela:id_sukarela, id_anggota:id_anggota, tgl:tgl, wajib:wajib, sukarela:sukarela, crud:'2'},
            success: function(data){
                $('#view_simpanan').html(data);
                $('#spinner').hide();
            }
        });
    });

    $(document).on('click', '#ambil_simpanan', function(){  
        var id_wajib = $('#id_wajib').val();
        var id_sukarela = $('#id_sukarela').val();
        var id_anggota = $('#data_anggota').val();
        var tgl = $('#tgl').val();
        var wajib = $('#wajib').val();
        var sukarela = $('#sukarela').val();
       
        $.ajax({
            type: "POST",
            url: "simpanan/update_simpanan.php",
            data: {id_wajib:id_wajib, id_sukarela:id_sukarela, id_anggota:id_anggota, tgl:tgl, wajib:wajib, sukarela:sukarela, crud:'3'},
            success: function(data){
                $('#view_simpanan').html(data);
            }
        }); 
    });

    $(document).on('click', '#hapus_simpanan', function(){          
        var id_wajib = $('#id_wajib').val();
        var id_sukarela = $('#id_sukarela').val();
        var id_anggota = $('#data_anggota').val();
        var tgl = $('#tgl').val();
        var wajib = $('#wajib').val();
        var sukarela = $('#sukarela').val();
        
        $.ajax({
            type: "POST",
            url: "simpanan/update_simpanan.php",
            data: {id_wajib:id_wajib, id_sukarela:id_sukarela, id_anggota:id_anggota, tgl:tgl, wajib:wajib, sukarela:sukarela, crud:'4'},
            success: function(data){
                $('#view_simpanan').html(data);
            }
        });
    }); 
});

function format(number){ 
    var number = number.replace(/,/g, '');
    var num = number.replace(/./g, function(c, i, a) {
            return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c;
        });
    return num;
    alert(num);
}

function cleanHTML(input) {
  // 1. remove line breaks / Mso classes
  var stringStripper = /(\n|\r| class=(")?Mso[a-zA-Z]+(")?)/g; 
  var output = input.replace(stringStripper, ' ');
  // 2. strip Word generated HTML comments
  var commentSripper = new RegExp('<!--(.*?)-->','g');
  var output = output.replace(commentSripper, '');
  var tagStripper = new RegExp('<(/)*(meta|link|span|p|\\?xml:|st1:|o:|font)(.*?)>','gi');
  // 3. remove tags leave content if any
  output = output.replace(tagStripper, '');
  // 4. Remove everything in between and including tags '<style(.)style(.)>'
  var badTags = ['style', 'script','applet','embed','noframes','noscript'];
  
  for (var i=0; i< badTags.length; i++) {
    tagStripper = new RegExp('<'+badTags[i]+'.*?'+badTags[i]+'(.*?)>', 'gi');
    output = output.replace(tagStripper, '');
  }
  // 5. remove attributes ' style="..."'
  var badAttributes = ['style', 'start'];
  for (var i=0; i< badAttributes.length; i++) {
    var attributeStripper = new RegExp(' ' + badAttributes[i] + '="(.*?)"','gi');
    output = output.replace(attributeStripper, '');
  }
    output = output.replace('&nbsp;', ' ');
  return output;
}
 </script>