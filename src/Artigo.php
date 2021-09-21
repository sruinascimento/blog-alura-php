<?php

class Artigo
{
    private mysqli $mysql;
    private array $artigos;
    
    
    public function __construct(mysqli $mysql){
        $this->mysql = $mysql;
        $this->mysql->set_charset('utf8');
        /*
        $this->artigos =  [
            [
                'titulo'   => 'Primeiros passos com Spring',
                'conteudo' => 'Na empresa onde trabalho começamos um Coding Dojo, que é basicamente 
                                uma reunião com programadores e programadoras a fim de resolver 
                                desafios e aperfeiçoar as habilidades com algoritmos.',
                'link'     => 'primeiros-passos-com-spring.html'
        
            ],
        
            [
                'titulo'   => 'O que é Metodologia Ágil?',
                'conteudo' => ' Uma vez fui contratada por uma empresa que desenvolvia softwares e 
                                aplicativos para outras empresas.',
                'link'     => 'o-que-e-metodologia-agil.html'
            ],
        
            [
                'titulo'   => 'Como é o funil do Growth Hacking?',
                'conteudo' => ' Minha amiga que possui um clube de assinaturas começou a utilizar o 
                                Growth Hacking após conhecer um pouco mais sobre ele.',
                'link'     => 'como-e-o-funil-do-growth-hacking.html'
            ],
        
            [
                'titulo'   => ' Meus conhecimentos com as linguagens de Programação',
                'conteudo' => 'Linguagens de Programação para solucionar problemas, das quais possuo 
                                cohecimento',
                'link'     => 'programming-languages.html'
            ]
        ];
        */
    }

    public function exibirTodos(): array 
    {
        $resultado = $this->mysql->query('SELECT * FROM artigos');
        $this->artigos = $resultado->fetch_all(MYSQLI_ASSOC);
        return $this->artigos;
    }

    public function encontrarPorId(string $id): array
    {
        //Preparar a consulta para evitar sql injection
        $selecionaArtigo = $this->mysql->prepare("SELECT id, titulo, conteudo FROM artigos WHERE id = ?");
        //vinculando o parâmetro id ao ?
        // 's' representa string e o segundo parâmetro é a variável de fato
        $selecionaArtigo->bind_param('s', $id);
        //realiza a query de fato
        $selecionaArtigo->execute();
        //retorna o resultado da querya executada acima
        return $selecionaArtigo->get_result()->fetch_assoc();

    }

    public function adicionar(string $titulo, string $conteudo): void 
    {
       $insereArtigo = $this->mysql->prepare(
           'INSERT INTO artigos (titulo, conteudo)
            VALUES (?, ?);' 
        );
        //2 valores strings
       $insereArtigo->bind_param('ss', $titulo, $conteudo);
       $insereArtigo->execute();

    }

    public function excluir(string $id): void
    {
        $excluiArtigo = $this->mysql->prepare(
            'DELETE FROM artigos WHERE id = ?'
        );
        $excluiArtigo->bind_param('s', $id);
        $excluiArtigo->execute();
    }

    public function editar(string $id, string $titulo, string $conteudo): void 
    {
        $editaArtigo = $this->mysql->prepare(
            'UPDATE artigos SET titulo = ?, conteudo = ? WHERE id = ?'
        );
        $editaArtigo->bind_param('sss', $titulo, $conteudo, $id);
        $editaArtigo->execute();
    }
}


