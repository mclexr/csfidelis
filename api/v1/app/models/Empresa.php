<?php
namespace App\Model;
/**
 * @Entity
 * @Table(name="empresa")
 */
class Empresa implements \JsonSerializable {
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
	 * @Column(type="string", name="cnpj")
	 */
	private $cnpj;
	/**
	 * @Column(type="string", name="endereco")
	 */
	private $endereco;

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

	public function getCnpj() {
		return $this->cnpj;
	}

	public function setCnpj($cnpj) {
		$this->cnpj = $cnpj;
	}

	public function getEndereco() {
		return $this->endereco;
	}

	public function setEndereco($endereco) {
		$this->endereco = $endereco;
	}

	public function jsonSerialize() {
		return [
			'id' => $this->id,
			'nome' => $this->nome,
			'cnpj' => $this->cnpj,
			'endereco' => $this->endereco,
		];
	}
}
?>
