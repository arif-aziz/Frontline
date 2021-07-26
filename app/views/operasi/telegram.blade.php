<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		@{{ HTML::style('/css/telegram.css')}}
    </head>
	<body style="width:793.700787402px; height:1099.842519685px;">
		<div style="padding:20px 5px; border-bottom:1px dashed #999;">
			<button onclick="window.location.href='@{{ URL::to('operasi/dokumen', $telegram->id_operasi) }}'">Kembali</button>
			<button onclick="window.location.href='@{{ URL::to('cetak/telegram', $telegram->id_operasi) }}'" style="float:right">Cetak</button>
		</div>
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

	  	<table style="width:100%; margin-top:20px; margin-bottom:20px; ">
	  		<tr style="">
				<td style="text-align:center;">
					@{{ HTML::image('/images/tribrata.jpg', 'alt', array( 'width' => 55 )) }}
				</td>
			</tr>
			<tr style="">
				<td style="text-align:center;">
					SURAT TELEGRAM
				</td>
			</tr>
	  	</table>

	  	<table style="width:100%; margin-bottom: 10px;" border="0px">
	  		<tr style="">
				<td style="width:10%">DARI</td>
				<td style="width:1%"> : </td>
				<td style="width:60%">@{{ $telegram->tgram_dari }}</td>
				<td style="width:10%">DERAJAT</td>
				<td style="width:1%"> : </td>
				<td style="">@{{ $telegram->tgram_derajat }}</td>
			</tr>
			<tr style="">
				<td style="width:10%">KEPADA</td>
				<td style="width:1%"> : </td>
				<td style="width:60%">@{{ $telegram->tgram_kepada }}</td>
				<td style="width:10%">KLASIFIKASI</td>
				<td style="width:1%"> : </td>
				<td style="">@{{ $telegram->tgram_klasifikasi }}</td>
			</tr>
			<tr style="">
				<td style="width:10%">TEMBUSAN</td>
				<td style="width:1%"> : </td>
				<td style="width:60%">@{{ $telegram->tgram_tembusan }}</td>
				<td style="width:10%"></td>
				<td style="width:1%"></td>
				<td style=""></td>
			</tr>
		</table>
		
		<div style="border-bottom:1px solid; margin: 0 2px;"></div>
		
		<table style="width:100%; margin-top: 10px;" border="0px">
			<tr style="">
				<td style="width:10%">NOMOR</td>
				<td style="width:1%"> : </td>
				<td style="width:60%">@{{ $telegram->tgram_nomor }}</td>
				<td style="width:10%">TANGGAL</td>
				<td style="width:1%"> : </td>
				<td style="">@{{ $tglTgram }}</td>
			</tr>
	  	</table>

	  	<table style="width:100%; margin-top: 10px;" border="0px">
			<tr style="">
				<td style="width:10%">AAA</td>
				<td style="width:10%">TTK</td>
				<td style="text-align: justify;">@{{ $telegram->tgram_isia }}</td>
			</tr>
			<tr style="">
				<td style="width:10%">BBB</td>
				<td style="width:10%">TTK</td>
				<td style="text-align: justify;">@{{ $telegram->tgram_isib }}</td>
			</tr>
			<tr style="">
				<td style="width:10%">CCC</td>
				<td style="width:10%">TTK</td>
				<td style="text-align: justify;">@{{ $telegram->tgram_isic }}</td>
			</tr>
			<tr style="">
				<td style="width:10%">DDD</td>
				<td style="width:10%">TTK</td>
				<td style="text-align: justify;">@{{ $telegram->tgram_isid }}</td>
			</tr>
			<tr style="">
				<td style="width:10%">EEE</td>
				<td style="width:10%">TTK</td>
				<td style="text-align: justify;">@{{ $telegram->tgram_isie }}</td>
			</tr>
	  	</table>

	  	<table border="0px" style="float:right; margin-top: 10px;">
	  		<tr style="">
				<td style="text-align:center;">@{{ $telegram->tgram_dari }}</td>
			</tr>
			<tr style="">
				<td style="height:50px"></td>
			</tr>
			<tr style="">
				<td style="text-align:center; border-bottom:1px solid;">@{{ $telegram->tgram_nama }}</td>
			</tr>
			<tr style="">
				<td style="text-align:center;">@{{ $telegram->tgram_pangkat }} NRP: @{{ $telegram->tgram_nrp }}</td>
			</tr>
	  	</table>
	</body>
</html>