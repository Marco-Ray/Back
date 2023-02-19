<?php

class Controller extends DB\SQL\Mapper
{
    public function __construct($table)
    {
        global $f3;
        parent::__construct($f3->get('DB'), $table);
    }

    public function getVolcanoById($v_id)
    {
        return $this->load(['id=?', $v_id]);
    }

    public function getVolcanoByType($type)
    {
        $result_array = array();
        $this->load(['primary_volcano_type=?', $type]);
        $count = 0;
//        while (!$this->dry()) {
        while ($count < 5) {
            $record = $this->cast();
            array_push($result_array, $record);
            $this->next();
            $count += 1;
        }
        return $result_array;
    }

    public function likeVolcano($v_id)
    {
        $volcano = $this->getVolcanoById($v_id);
        $num_likes = $volcano->likes;
        $volcano->likes = $num_likes + 1;
        $volcano->update();
        return array('status_code'=>204);;
    }

    public function dislikeVolcano($v_id)
    {
        $volcano = $this->getVolcanoById($v_id);
        $num_likes = $volcano->likes;
        $volcano->likes = $num_likes - 1;
        $volcano->update();
        return array('status_code'=>204);;
    }
}