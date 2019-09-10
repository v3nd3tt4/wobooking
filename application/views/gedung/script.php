<script type="text/javascript">
	$(document).ready( function () {
	    $('#myTable').DataTable();

	    $(document).on('click', '.btn-tambah-ket', function(e){
	    	e.preventDefault();
	    	var row = '';
	    	var ket = $('.keterangan').val();
	    	var harga_ket = $('.harga_keterangan').val();
	    	row += '<tr>';
	    		row += '<td>';
	    			row += '<input type="text" name="keterangan_r[]" value="'+ket+'" class="form-control"/>';
	    		row += '</td>';
	    		row += '<td>';
	    			row += '<input type="text" name="harga_keterangan_r[]" value="'+harga_ket+'" class="form-control"/>';
	    		row += '</td>';
	    		row += '<td>';
	    			row += '<button class="btn btn-sm btn-danger hapus_ket">Hapus</button>';
	    		row += '</td>';
	    	row += '</tr>';
	    	$('.table-ket tbody').append(row);
	    });

	    $(document).on('click', '.hapus_ket', function(e){
	    	e.preventDefault();
	    	$(this).parent().parent().remove();
	    });
	} );
</script>