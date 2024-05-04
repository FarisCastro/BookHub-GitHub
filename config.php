<?php
    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=frecorpf_bookhub;charset=utf8', 'frecorpf_faris', 'en1vfbDu$TfeVf@h1e');
    }catch(Exception $e)
    {
        die('Erreur' . $e->getMessage());
    }