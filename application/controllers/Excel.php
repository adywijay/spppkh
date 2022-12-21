<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Excel extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
    }
    public function index()
    {
        $this->load->view('excel');
    }
    public function upload(){
        $fileName = time().$_FILES['file']['name'];
         
        $config['upload_path'] = FCPATH .'./template/upload/dokumen'; //buat folder dengan nama assets di root folder
        $config['file_name'] = $fileName;
        $config['allowed_types'] = 'xls|xlsx|csv';
        $config['max_size'] = 10000;
         
        $this->load->library('upload');
        $this->upload->initialize($config);
         
        if(! $this->upload->do_upload('file') )
        $this->upload->display_errors();
             
        $media = $this->upload->data('file');
        $inputFileName = $this->upload->data('full_path');
         
        try {
                $inputFileType = IOFactory::identify($inputFileName);
                $objReader = IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
            } catch(Exception $e) {
                die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
            }
 
            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();
             
            for ($row = 2; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                                NULL,
                                                TRUE,
                                                FALSE);
                                                 
                //Sesuaikan sama nama kolom tabel di database                                
                 /*$data = array(
                    "id_operator"",[0],
                    "nomor_ba_tilang"=> $rowData[0][1],
                    "nomor_reg_tilang"=> $rowData[0][2],
                    "nomor_tilang"=> $rowData[0][3],
                    "nama_pelanggar_tilang"=> $rowData[0][4],
                    "pasal_tilang"=> $rowData[0][5],
                    "denda_tilang"=> $rowData[0][6],
                    "subsidair_tilang"=> $rowData[0][7],
                    "op_tilang"=> $rowData[0][8]
                );
                  * 
                  */
                $data = array(
                "id"                => $rowData[0][0],
                "nik"               => $rowData[0][1],
                "jml_art"           => $rowData[0][2],
                "jml_keluarga"      => $rowData[0][3],
                "sta_lahan"         => $rowData[0][4],
                "sta_bangunan"      => $rowData[0][5],
                "jns_lantai"        => $rowData[0][6],
                "jns_dinding"       => $rowData[0][7],
                "knds_dinding"      => $rowData[0][8],
                "jns_atap"          => $rowData[0][9],
                "knds_atap"         => $rowData[0][10],
                "smb_air_minum"     => $rowData[0][11],
                "cmdp_air_minum"    => $rowData[0][12],
                "smb_penerangan"    => $rowData[0][13],
                "dy_listrik"        => $rowData[0][14],
                "bb_masak"          => $rowData[0][15],
                "fasbab"            => $rowData[0][16],
                "jns_kloset"        => $rowData[0][17],
                "tp_akhir"          => $rowData[0][18],
                "sta_art_usaha"     => $rowData[0][19],
                "sta_kks"           => $rowData[0][20],
                "sta_kip"           => $rowData[0][21],
                "sta_bpjsm"         => $rowData[0][22],
                "sta_jamsotek"      => $rowData[0][23],
                "sta_asuransi_lain" => $rowData[0][24],
                "sta_rasta"         => $rowData[0][25],
                "sta_kur"           => $rowData[0][26],
                "sta_keberadaan_art"=> $rowData[0][27],
                "keputusan_asli"    => $rowData[0][28]
                );


            //sesuaikan nama dengan nama tabel
                $insert = $this->db->insert("tbl_data_latih",$data);
             
			
            }
            $cwd=getcwd();
            $excel_file_path=$cwd."\\template\upload\dokumen";
            chdir($excel_file_path);
            unlink($inputFileName);
            chdir($cwd);
        redirect('excel/');
    }
}