<?php
class Webset_model extends CI_Model
{

	function websetQuery($id)
	{
		$sql = "select * from fu_status where id = " . $id;
		$result = $this->db->query($sql);
		if($result->num_rows() < 1)
		{
			return '';
		}else {
			$records= $result->row();
			return $records;
		}
	}




    function websetUpdateModel($flag,$keys)
    {
				$sql = "update fu_status set flag = " .$flag . " where id = " .$keys;
        $this->db->query($sql);
        return $this->db->affected_rows();
    }
    
}