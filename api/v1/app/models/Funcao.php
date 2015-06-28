<?php
namespace App\Model;
/**
 * Funcao
 *
 * @Entity
 * @Table(name="funcao")
 */
class Funcao implements \JsonSerializable {
	/**
	 * @Id
	 * @Column(type="integer", name="id")
	 * @GeneratedValue(strategy="AUTO")
	 */
	private $id;
	/**
	 * @Column(type="string", name="descricao")
	 */
	private $descricao;

	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function getDescricao() {
		return $this->descricao;
	}

	public function setDescricao($descricao) {
		$this->descricao = $descricao;
	}

	public function jsonSerialize() {
		return [
			'id' => $this->id,
			'descricao' => $this->descricao,
		];
	}
}
?>
