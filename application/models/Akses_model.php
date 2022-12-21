<?php

/**
 * Description of Akses_model
 *
 * @author Ady
 */
class Akses_model extends CI_Model {

    public function insert_akses() {
        $data = array(
            'nama_akses' => ucfirst($this->input->post('nama_akses'))
        );
        $perintah = $this->db->insert('tbl_akses', $data);
        if ($perintah == TRUE) {
            echo "<b><script>alert('Data Berhasil Disimpan..!');</script></b>";
            redirect('akses', 'refresh');
        } else {
            echo "<script>window.alert('Data Gagal Disimpan..!');window.location=('akses')</script>";
        }
    }

    public function retriveall_akses() {
        return $this->db->order_by('nama_akses','ASC')->get('tbl_akses')->result();
    }

    public function delete_akses($id_akses) {
        $this->db->where('id_akses', $id_akses);
        $perintah = $this->db->delete('tbl_akses');
        if ($perintah == TRUE) {
            echo "<script>alert('Record Berhasil Dihapus..!');</script>";
            redirect('akses', 'refresh');
        } else {
            echo "<script>window.alert('Record Gagal Dihapus..!');window.location=('akses')</script>";
        }
    }

    public function reset() {
        $perintah = $this->db->truncate('tbl_akses');
        if ($perintah == TRUE) {
            echo "<script>alert('Record Berhasil Dikosongkan..!');</script>";
            redirect('akses', 'refresh');
        } else {
            echo "<script>window.alert('Record Gagal Dikosongkan..!');window.location=('akses')</script>";
        }
    }

}
