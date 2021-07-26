<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		@{{ HTML::style('/css/telegram.css')}}
    </head>
	<body>
		<div style="padding:1px;">
			<table border="0px" style="margin-top:20px;">
		  		<tr style="">
					<td style="text-align:center;">KEPOLISIAN NEGARA REPUBLIK INDONESIA</td>
				</tr>
				<tr style="">
					<td style="text-align:center;">DAERAH JAWA TIMUR</td>
				</tr>
				<tr style="">
					<td style="text-align:center; border-bottom:1px solid;">RESORT JOMBANG</td>
				</tr>
		  	</table>

		  	<table align="center" style=" margin-top:20px; margin-bottom:20px; ">
		  		<tr style="">
					<td style="text-align:center;">
						@{{ HTML::image('/images/tribrata.jpg', 'alt', array( 'width' => 55 )) }}
					</td>
				</tr>
				<tr style="">
					<td style="text-align:center;">
						SURAT PERINTAH
					</td>
				</tr>
				<tr style="">
					<td style="text-align:center; border-top:1px solid;">
						Nomor : @{{ $sprin->sprin_nomor }}
					</td>
				</tr>
		  	</table>
		  	
		  	<table border="0px">
		  		<tr style="">
					<td style="">PERTIMBANGAN</td>
					<td style=""> : </td>
					<td style="">@{{ $sprin->sprin_pertimbangan }}</td>
				</tr>
				<tr style="">
					<td style=""></td>
					<td style=""></td>
					<td style=""></td>
				</tr>
				<tr style="">
					<td style="">DASAR</td>
					<td style=""> : </td>
					<td style="">@{{ $sprin->sprin_dasar }}</td>
				</tr>	
				<tr style="">
					<td colspan="3" style="text-align:center; padding:15px;">DIPERINTAHKAN</td>
				</tr>
		  		<tr style="">
					<td style="">KEPADA</td>
					<td style=""> : </td>
					<td style="">@{{ $sprin->sprin_kepada }}</td>
				</tr>
				<tr style="">
					<td style=""></td>
					<td style=""></td>
					<td style=""></td>
				</tr>
				<tr style="">
					<td style="">UNTUK</td>
					<td style=""> : </td>
					<td style="">@{{ $sprin->sprin_untuk }}</td>
				</tr>
				<tr style="">
					<td style=""></td>
					<td style=""></td>
					<td style=""></td>
				</tr>
				<tr style="">
					<td style="">SELESAI</td>
					<td style=""></td>
					<td style=""></td>
				</tr>
		  	</table>

		  	<table border="0px" style="float:right; margin-top: 25px;">
		  		<tr style="">
					<td style="">Dikeluarkan di</td>
					<td style="text-align:center;"> : </td>
					<td style="">@{{ $sprin->sprin_dikeluarkan_di }}</td>
				</tr>
				<tr style="border-bottom:1px solid;">
					<td style="">pada tanggal</td>
					<td style="text-align:center;"> : </td>
					<td style="">@{{ $tglSprin }}</td>
				</tr>
				<tr style="">
					<td colspan="3" style="text-align:center;">@{{ $sprin->sprin_jabatan }}</td>
				</tr>
				<tr style="">
					<td colspan="3" style="height:50px;"></td>
				</tr>
				<tr style="">
					<td colspan="3" style="text-align:center;">@{{ $sprin->sprin_pengirim }}</td>
				</tr>
				<tr style="">
					<td colspan="3" style="text-align:center;">@{{ $sprin->sprin_pangkat }} NRP: @{{ $sprin->sprin_nrp }}</td>
				</tr>
		  	</table>

		  	<table border="0px" style="margin-top: 25px;">
		  		<tr style="">
					<td style="">Tembusan : </td>
				</tr>
				<tr style="">
					<td style="border-top:1px solid;">@{{ $sprin->sprin_tembusan }}</td>
				</tr>
		  	</table>
	  	</div>

	  	
	  	<div style="page-break-after:always;"></div>
		
		
	  	<div style="padding:1px;">
	  		<div style="padding:1px;">
				<table border="0px" style="margin-top:20px; float:left;">
			  		<tr style="">
						<td style="text-align:center;">KEPOLISIAN NEGARA REPUBLIK INDONESIA</td>
					</tr>
					<tr style="">
						<td style="text-align:center;">DAERAH JAWA TIMUR</td>
					</tr>
					<tr style="">
						<td style="text-align:center; border-bottom:1px solid;">RESORT JOMBANG</td>
					</tr>
			  	</table>

			  	<table border="0px" style="margin-top:20px; float:right;">
			  		<tr style="">
						<td style="text-align:center;">LAMPIRAN SPRIN @{{ $sprin->sprin_jabatan }}</td>
					</tr>
					<tr style="">
						<td style="text-align:center;">NOMOR : @{{ $sprin->sprin_nomor }}</td>
					</tr>
					<tr style="">
						<td style="text-align:center; border-bottom:1px solid;">TANGGAL : @{{ $tglSprin }}</td>
					</tr>
			  	</table>
		  	</div>

		  	<table border="1px" style="margin-top:100px; width:100%; border:1px solid;">
		  		<thead>
					<tr>
						<th style="width:5%"><strong>NO</strong></th>
						<th><strong>NAMA</strong></th>
						<th style="width:12%"><strong>PANGKAT</strong></th>
						<th style="width:12%"><strong>NRP</strong></th>
						<th style="width:20%"><strong>JABATAN</strong></th>
						<th style="width:20%"><strong>DALAM OPS</strong></th>
					</tr>
					<tr>
						<th style="text-align:center;"><strong>1</strong></th>
						<th style="text-align:center;"><strong>2</strong></th>
						<th style="text-align:center;"><strong>3</strong></th>
						<th style="text-align:center;"><strong>4</strong></th>
						<th style="text-align:center;"><strong>5</strong></th>
						<th style="text-align:center;"><strong>6</strong></th>
					</tr>
				</thead>
				<tbody>
					<?php $idx = 1; ?>
					@foreach ($detailOps as $valDetailOps)
					<tr>
						<td style="text-align:center;">@{{ $idx++ }}</td>
						<td>@{{ $valDetailOps->nama_lengkap }}</td>
						<td style="text-align:center;">@{{ $valDetailOps->pangkat }}</td>
						<td style="text-align:center;">@{{ $valDetailOps->nrp }}</td>
						<td style="text-align:center;">@{{ $valDetailOps->jabatan }}</td>
						<td style="text-align:center;">@{{ $valDetailOps->keterangan_detail_op }}</td>
					</tr>
					@endforeach
				</tbody>
		  	</table>

		  	<table border="0px" style="float:right; margin-top: 25px;">
		  		<tr style="border-bottom:1px solid;">
					<td style="">@{{ $sprin->sprin_dikeluarkan_di }}, </td>
					<td style="">@{{ $tglSprin }}</td>
				</tr>
				<tr style="">
					<td colspan="2" style="text-align:center;">@{{ $sprin->sprin_jabatan }}</td>
				</tr>
				<tr style="">
					<td colspan="2" style="height:50px;"></td>
				</tr>
				<tr style="">
					<td colspan="2" style="text-align:center;">@{{ $sprin->sprin_pengirim }}</td>
				</tr>
				<tr style="">
					<td colspan="2" style="text-align:center;">@{{ $sprin->sprin_pangkat }} NRP: @{{ $sprin->sprin_nrp }}</td>
				</tr>
		  	</table>
	  	</div>
	</body>
</html>