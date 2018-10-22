<?php


class videoClass
{

//    public $id;
//    public $episode;
//    public $season;
//    public $title;
//    public $description;
//    public $source;
//    public $new;
//    public $created_at;
    /**
     * @var PDO
     */
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }


    public function create($episode,
                           $season,
                           $title,
                           $description,
                           $source,
                           $new, $created_at)
    {
        $sql_new_video = "INSERT INTO videos VALUES" . "(null, '$episode',
                                                        '$season','$title',
                                                        '$description','$source',
                                                        '$new','$created_at')";
        $this->conn->query($sql_new_video);
    }

    public function update($id,
                           $episode,
                           $season,
                           $title,
                           $description,
                           $source,
                           $new,
                           $created_at)
    {
        $sql_update_video = "UPDATE videos SET episode='$episode',
                          season='$season',
                          title='$title',
                          description='$description',
                          source='$source',
                          new='$new',
                          created_at='$created_at'
                          WHERE id='$id'";
        $this->conn->query($sql_update_video);
    }

    public function delete($id){
        $sql_delete_video = "DELETE FROM videos WHERE id='$id'";
        $this->conn->query($sql_delete_video);
    }



}