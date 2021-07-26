<?php

class AreaController extends BaseController {

    public function getProvinsi()
    {
        $dataProvinsi = Area::where("level", 1)
                            ->get();

        return Response::json(array(
            "area" => $dataProvinsi->toArray()), 
        200);
    }

    public function getKota($id)
    {
        $dataKota = Area::where("level", 2)
                        ->where("id_provinsi", $id)
                        ->get();

        return Response::json(array(
            "area" => $dataKota->toArray()), 
        200);        
    }

    public function getKecamatan($id_kota, $id_prov)
    {
        $dataKecamatan = Area::where("level", 3)
                            ->where("id_provinsi", $id_prov)
                            ->where("id_kota", $id_kota)
                            ->get();
                         
        return Response::json(array(
            "area" => $dataKecamatan->toArray()), 
        200);
    }

}