<?php
/**
 * Description of Akun_model
 *
 * @author Ady
 */
class Akun_model extends CI_Model {
    public function insert_akun($post_foto) {
        $data = array(
            'nama'              => ucfirst($this->input->post('nama')),
            'username'          => ucfirst($this->input->post('username')),
            'token'             => $this->input->post('token'),
            'password'          => md5($this->input->post('password')),
            'no_telp'           => $this->input->post('no_telp'),
            'jabatan'           => $this->input->post('jabatan'),
            'id_akses'          => $this->input->post('id_akses'),
            'status'            => $this->input->post('status'),
            'foto'              => $post_foto
        );
        return $this->db->insert('tbl_akun',$data);
//        $keamanan = $this->security->xss_clean($data);
//        return $keamanan;
    }
    public function retrive_all() {
        return $this->db->get('tbl_akun')->result();
    }
    public function get_akun($id_akun) {
        $this->db->select('*');
        $this->db->where('id_akun', $id_akun);
        $query = $this->db->get('tbl_akun');
        return $query->row_array();
    }
    public function get_by_sesi() {
        $this->db->select('*');
        $this->db->where(array('id_akun' => $this->session->userdata('id_akun')));
        $perintah = $this->db->limit(1)->get('tbl_akun');
        if ($perintah->num_rows() > 0) {
            foreach ($perintah->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }
    public function update_akun($post_foto) {
       if (!empty($this->input->post('password'))){
        $data = array(
            'nama'              => ucfirst($this->input->post('nama')),
            'username'          => ucfirst($this->input->post('username')),
            'token'             => $this->input->post('token'),
            'password'          => md5($this->input->post('password')),
            'no_telp'           => $this->input->post('no_telp'),
            'jabatan'           => $this->input->post('jabatan'),
            'id_akses'          => $this->input->post('id_akses'),
            'status'            => $this->input->post('status'),
            'foto'              => $post_foto
        );
        }else {
        $data = array(
            'nama'              => ucfirst($this->input->post('nama')),
            'username'          => ucfirst($this->input->post('username')),
            'token'             => $this->input->post('token'),
            'no_telp'           => $this->input->post('no_telp'),
            'jabatan'           => $this->input->post('jabatan'),
            'id_akses'          => $this->input->post('id_akses'),
            'status'            => $this->input->post('status'),
            'foto'              => $post_foto
        ); }
        $this->db->where('id_akun', $this->input->post('id_akun'));
        return $this->db->update('tbl_akun', $data);
    }
    public function edit_akunb() {
        if (!empty($this->input->post('password'))) {
            $data = array(
            'nama'              => ucfirst($this->input->post('nama')),
            'username'          => ucfirst($this->input->post('username')),
            'token'             => $this->input->post('token'),
            'password'          => md5($this->input->post('password')),
            'no_telp'           => $this->input->post('no_telp'),
            'jabatan'           => $this->input->post('jabatan'),
            'id_akses'          => $this->input->post('id_akses'),
            'status'            => $this->input->post('status'),
            'foto'              => $post_foto
        );
        } else {
            $data = array(
            'nama'              => ucfirst($this->input->post('nama')),
            'username'          => ucfirst($this->input->post('username')),
            'token'             => $this->input->post('token'),
            'no_telp'           => $this->input->post('no_telp'),
            'jabatan'           => $this->input->post('jabatan'),
            'id_akses'          => $this->input->post('id_akses'),
            'status'            => $this->input->post('status'),
            'foto'              => $post_foto
        );}
        $this->db->where('id_akun', $this->input->post('id_akun'));
        return $this->db->update('tbl_akun', $data);
    }
    public function delete_akun($id_akun) {
        $image_file_name = $this->db->select('foto')->get_where('tbl_akun', array('id_akun' => $id_akun))->row()->foto;
        if (!$image_file_name == 'gagal_upload.png') {
            $cwd = getcwd();
            $image_file_path = $cwd . "\\template\\upload\\profil";
            chdir($image_file_path);
            unlink($image_file_name);
            chdir($cwd);
            $this->db->where('id_akun', $id_akun);
            $this->db->delete('tbl_akun');
        } else {
            $cwd = getcwd();
            $image_file_path = $cwd . "\\template\\upload\\profil";
            chdir($image_file_path);
            unlink($image_file_name);
            chdir($cwd);
            $this->db->where('id_akun', $id_akun);
            $this->db->delete('tbl_akun');
            return true;
        }
    }
    
    public function get_akun_surveyer() {
        return $this->db->where('id_akses',1)->get('tbl_akun')->result();
    }
    public function reset() {
        return $this->db->get('tbl_akun')->result();
    }
    public function count_petugas_sv() {
        $count_query = $this->db->where('id_akses',1)->get('tbl_akun');
        return $count_query->num_rows();
    }
    public function count_petugas_sv_1() {
        $count_query = $this->db->where('status',1)->get('tbl_akun');
        return $count_query->num_rows();
    }
}

