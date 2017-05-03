<?php

class TPLeditTemplate extends Template {

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
        return 'Edit Template';
    }

    public function HTML() {
        if(isset($this->aParams['project_id'])) {
            $templateData = reset($this->loadSpecificPorjectData($this->aParams['project_id']));
            $this->loadTemplate($templateData['title']);
        }elseif(isset($this->aParams['template'])) {
            $this->loadTemplate($this->aParams['template']);
        }
        ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.1/js/bootstrap.min.js"></script>
        <script src="http://vitalets.github.io/x-editable/assets/x-editable/bootstrap-editable/js/bootstrap-editable.js"></script>
        <script src="http://vitalets.github.io/x-editable/assets/mockjax/jquery.mockjax.js"></script>
        <script>
            $('h1, h2, h3, h4, h5, h6, p, span').addClass('edit');

            var styles = [
                "http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.1/css/bootstrap-combined.min.css",
                "http://localhost/site_builder/style/style.css",
                "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
            ];
            $.each(styles, function(key, value) {
                console.log(value);
                $("<link/>", {
                    rel: "stylesheet",
                    type: "text/css",
                    href: value
                }).appendTo("head");
            });

            $(document).ready(function() {
                var templateData = <?= $templateData['json']?>;
                console.log(templateData);
                if(!jQuery.isEmptyObject(templateData)) {
                    $.each(templateData, function(key, value) {
                        console.log(value)
                        $( ".edit" ).eq(key).text(value);
                    });
                }
            });
        </script>
        <script src="http://localhost/site_builder/scripts/js_edit_templates.js"></script>


        <?php
    }

}