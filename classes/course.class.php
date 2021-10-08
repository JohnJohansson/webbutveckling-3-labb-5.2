<?php

// a class file with the main classes
class course
{
    //vars
    private $db;

    private $kurskod;
    private $kursnamn;
    private $progression;
    private $kursplan;


    //--------- CONSTRUKTOR -------------------------------------
    public function __construct()
    {
        // connection to the database
        $this->db = new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE); //Connects to the database
        if ($this->db->connect_errno > 0) { //
            die("Fel vid anslutning: " . $this->db->connect_error);
        }
    }


    // Add new course ---------------------
    /** 
     * Add course
     * @param string $kurskod 
     * @param string $kursnamn 
     * @param string $progression
     * @param string $kursplan
     * @return boolean
     */
    public function addCourse(string $kurskod, string $kursnamn, string $progression, string $kursplan): bool
    {
        $this->kurskod = $kurskod;
        $this->kursnamn = $kursnamn;
        $this->progression = $progression;
        $this->kursplan = $kursplan;
        // the question marks is for the undecided data that we havent put into the tabel yet
        $stm = $this->db->prepare("INSERT INTO courses(kurskod,kursnamn,progression,kursplan) VALUES (?, ?, ?, ?)");
        //the ssss stands for four strings, what a world
        $stm->bind_param("ssss", $this->kurskod, $this->kursnamn, $this->progression, $this->kursplan);

        if ($stm->execute()) {
            return true;
        } else {
            return false;
        }
        $stm->close();
    }

    // Read out all courses------------------

    /** 
     * Get all courses
     * @return array
     */
    public function getCourses(): array
    {
        $sql = "SELECT * FROM courses ORDER BY progression;";
        $result = $this->db->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // delete a course ---------------
    /** 
     * Delete course
     * @param int $id
     * @return boolean
     */
    public function deleteCourse(int $id): bool
    {
        $id = intval($id);

        $sql = "DELETE FROM courses WHERE id=$id;";
        $result = $this->db->query($sql);

        return $result;
    }

    // Get one course based on its id --------------
    /** 
     * Get course by id
     * @param int $id
     * @return array
     */
    public function getCourseById(int $id): array
    {
        $id = intval($id);

        $sql = "SELECT * FROM courses WHERE id=$id;";
        $result = $this->db->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    // update a course -------------
    /** 
     * Update course
     * @param int $id
     * @param string $kurskod 
     * @param string $kursnamn 
     * @param string $progression
     * @param string $kursplan
     * @return boolean
     */
    public function updateCourse(int $id, string $kurskod, string $kursnamn, string $progression, string $kursplan): bool
    {
        $this->kurskod = $kurskod;
        $this->kursnamn = $kursnamn;
        $this->progression = $progression;
        $this->kursplan = $kursplan;
        $id = intval($id);

        $stm = $this->db->prepare("UPDATE courses SET kurskod=?, kursnamn=? ,progression=?, kursplan=? WHERE id=$id;");
        $stm->bind_param("ssss", $this->kurskod, $this->kursnamn, $this->progression, $this->kursplan);

        if ($stm->execute()) {
            return true;
        } else {
            return false;
        }
        $stm->close();
    }
}
