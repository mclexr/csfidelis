<?php
namespace App\Model;
/**
 * Funcionario
 *
 * @Entity
 * @Table(name="funcionario")
 */
class Funcionario implements \JsonSerializable {
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
	 * @Column(type="string", name="identificacao")
	 */
	private $identificacao;
	/**
	 * @ManyToOne(targetEntity="Empresa")
	 * @JoinColumn(name="empresa", referencedColumnName="id")
	 */
	private $empresa;
	/**
	 * @ManyToOne(targetEntity="Funcao")
	 * @JoinColumn(name="funcao", referencedColumnName="id")
	 */
	private $funcao;
	/**
	 * @Column(type="date", name="dataAdmissao")
	 */
	private $dataAdmissao;

	/**
	 * @ManyToMany(targetEntity="Treinamento")
	 * @JoinTable(name="funcionario_treinamento",
	 *                     joinColumns={@JoinColumn(name="funcionario")},
	 *                     inverseJoinColumns={@JoinColumn(name="treinamento")})
	 */
	private $treinamentos;

	public function __construct() {
		$this->treinamentos = new \Doctrine\Common\Collections\ArrayCollection();
	}

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

	public function getIdentificacao() {
		return $this->identificacao;
	}

	public function setIdentificacao($identificacao) {
		$this->identificacao = $identificacao;
	}

	public function getEmpresa() {
		return $this->empresa;
	}

	public function setEmpresa($empresa) {
		$this->empresa = $empresa;
	}

	public function getFuncao() {
		return $this->funcao;
	}

	public function setFuncao($funcao) {
		$this->funcao = $funcao;
	}

	public function getDataAdmissao() {
		return $this->dataAdmissao;
	}

	public function setDataAdmissao($dataAdmissao) {
		$this->dataAdmissao = $dataAdmissao;
	}

	public function jsonSerialize() {
		return [
			'id' => $this->id,
			'nome' => $this->nome,
			'identificacao' => $this->identificacao,
			'empresa' => $this->empresa->getNome(),
			'funcao' => $this->funcao->getDescricao(),
			'dataAdmissao' => $this->dataAdmissao->format('Y-m-d'),
		];
	}
}
?>
