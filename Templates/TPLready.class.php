<?php

class TPLready extends Template
{

    private static $path = array('Sites', 'Blogs');

    private function loadTemplate($templateName) {
        foreach(self::$path as $path) {
            $file = "$path/$templateName.html";
            if(file_exists($file)) {
                require_once ($file);
            }
        }
    }

    protected function loadSpecificPorjectData($project_id) {
        $db = new Connect('site_builder');

        $query = "SELECT
                    up.id,
                    up.json,
                    temp.title title
                FROM users_projects up
                INNER JOIN templates temp
                ON up.template_id=temp.id
                WHERE up.id=:project_id
                ";

        $connection = $db->connect->prepare($query);
        $connection->bindParam(':project_id', $project_id, PDO::PARAM_INT);
        $connection->execute();
        return $connection->fetchAll(PDO::FETCH_ASSOC);

    }

    public function Title() {
        return 'Project name';
    }

    public function HTML() {
        $templateData = reset($this->loadSpecificPorjectData($this->aParams['project_id']));
        $this->loadTemplate($templateData['title']);
        ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script>
            $('h1, h2, h3, h4, h5, h6, p, span').addClass('edit');
            $.each(<?= $templateData['json']?>, function(key, value) {
                $( ".edit" ).eq(key).text(value);
            });
        </script>
<?php

    }

}