<?php
namespace App\Model;
/**
 * Treinamento
 *
 * @Entity
 * @Table(name="treinamento")
 */
class Treinamento implements \JsonSerializable {
	/**
	 * @Id
	 * @Column(type="integer", name="id")
	 * @GeneratedValue(strategy="AUTO")
	 */
	private $id;
	/**
	 * @ManyToOne(targetEntity="Empresa")
	 * @JoinColumn(name="empresa", referencedColumnName="id")
	 */
	private $empresa;
	/**
	 * @ManyToOne(targetEntity="TipoTreinamento")
	 * @JoinColumn(name="tipoTreinamento", referencedColumnName="id")
	 */
	private $tipoTreinamento;

	/**
	 * @Column(type="datetime", name="data")
	 */
	private $data;

	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function getEmpresa() {
		return $this->empresa;
	}

	public function setEmpresa($empresa) {
		$this->empresa = $empresa;
	}

	public function getTipoTreinamento() {
		return $this->tipoTreinamento;
	}

	public function setTipoTreinamento($tipoTreinamento) {
		$this->tipoTreinamento = $tipoTreinamento;
	}

	public function getData() {
		return $this->data;
	}

	public function setData($data) {
		$this->data = $data;
	}

	public function jsonSerialize() {
		return [
			'id' => $this->id,
			'empresa' => $this->empresa->getNome(),
			'tipoTreinamento' => $this->tipoTreinamento->getDescricao(),
			'data' => $this->data->format('Y-m-d')
		];
	}
}

?>
