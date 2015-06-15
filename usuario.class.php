<?php
class Usuario {

	/**
   * Nome do banco de dados onde está a tabela de usuários
   */
  var $bancoDeDados = 'meu_site';

  /**
   * Nome da tabela de usuários
   */
  var $tabelaUsuarios = 'usuarios';

  /**
   * Nomes dos campos onde ficam o usuário e a senha de cada usuário
   * Formato: tipo => nome_do_campo
   */
  var $campos = array(
    'usuario' => 'usuario',
    'senha' => 'senha'
  );

  /**
   * Usa algum tipo de encriptação para codificar uma senha
   *
   * Método protegido: Só pode ser acessado por dentro da classe
   *
   * @param string $senha - A senha que será codificada
   * @return string - A senha já codificada
   */
  function __codificaSenha($senha) {
    // Altere aqui caso você use, por exemplo, o MD5:
    // return md5($senha);
    return sha1($senha);
  }
  /**
   * Valida se um usuário existe
   *
   * @param string $usuario - O usuário que será validado
   * @param string $senha - A senha que será validada
   * @return boolean - Se o usuário existe ou não
   */
  function validaUsuario($usuario, $senha) {
    $senha = $this->__codificaSenha($senha);

    // Procura por usuários com o mesmo usuário e senha
    $sql = "SELECT COUNT(*)
        FROM `{$this->bancoDeDados}`.`{$this->tabelaUsuarios}`
        WHERE
          `{$this->campos['usuario']}` = '{$usuario}'
          AND
          `{$this->campos['senha']}` = '{$senha}'";
    $query = mysql_query($sql);
    if ($query) {
      $total = mysql_result($query, 0);
    } else {
      // A consulta foi mal sucedida, retorna false
      return false;
    }

    // Se houver apenas um usuário, retorna true
    return ($total == 1) ? true : false;
  }
  /**
   * Nomes dos campos que serão pegos da tabela de usuarios e salvos na sessão,
   * caso o valor seja false nenhum dado será consultado
   * @var mixed
   */
  var $dados = array('id', 'nome');

  /**
   * Inicia a sessão se necessário?
   * @var boolean
   */
  var $iniciaSessao = true;

  /**
   * Prefixo das chaves usadas na sessão
   * @var string
   */
  var $prefixoChaves = 'usuario_';

  /**
   * Usa um cookie para melhorar a segurança?
   * @var boolean
   */
  var $cookie = true;

  /**
   * Armazena as mensagens de erro
   * @var string
   */
  var $erro = '';

/**
   * Loga um usuário no sistema salvando seus dados na sessão
   *
   * @param string $usuario - O usuário que será logado
   * @param string $senha - A senha do usuário
   * @return boolean - Se o usuário foi logado ou não
   */
  function logaUsuario($usuario, $senha) {
  	// Verifica se é um usuário válido
    if ($this->validaUsuario($usuario, $senha)) {

      /// Inicia a sessão?
      if ($this->iniciaSessao AND !isset($_SESSION)) {
        session_start();

// Traz dados da tabela?
      if ($this->dados != false) {
        // Adiciona o campo do usuário na lista de dados
        if (!in_array($this->campos['usuario'], $this->dados)) {
          $this->dados[] = 'usuario';
        }

        // Monta o formato SQL da lista de campos
        $dados = '`' . join('`, `', array_unique($this->dados)) . '`';

        // Consulta os dados
        $sql = "SELECT {$dados}
            FROM `{$this->bancoDeDados}`.`{$this->tabelaUsuarios}`
            WHERE `{$this->campos['usuario']}` = '{$usuario}'";
        $query = mysql_query($sql);

        // Se a consulta falhou
        if (!$query) {
          // A consulta foi mal sucedida, retorna false
          $this->erro = 'A consulta dos dados é inválida';
          return false;
        } else {
          // Traz os dados encontrados para um array
          $dados = mysql_fetch_assoc($query);
          // Limpa a consulta da memória
          mysql_free_result($query);

          // Passa os dados para a sessão
          foreach ($dados AS $chave=>$valor) {
            $_SESSION[$this->prefixoChaves . $chave] = $valor;
          }
        }
      }

      // Usuário logado com sucesso
      $_SESSION[$this->prefixoChaves . 'logado'] = true;

      // Define um cookie para maior segurança?
      if ($this->cookie) {
        // Monta uma cookie com informações gerais sobre o usuário: usuario, ip e navegador
        $valor = join('#', array($usuario, $_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT']));

        // Encripta o valor do cookie
        $valor = sha1($valor);

        setcookie($this->prefixoChaves . 'token', $valor, 0, '/');
      }

      // Fim da verificação, retorna true
      return true;

      }


    } else {
      $this->erro = 'Usuário inválido';
      return false;
    }

  }


}