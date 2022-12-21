<?php

/**
 * Deskripsi Atribut_model
 * Sebagai variabel pemilihan atribut yg digunakan untuk keperluan mining 
 * 
 * @author Ady
 */
class Atribut_model extends CI_Model {

    public function insert_atribut() {
        $data = array(
            'atribut'       => $this->input->post('atribut'),
            'nilai_atribut' => $this->input->post('nilai_atribut'),
            'ket_nilai'     => $this->input->post('ket_nilai'),
            'aktif'         => $this->input->post('aktif'),
            'status'        => $this->input->post('status')
        );
        $this->security->xss_clean($data);
        $this->db->escape($data);
        $perintah = $this->db->insert('tbl_atribut', $data);
        if ($perintah == TRUE) {
            echo "<b><script>alert('Data Berhasil Disimpan..!');</script></b>";
            redirect('admin/tampil_atribut', 'refresh');
        } else {
            echo "<script>window.alert('Data Gagal Disimpan..!');window.location=('admin/tambah_atribut')</script>";
        }
    }

    public function retriveall_atribut() {
        return $this->db->get('tbl_atribut')->result();
        /*
         * $hasil=$this->db->get('tbl_atribut')->result();
          echo json_encode($hasil);
         * fungsi menampilkan dalam bentuk json
         */
    }
    public function get_atribut($id) {
        $this->db->select('*');
        $this->db->where('id', $id);
        $query = $this->db->get('tbl_atribut');
        return $query->row_array();
    }
    public function update_atribut() {
        $data = array(
            'atribut'       => $this->input->post('atribut'),
            'nilai_atribut' => $this->input->post('nilai_atribut'),
            'ket_nilai'     => $this->input->post('ket_nilai'),
            'aktif'         => $this->input->post('aktif'),
            'status'        => $this->input->post('status')
        );
        $this->db->where = array('id' => $this->input->post('id'));
        return $this->db->update('tbl_atribut', $data);
    }
    public function truncate_atribut() {
        $perintah = $this->db->truncate('tbl_atribut');
        if ($perintah == TRUE) {
            echo "<script>alert('Record Berhasil Dikosongkan..!');</script>";
            redirect('admin/tampil_atribut', 'refresh');
        } else {
            echo "<script>window.alert('Record Gagal Dikosongkan..!');window.location=('admin/tampil_atribut')</script>";
        }
    }
    public function delete_atribut($id) {
        $this->db->where('id', $id);
        $perintah = $this->db->delete('tbl_atribut');
        if ($perintah == TRUE) {
            echo "<script>alert('Record Berhasil Dihapus..!');</script>";
            redirect('admin/tampil_atribut', 'refresh');
        } else {
            echo "<script>window.alert('Record Gagal Dikosongkan..!');window.location=('admin/tampil_atribut')</script>";
        }
    }

}
