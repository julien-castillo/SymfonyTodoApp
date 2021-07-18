<?php


namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Class TodoList
 * @ORM\Entity
 * @ORM\Table(name="List")
 */
class TodoList
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank(message="Veuillez renseiogner le nom de la liste")
     * @Assert\Length(
     *     min=2,
     *     max=80,
     *     minMessage="Le nom saisi est trop court",
     *     maxMessage="Le nom saisi est trop long"
     * )
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * * @Assert\NotBlank(message="Veuillez renseiogner la couleur de la liste")
     * @Assert\Length(
     *     min=2,
     *     max=10,
     *     minMessage="La couleur saisie est trop courte",
     *     maxMessage="La couleursaisie est trop longue"
     * )
     * @ORM\Column(type="string")
     */
    private $color;

    /**
     * @ORM\OneToMany(targetEntity=Task::class, mappedBy="list", orphanRemoval=true)
     */
    private $tasks;

    public function __construct()
    {
        $this->tasks = new ArrayCollection();
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param mixed $color
     */
    public function setColor($color): void
    {
        $this->color = $color;
    }

    /**
     * @return Collection|Task[]
     */
    public function getTasks(): Collection
    {
        return $this->tasks;
    }

    public function addTask(Task $task): self
    {
        if (!$this->tasks->contains($task)) {
            $this->tasks[] = $task;
            $task->setList($this);
        }

        return $this;
    }

    public function removeTask(Task $task): self
    {
        if ($this->tasks->removeElement($task)) {
            // set the owning side to null (unless already changed)
            if ($task->getList() === $this) {
                $task->setList(null);
            }
        }

        return $this;
    }

}