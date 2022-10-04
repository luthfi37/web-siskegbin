<?php

namespace App\Http\Controllers;

use App\Place;
use Illuminate\Http\Request;
use DB;

class DataController extends Controller
{
    public function places()
    {
        $places = Place::orderBy('place_name', 'ASC');
        $join = "(SELECT nama FROM anggotas WHERE anggota_id = places.anggota_id) as nama";
        return datatables()->of($places)
            ->addColumn('action', 'admin.places.buttons')
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }
    public function kegiatan_datatable(){

        $data=[];
        $length = $_POST['length'];
        $start = $_POST['start'];
        $search = $_POST['search']['value'];
       $join = "(SELECT nama FROM anggotas WHERE anggota_id = places.anggota_id) as nama";
       
      
       if($search){  
           
        $filters = [];
        // if(!empty($_POST['status'])){
        //     $filters[] = "fm_product.product_status ='".$_POST['status']."'";            
        //    }
           if(!empty($_POST['seller'])){
            $filters[] = "fm_product.name ='".$_POST['seller']."'";            
           }
        //    if(!empty($_POST['ukuran'])){
        //     $filters[] = "fm_product.size ='".$_POST['ukuran']."'";            
        //    }
           $filters = (count($filters)>0) ? implode(" AND ",$filters)." AND ":"";
       
    //     $query = "place_name LIKE '%$search%'";
    //     $data['data'] = DB::SELECT("SELECT *,(select count(*) from places WHERE $query )jumdata, $join FROM places WHERE $query LIMIT $start,$length ");
   
    //    }else{
           
       
   
    //     $data['data']= DB::SELECT("SELECT *,(select count(*) from places)jumdata, $join FROM places LIMIT $start,$length ");
    //     }
    //    //count total data
   
    //       $data['recordsTotal']=$data['recordsFiltered']=@$data['data'][0]->jumdata ? :0;
   
   
    //       return $data;
    $query = "$filters ((SELECT nama FROM anggotas WHERE anggota_id = places.anggota_id) LIKE '%$search%' OR place_name LIKE '%$search%' )";
     $data['data'] = DB::SELECT("SELECT *,(select count(*) from places WHERE $query )jumdata, $join FROM places WHERE $query LIMIT $start,$length ");

    }else{
        $filters = [];
        // if(!empty($_POST['status'])){
        //     $filters[] = "places.product_status ='".$_POST['status']."'";            
        //    }
           if(!empty($_POST['seller'])){
            $filters[] = "places.anggota_id ='".$_POST['seller']."'";            
           }
        //    if(!empty($_POST['ukuran'])){
        //     $filters[] = "fm_product.size ='".$_POST['ukuran']."'";            
        //    }
           $filters = (count($filters)>0) ? " WHERE ".implode(" AND ",$filters):"";
    

     $data['data']= DB::SELECT("SELECT *,(select count(*) from places)jumdata, $join FROM places $filters LIMIT $start,$length ");
     }
    //count total data

       $data['recordsTotal']=$data['recordsFiltered']=@$data['data'][0]->jumdata ? :0;


       return $data;
   
       }
}
