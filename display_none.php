<?php
if (empty($_POST['nom']) && empty($_POST['genre']) && empty($_POST['distributeur']) && empty($_POST['date_de_projection']))
{
    echo 'class="display_none"';
}
else
{
    echo 'class="display_area"';
}
?>