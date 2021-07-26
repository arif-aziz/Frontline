@extends('layout.master')

@section('container')

<?php
    $getAktifitasUser = Request::create('aktifitas', 'GET');
    $aktifitasUser    = Route::dispatch($getAktifitasUser)->getOriginalContent();

    $getHakAkses = Request::create('akses', 'GET');
    $hakAkses    = Route::dispatch($getHakAkses)->getOriginalContent();
?>

	@if ( $aktifitasUser['viewAbsenOperasi'] == 'available' )
	<div class="container-fluid" id="pcont">
		<div class="page-head">
			<div class="row">
				<h4 style="margin:10px 25px;"><i class="fa fa-user"></i><strong>&nbsp; ABSENSI OPERASI</strong></h4>
				<p style="font-size:11px; line-height:15px; margin:10px 25px;">Melihat daftar request personel untuk operasi khusus &amp; operasi rutin serta menerima/menolak request tersebut.</p>
			</div>
		</div>
		<div class="cl-mcont ms-container" style="background:#fff;">
	    	<div class="row ms-row">
				<div class="col-sm-6 ms-col ms-col-border">
		    		<div class="block-flat ms-no-border ms-no-shadow" style="min-height:468px;">
						<div class="content">
							@if (Session::has('flash_error'))
					      	<div class="alert alert-danger" style="margin-bottom:30px; margin-top:-36px; margin-left:-24px; margin-right:-24px">
					        	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					        	<i class="fa fa-times-circle sign"></i><strong>Kesalahan!</strong> @{{ Session::get('flash_error') }}
					      	</div>
					      	@elseif (Session::has('flash_success'))
					      	<div class="alert alert-success" style="margin-bottom:30px; margin-top:-36px; margin-left:-24px; margin-right:-24px">
					        	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					        	<i class="fa fa-check sign"></i><strong>Sukses!</strong> @{{ Session::get('flash_success') }}
					      	</div>
					      	@endif

					      	<div>
					      		<div class="header">
									<h4 style="margin:-15px 0px 10px 0px;"><strong>Daftar Absensi Operasi</strong></h4>
								</div>
							  <div class="header">
							  	<div class="row" style="margin:10px">
								  	<p style="font-size:11px; line-height:15px;">Pilih FILTER dibawah ini untuk melihat absensi personel dalam operasi yang sedang berlangsung.</p>
							  		<form action="@{{ URL::to('absenoperasi/filter') }}" method="GET" class="form-horizontal" style="border-radius: 0px;">
										<div class="form-group">
									    	<div class="col-sm-3" style="padding-right:0px">
									    		@if (Session::has('sessTglAbsenOp'))
									    		<input name="txt-tanggal-absen" value="@{{ Session::get('sessTglAbsenOp') }}" parsley-trigger="change" required class="form-control date datetime" data-min-view="2" data-date-format="yyyy-mm-dd" size="16" type="text" style="height:36px"/>
									    		@else
									    		<input name="txt-tanggal-absen" value="@{{ date('Y-m-d') }}" parsley-trigger="change" required class="form-control date datetime" data-min-view="2" data-date-format="yyyy-mm-dd" size="16" type="text" style="height:36px"/>
									    		@endif
											</div>
										    <div class="col-sm-7" style="padding-right:0px">
										    	<select name="slc-operasi" id="slc-operasi" class="select2" parsley-trigger="change" required>
										    		@foreach ($operasi as $valOperasi)
														@if (Session::has('sessOperasi') && Session::get('sessOperasi') == $valOperasi->id_operasi)
															<option value="@{{ $valOperasi->id_operasi }}" selected>@{{ $valOperasi->nama_op }}</option>
													    @else
													    	<option value="@{{ $valOperasi->id_operasi }}">@{{ $valOperasi->nama_op }}</option>
												        @endif
												    @endforeach
												</select>
											</div>
											<div class="col-sm-2" style="padding-right:0px">
												<button type="submit" class="btn btn-primary"><i class="fa fa-check info"></i></button>
											</div>
										</div>
									</form>
								</div>
							  </div>
							  <div class="content">
							    <div class="table-responsive">
							      <table class="no-border hover" id="datatable">
							        <thead class="no-border">
							          <tr>
							            <th class="text-center"><strong>NRP</strong></th>
							            <th><strong>Nama Personel</strong></th>
							            <th class="text-center"><strong>Absensi</strong></th>
							            <th class="text-center"><strong>Gaji</strong></th>
							            @if ( $aktifitasUser['inputAbsenOperasi'] == 'available' )
							            	@if( $hakAkses['aksesAbsenOps'] == 'available' )
							            	<th class="text-center" style="width:15%"><strong>Aksi</strong></th>
							            	@endif
							            @endif
							          </tr>
							        </thead>
							        <tbody class="no-border-x no-border-y" id="table-daftar-user">
							        	@foreach($absenOperasi as $valAbsenOperasi)
							        	<tr>
							              	<td class="text-center"><a href="" class="btn-show-menu">@{{ $valAbsenOperasi->nrp }}</a></td>
							              	<td>@{{ $valAbsenOperasi->nama_lengkap }}</td>
							              	<td class="text-center">
							              		@if ($valAbsenOperasi->status_absen_op == 'kerja')
							              		<span class="label label-success">Dinas</span>
							              		@elseif ($valAbsenOperasi->status_absen_op == 'bebas-kerja')
							              		<span class="label label-success">Lepas Dinas</span>
							              		@elseif ($valAbsenOperasi->status_absen_op == 'izin')
							              		<span class="label label-danger">Izin</span>
							              		@endif
							              	</td>
							              	<td>@{{ $valAbsenOperasi->gaji }}</td>
							              	@if ( $aktifitasUser['inputAbsenOperasi'] == 'available' )
							            		@if( $hakAkses['aksesAbsenOps'] == 'available' )
								              	<td class="text-center">
									                <a href="@{{ URL::to('absenoperasi/view').'/'.$valAbsenOperasi->tanggal_absen_op.'/'.$valAbsenOperasi->id_operasi.'/'.$valAbsenOperasi->id_personel }}" class="label label-primary md-trigger" 
									                   data-toggle="tooltip" data-original-title="Riwayat Absen"><i class="fa fa-bars"></i></a>
									                <a href="@{{ URL::to('absenoperasi/update').'/'.$valAbsenOperasi->tanggal_absen_op.'/'.$valAbsenOperasi->id_operasi.'/'.$valAbsenOperasi->id_personel }}" class="label label-default md-trigger" 
									                   data-toggle="tooltip" data-original-title="Ubah"><i class="fa fa-pencil"></i></a>
									            </td>
								            	@endif
								            @endif
							            </tr>
							            @endforeach
							        </tbody>
							      </table>              
							    </div>
							  </div>
							</div>        
						</div>
					</div>
				</div>
	    		<div class="col-sm-6 ms-col">
	    			<div class="block-flat ms-no-border ms-no-shadow">
	    				<div class="content">
	        				@yield('container_absenoperasi')
	        			</div>
	        		</div>
	        	</div>
	        </div>
    	</div>
	</div>
	@endif

@endsection