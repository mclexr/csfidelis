<?php
namespace App\Model;
/**
 * Usuario
 *
 * @Entity
 * @Table(name="usuario")
 */
class Usuario implements \JsonSerializable {
	/**
	 * @Id
	 * @Column(type="integer", name="id")
	 * @GeneratedValue(strategy="AUTO")
	 */
	private $id;
	/**
	 * @Column(type="string", name="nome")
	 */
	private $nome;
	/**
	 * @Column(type="string", name="email", unique=true)
	 */
	private $email;
	/**
	 * @Column(type="string", name="senha")
	 */
	private $senha;
	/**
	 * @Column(type="date", name="criado")
	 */
	private $criado;

	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function getNome() {
		return $this->nome;
	}

	public function setNome($nome) {
		$this->nome = $nome;
	}

	public function getEmail() {
		return $this->email;
	}

	public function setEmail($email) {
		$this->email = $email;
	}

	public function getSenha() {
		return $this->senha;
	}

	public function setSenha($senha) {
		$this->senha = $senha;
	}

	public function getCriado() {
		return $this->criado;
	}

	public function setCriado($criado) {
		$this->criado = $criado;
	}

	public function jsonSerialize() {
		return [
			'id' => $this->id,
			'nome' => $this->nome,
			'email' => $this->email,
			'criado' => $this->criado->format('Y-m-d'),
		];
	}
}

?>
