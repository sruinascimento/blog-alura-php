<?php 
function redireciona(string $url): void
{
    //apos terminar de inserir os dados, precisamos redirecionar a página
    //com o método GET, pois atualmente está com o POST
    header("Location: $url");
    //e morrer
    die();
}
?>