<?php
// api/src/Entity/task.php
namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use App\Controller\TaskController;
use Symfony\Component\Routing\RouterInterface;

#[ORM\Entity]
#[ApiResource(operations: [
    new GetCollection(
        name: 'tasks_by_ekipa',
        routeName: "team_tasks",
        uriTemplate: '/tasks-by-ekipa/{ekipa_id}',
        controller: TaskController::class,
    ),
    new Get(),
    new GetCollection(),
    new Post(),
    new Patch(),
    new Delete(),
])]
class Task
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[ApiProperty(identifier: true)]
    private ?int $task_id = null;

    #[ORM\Column]
    private ?string $about = null;

    #[ORM\Column]
    private ?string $location = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $data_reg = null;

    #[ORM\Column(type: 'datetime', nullable:true)]
    private ?\DateTimeInterface $time_exec = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column]
    private ?int $priority = null;

    #[ORM\ManyToOne(targetEntity: "Team")]
    #[ORM\JoinColumn(name: "ekipa_id", referencedColumnName: "ekipa_id")]
    #[ApiProperty(example:"/api/teams/{ekipa_id}")]
    private $team;

    public function getTaskId(): ?int
    {
        return $this->task_id;
    }

    public function getAbout(): ?string
    {
        return $this->about;
    }

    public function setAbout(?string $about): self
    {
        $this->about = $about;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(?string $location): self
    {
        $this->location = $location;

        return $this;
    }


    public function getDataReg(): ?\DateTimeInterface
    {
        return $this->data_reg;
    }

    public function setDataReg(?\DateTimeInterface $data_reg): self
    {
        $this->data_reg = $data_reg;

        return $this;
    }

    public function getTimeExec(): ?\DateTimeInterface
    {
        return $this->time_exec;
    }

    public function setTimeExec(?\DateTimeInterface $time_exec): self
    {
        $this->time_exec = $time_exec;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getPriority(): ?int
    {
        return $this->priority;
    }

    public function setPriority(?int $priority): self
    {
        $this->priority = $priority;

        return $this;
    }
    
    public function getTeam(): ?Team
    {
        return $this->team;
    }

    public function setTeam(?Team $team): self
    {
        $this->team = $team;
        return $this;
    }


    public function getTeamUrl(RouterInterface $router): string
    {
        return $this->team->getTeamUrl($router);
    }


    public function getEkipaId(): ?int
    {
        if ($this->team) {
            return $this->team->getEkipaId();
        }

        return null;
    }
}
