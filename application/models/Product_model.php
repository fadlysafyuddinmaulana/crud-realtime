<?php
class Product_model extends CI_Model
{

    public function get_all_products()
    {
        return $this->db->get('products')->result();
    }

    public function get_product($id)
    {
        return $this->db->get_where('products', array('id' => $id))->row();
    }

    public function insert_product($data)
    {
        // Add debug logging
        log_message('debug', 'Attempting to insert product: ' . print_r($data, TRUE));

        $result = $this->db->insert('products', $data);

        if (!$result) {
            // Log database errors
            log_message('error', 'Database Error: ' . print_r($this->db->error(), TRUE));
        }

        return $result;
    }

    public function update_product($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('products', $data);
    }

    public function delete_product($id)
    {
        return $this->db->delete('products', array('id' => $id));
    }
}
