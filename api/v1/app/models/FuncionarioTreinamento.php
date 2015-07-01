<?php
namespace App\Model;
/**
 * FuncionarioTreinamento
 *
 * @Entity
 * @Table(name="funcionario_treinamento")
 */
class FuncionarioTreinamento implements \JsonSerializable {
	/**
	 * @Id
	 * @OneToOne(targetEntity="Funcionario")
	 * @JoinColumn(name="funcionario")
	 */
	private $funcionario;
	/**
	 * @Id
	 * @OneToOne(targetEntity="Treinamento")
	 * @JoinColumn(name="treinamento")
	 */
	private $treinamento;

	public function getFuncionario() {
		return $this->funcionario;
	}

	public function setFuncionario($funcionario) {
		$this->funcionario = $funcionario;
	}

	public function getTreinamento() {
		return $this->treinamento;
	}

	public function setTreinamento($treinamento) {
		$this->treinamento = $treinamento;
	}

	public function jsonSerialize() {
		return [
			'funcionario' => $this->funcionario,
			'treinamento' => $this->treinamento,
		];
	}
}

?>
