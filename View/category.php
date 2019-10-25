<?php

foreach ($categories as $category){
    echo "<div class='comment'> $category->id : $category->name </div>";
}